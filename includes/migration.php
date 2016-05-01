<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 4/28/16
 * Time: 11:18 AM
 */


class migration
{
    var $resource;

    public function __construct($db){
        //echo "Starting Migration";
        $this->resource = $db;
    }

    public function up(){
        if($this->patient_up() &&  $this->insurance_up()){
            return true;
        }else{
            echo "Queries failed";
            return false;
        }
    }

    public function down(){
        if($this->insurance_down() && $this->patient_down()){
            return true;
        }else{
            //return $this->resource->error();
            echo "\n Operation Failed \n";
        }
    }

    private function patient_up(){
        //create the patient entity
        $query = 'CREATE TABLE IF NOT EXISTS patient';
        $query .= '(';
        $query .= '_id INT(10) unsigned NOT NULL AUTO_INCREMENT,';
        $query .= 'pn varchar(11) default null,';
        $query .= 'first varchar(15) default null,';
        $query .= 'last varchar(25) default null,';
        $query .= 'dob date default null,';
        $query .= 'PRIMARY KEY (_id)'; //Not specified in requirement, but necessary
        $query .= ')';
        //return $this->resource->run($query);
        echo "Creating  [TABLE] patients..... \n";
        if($this->resource->run($query)){
            echo "[TABLE] Patients Created \n";
            return True;
        }else{
            return False;
        }
    }

    private function patient_down(){
        //Drop patient entity
        $query = 'DROP TABLE patient';
        if($this->resource->run($query)){
            echo "[TABLE] Patient Dropped \n";
            return True;
        }else{
            return False;
        }
        #$this->resource->run("ALTER TABLE patient AUTO_INCREMENT = 1");
    }

    private function insurance_up(){
        //Create insurance entity
        $query = 'CREATE TABLE IF NOT EXISTS insurance' ;
        $query .= '(';
        $query .= '_id INT(10) unsigned NOT NULL AUTO_INCREMENT,';
        $query .= 'patient_id int(10) unsigned not null default 0,';
        $query .= 'iname varchar(40) default null,';
        $query .= 'from_date date default null,';
        $query .= 'to_date date default null,';
        $query .= 'PRIMARY KEY (_id),'; //Not specified in requirement, but necessary
        $query .= 'FOREIGN KEY (patient_id) REFERENCES patient(_id)';
        $query .= ')';
        //return $this->resource->run($query);
        echo "Creating  [TABLE] insurance.... \n";
        if($this->resource->run($query)){
            echo "[TABLE] insurance Created \n";
            return True;
        }else{
            return False;
        }

    }

    private function insurance_down(){
        //Drop patient entity
        $query = 'DROP TABLE insurance';
        if($this->resource->run($query)){
            echo "[TABLE] insurance Dropped \n";
            return True;
        }else{
            return False;
        }

    }
}