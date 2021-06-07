<?php 

namespace App\Route;

use App\Core\AbstractController;

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


}
    