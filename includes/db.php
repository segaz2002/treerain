<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 4/28/16
 * Time: 10:47 AM
 */

class db
{
    var $link;

    function __construct(){
        $this->link  = new mysqli("127.0.0.1", "root", "root", "raintree");
        if ( $this->link ->connect_error) {
            die("Connection failed: " .  $this->link ->connect_error);
        }
        return $this->link;
    }

    function run($queryString){
        if($this->link->query($queryString) === True){
            return True;
        }else{
            echo "Error in query: " . $this->link->error ."\n";
        }
    }


    //Todo Implement to release result
    function tidy($result){
        return true;
    }

    //Disconnect
    function disconnect(){
        return $this->link->close();
    }
}

