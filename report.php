<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 4/29/16
 * Time: 3:44 PM
 */

class report{
    var $entity;


    function __construct($db){
        $this->entity = $db;
    }

    public function display_patients(){
        $query = 'SELECT * from patient as p';
        $query .= 'JOIN insurance as i on p.id = i.patient_id';
        $query .= 'ORDER BY i.from_date, p.last';
        return $this->entity->run($query);
    }
}