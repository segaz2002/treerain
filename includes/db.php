<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 4/28/16
 * Time: 10:47 AM
 */

include('./config.php');

class db
{
    var $link;

    function __construct(){
        $this->link  = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ( $this->link ->connect_error) {
            die("Connection failed: " .  $this->link ->connect_error. "\n");
        }
        return $this->link;
    }

    function run($queryString){
        $r = $this->link->query($queryString);

        if($r === True){
            return True;
        }elseif(get_class($r) === "mysqli_result"){

            return $r;
        }else{
            echo "Error in query: " . $this->link->error ."\n";
        }
    }

    function exec($queryString){
        return mysqli_query($this->link,$queryString);
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

