<?php 

namespace App\Route;

use App\Core\AbstractController;
use PDO;

class RouteController extends AbstractController{
    public function __construct(
        DestinationRepository $destinationRepository
    )
    {
        $this->destinationRepository = $destinationRepository;
    }

    public function index(){
        $this->render("index", []);
    }

    public function routes()
    {
        $destinations = $this->destinationRepository->all();
        $this->getQuantityDifference($destinations);
        $routes = $this->buildRoutes($destinations);

        $this->render("routes", [
            'destinations' => $destinations,
            'routes' => $routes
        ]);   
    }

    private function getQuantityDifference($destinations)
    {
        foreach($destinations as $destination){
            $destination->diff = $destination->actual_quantity - $destination->target_quantity;
        }
    }

    private function buildRoutes($destinations)
    {
        //$this->sortDestinations($destinations);
        usort($destinations, function($a, $b)
            {
                if ($a->diff == $b->diff) {
                    return 0;
                }
                return ($a->diff > $b->diff) ? -1 : 1;
            });
        

        $routes = array();
        $x = 0;
        $y = $this->max_attribute_in_array($destinations, "routeID");
        while($x <= $y){
            if(!isset($routes[$x])){
                $routes[$x] = array();
            }
            foreach($destinations as $destination){
                if($destination->routeID == $x && $destination->diff != 0){
                    array_push($routes[$x], $destination);
                }
            } 
            $x++;    
        }
        return $routes;   
    }

    private function sortDestinations($destinations){
        usort($destinations, function($a, $b)
            {
                if ($a->diff == $b->diff) {
                    return 0;
                }
                return ($a->diff > $b->diff) ? -1 : 1;
            });
    }

    private function max_attribute_in_array($array, $prop) {
        return max(array_map(function($o) use($prop){
            return $o->$prop;
        },
        $array));
    }

    public function setupDatabase() {
        $pdo = new PDO(
            'mysql:host=scoot-dev_mysql_1;dbname=scooteq;charset=utf8',
            'root',
            'secret'
        );
        $stmt = $pdo->query("SHOW TABLES LIKE 'destinations'");
        //$stmt->execute();
        $result = $stmt->fetchAll();
        if(empty($result)){
            $stmt = $pdo->query("CREATE TABLE destinations (
                id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(50),
                actual_quantity INT,
                target_quantity INT,
                routeID INT)
                ");
            $stmt->execute();

            $this->populate();
        
            
        }
        else {
            echo 'database already built';
        }
    }

    function populate(){
        $pdo = new PDO(
            'mysql:host=scoot-dev_mysql_1;dbname=scooteq;charset=utf8',
            'root',
            'secret'
        );
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('HH Mitte',1,3,1);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Veddel',4,2,2);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Heimfeld',5,3,2);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Wilhelmsburg',4,7,2);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Eidelstadt',3,6,1);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Wandsbek',6,1,3);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Altona',3,1,3);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Jenfeld',4,2,3);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Eppendorf',5,7,4);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Winterhude',5,1,3);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Barmberk',4,5,3);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Lurup',6,1,1);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Borgfelde',7,2,5);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Steilshoop',6,1,4);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Dulsberg',4,2,5);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Eilbek',7,6,1);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Hammerbrook',2,1,3);");
        $stmt = $pdo->query("INSERT INTO `destinations` (`name`,`actual_quantity`,`target_quantity`,`routeID`) VALUES ('Hamburg-Altstadt',2,2,3);");

    }


}
    