<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 5/2/16
 * Time: 4:10 PM
 */

require_once('./includes/db.php');
require_once('./PatientRecord.php');
class Insurance implements PatientRecord {
    protected $_id;
    protected $patient_id;
    protected $iname;
    protected $from_date;
    protected $to_date;
    protected $link;

    function __construct($insuranceId){
        $this->link = new db();
        try{
            if(!$this->setProperties($insuranceId,$this->link)){
                throw new Exception("Invalid insuranceID");
            }
        }catch (Exception $e){
            echo 'Insurance Instatiation failed due to: ',  $e->getMessage(), "\n";
        }
    }

    function getId(){
        return $this->_id;
    }

    function getPatientNumber(){
        $res = $this->link->exec("SELECT pn FROM patient WHERE _id = $this->patient_id");
        $row = mysqli_fetch_assoc($res);
        return $row['pn'];
    }

    function checkPolicyValidity($dateStr){
        $dateSubs = explode('-',$dateStr);
        $newString = $dateSubs[2].'-'.$dateSubs[0].'-'.$dateSubs[1];
        $ans = "False";
        //echo "is $dateStr (mm-dd-yy) between $this->from_date and $this->to_date";
        if(isset($this->to_date) && isset($this->from_date)){
            if((strtotime($newString) > strtotime($this->from_date)) && (strtotime($newString) < strtotime($this->to_date))){
                $ans =  "True";
            }else{
                $ans = "False";
            }
        }elseif(isset($this->from_date)){
            if((strtotime($newString) > strtotime($this->from_date))){
                $ans = "True";
            }
        }
        return $ans;
    }

    function setProperties($id,$link){
        $insurancyPolicy = $link->exec("SELECT * FROM insurance WHERE _id = $id");
        if($insurancyPolicy->num_rows < 1){
            return False;
        }else{
            $policyRecord = $insurancyPolicy->fetch_assoc();
            $this->_id =  $policyRecord['_id'];
            $this->patient_id =  $policyRecord['patient_id'];
            $this->iname = $policyRecord['iname'];
            $this->from_date = $policyRecord['from_date'];
            $this->to_date = $policyRecord['to_date'];
            $this->link->disconnect();
            return True;
        }
    }
}

//$in =  new Insurance(1);
//# mm/dd/yy
//echo $in->getPatientNumber();
//echo $in->checkPolicyValidity('03-05-16')."\n";