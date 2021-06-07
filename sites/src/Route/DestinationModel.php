<?php

namespace App\Route;

use App\Core\AbstractModel;

class DestinationModel extends AbstractModel
{
  public $id;
  public $name;
  public $actual_quantity;
  public $target_quantity;
  public $diff;
  public $routeId;
}