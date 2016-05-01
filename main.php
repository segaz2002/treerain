<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 4/28/16
 * Time: 11:00 AM
 */

require('./includes/db.php');
require('./includes/migration.php');
require('./resource/seed.php');
$db = new db();
$migration = new migration($db);
$seed = new Seeder();
//var_dump($db);
//var_dump($argv);


if(isset($argv[1])&&$argv[1] == 1 && isset($argv[2])){
    echo "\n";
    echo "\n";
    echo "TASK 1 - Database setup and Seeding Steps\n";
    echo "=========================================\n";
    echo "\n";
    switch ($argv[2]){
        case 'up':
            $migration->up();
            break;
        case 'seed':
            $seed->run($db);
            break;
        case 'down':
            $migration->down();
            break;

        default:
            echo "Usage \n";
            echo "php main.php 1 up \n";
            echo "or\n";
            echo "php main.php 1 down \n";
    }
    $db->disconnect();
    exit;
}else{
    echo "\n";
    echo "Usage example \n";
    echo "1. Database setup and record seeding : choose (up) or (down)\n";
    echo "2. Reporting\n";
    echo "3. OOP \n";
    echo "\n";
    echo "e.g ---> php main.php 1 up \n";
    exit;
}


