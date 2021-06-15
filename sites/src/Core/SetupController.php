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
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Eidelstadt',3,6,1);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Wandsbek',6,1,3);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Altona',3,1,3);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Jenfeld',4,2,3);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Eppendorf',5,7,4);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Winterhude',5,1,3);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Barmberk',4,5,3);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Lurup',6,1,1);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Borgfelde',7,2,5);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Steilshoop',6,1,4);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Dulsberg',4,2,5);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Eilbek',7,6,1);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Hammerbrook',2,1,3);");
        $stmt = $this->pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Hamburg-Altstadt',2,2,3);");
    }
}