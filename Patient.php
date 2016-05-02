<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 5/2/16
 * Time: 1:16 AM
 */

require('./includes/db.php');
require('./PatientRecord.php');
class Patient implements PatientRecord {
    protected $_id;
    protected $pn;
    protected $first;
    protected $last;
    protected $dob;
    protected $insurancePolicies=[];

    function __construct($pn){
        $this->pn = $pn;
        $db = new db();
        $this->setProperties($pn,$db);

    }

    function getId(){
        return $this->_id;
    }

    function getPatientNumber(){
        return $this->pn;
    }

    function patientFullName(){
        return $this->first." ".$this->last;
    }

    function patientInsurancePolicies(){
        return $this->insurancePolicies;
    }

    function checkInsuranceValidity($date){
        $info ="";
        foreach ($this->insurancePolicies as $policy){
            if(strtotime($date) < strtotime($policy[4])){
                $info .= "$this->pn, $this->first $this->last, $policy[2], Yes \n";
            }else{
                $info .=  "$this->pn, $this->first $this->last, $policy[2], No \n";
            }
        }
        return $info;
    }

    function setProperties($pn,$link){
        $res = $link->exec("SELECT * FROM patient WHERE pn = $pn");
        $patientRec = $res->fetch_assoc();
        $this->_id = $patientRec['_id'];
        $this->first = $patientRec['first'];
        $this->last = $patientRec['last'];
        $this->dob = $patientRec['dob'];
        $insurePolicies = $link->exec("SELECT * FROM insurance WHERE patient_id = $this->_id");
        while ($row=mysqli_fetch_row($insurePolicies)){
            $this->insurancePolicies[] = $row;
        }
        return;
    }


}

$test =  new Patient('20323283482');
echo $test->checkInsuranceValidity('19-02-16');
