<?php

namespace App\Core;

use App\Core\AbstractController;

class IndexController extends AbstractController
{
    public function index()
    {
        $this->render('index', []);
    }
}