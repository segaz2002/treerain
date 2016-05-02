<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 4/29/16
 * Time: 3:44 PM
 */

class report{
    var $link;


    function __construct($db){
        $this->link = $db;
    }

    public function display_patients(){
        echo "a.Display Patients\n";
        echo "-------------------\n";
        $query = "SELECT p.pn, p.last, p.first, i.iname, DATE_FORMAT(i.from_date,'%m-%d-%y'), DATE_FORMAT(i.to_date,'%m-%d-%y') from patient p ";
        $query .= 'JOIN insurance as i on p._id = i.patient_id ';
        $query .= 'ORDER BY i.from_date, p.last';
        echo $query."\n";
        echo "\n";
        $result =  $this->link->exec($query);
        while ($row=mysqli_fetch_row($result)){
            echo "$row[0],$row[1],$row[2],$row[3],$row[4],$row[5]\n";
        }
        echo "\n";
        $this->link->disconnect();
        return;
    }

    public function getCharStat(){
        echo "b.Character statistics in patient first and last names\n";
        echo "-------------------\n";
        $stringPool="";
        $stats= [];
        $pcg= [];
        $query = "SELECT first, last FROM patient";
        $result =  $this->link->exec($query);
        while ($row=mysqli_fetch_row($result)){
            $stringPool .= strtolower(trim($row[0]).trim($row[1]));
        }
        //Counts
        for($i=0; $i<strlen($stringPool); $i++){
            $stats[$stringPool[$i]] = substr_count($stringPool,$stringPool[$i]);
        }
        //Percentage
        foreach ($stats as $k=> $v){
            $pcg[$k] = number_format(($v/strlen($stringPool)) * 100, 2);
        }
        //Display Results
        ksort($stats);
        foreach($stats as $k=>$v){
            echo "$k \t $v \t $pcg[$k]% \n";
        }
        echo "\n";
        $this->link->disconnect();
        return;
    }
}