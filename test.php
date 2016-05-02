<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 5/2/16
 * Time: 6:25 PM
 */

require('./Insurance.php');
require('./Patient.php');

$today = date('m-d-y');
$link = new db();
$patients = [];
$info = "";

$query = "SELECT p.pn, p.last, p.first, i._id, i.iname, i.from_date, i.to_date from patient p ";
$query .= 'JOIN insurance as i on p._id = i.patient_id ';
$query .= 'ORDER BY p.pn';

$res  =  $link->exec($query);
while ($row=$res->fetch_assoc()){
    $cover = new Insurance($row['_id']);
    if($cover->checkPolicyValidity($today) === "True"){
        $row['ivalid'] = "Yes";
    }else{
        $row['ivalid'] = "No";
    }
    $patients[] = $row;
}
$link->disconnect();
foreach($patients as $patient){
    echo $patient['pn'].','.$patient['first'].','.$patient['last'].','.$patient['iname'].','.$patient['ivalid']."\n";
}

//var_dump($patients);