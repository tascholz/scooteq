<?php

namespace App\Core;

use App\Route\DestinationRepository;
use PDO;
use PDOException;
use App\Route\RouteController;

class Container
{
    private $receipts = [];
    private $instances = [];

    public function __construct()
    {
        $this->receipts = [
            'routeController' => function() {
                return new RouteController(
                    $this->make('destinationRepository')
                );
            },
            'destinationRepository' => function() {
                return new DestinationRepository(
                    $this->make('pdo')
                );
            },
            'pdo' => function() {
                try {
                    $pdo = new PDO(
                        'mysql:host=scoot-dev_mysql_1;dbname=scooteq;charset=utf8',
                        'root',
                        'secret'
                    );
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    die();
                }
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                return $pdo;
            }
        ];
    }

    public function make($name)
    {
        if(!empty($this->instances[$name])){
            return $this->instances[$name];
        }

        if(isset($this->receipts[$name])){
            $this->instances[$name] = $this->receipts[$name]();
        }
        return $this->instances[$name];
    }
}