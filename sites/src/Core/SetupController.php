<?php

namespace App\Core;

use App\Core\AbstractController;
use PDO;

class SetupController extends AbstractController{
    public function __construct(){
        $this->pdo = new PDO(
            'mysql:host=scoot-dev_mysql_1;charset=utf8',
            'root',
            'secret'
        );
    }

    public function setupDatabase(){
        $this->createDatabase();

        $stmt = $this->pdo->query("SHOW TABLES LIKE 'destinations'");
        $result = $stmt->fetchAll();

        
        $this->render('index', []);
        if(empty($result)){
            $this->createDestinationsTable(); 
            echo " <br> Database setup was successfull";
        }
        else {
            echo ' <br> database already built';
        }
    }

    public function createDatabase(){
        $this->pdo->query("CREATE DATABASE scooteq");
        $this->pdo = new PDO(
            'mysql:host=scoot-dev_mysql_1;dbname=scooteq;charset=utf8',
            'root',
            'secret'
        );
    }

    public function createDestinationsTable(){
        $stmt = $this->pdo->query("CREATE TABLE destinations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(50),
            actual_quantity INT,
            target_quantity INT,
            routeID INT)
            ");
        $stmt->execute();

        $this->populate();
    }

    function populate(){
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('HH Mitte',1,3,1);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Veddel',4,2,2);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Heimfeld',5,3,2);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Wilhelmsburg',4,7,2);");
    }
}