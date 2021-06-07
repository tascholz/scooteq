<?php
namespace App\Route;

use App\Core\AbstractRepository;

class DestinationRepository extends AbstractRepository
{
    public function getTableName()
    {
        return "destinations";
    }

    public function getModelName()
    {
        return "App\\Route\\DestinationModel";
    }
}