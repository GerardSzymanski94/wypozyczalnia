<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\BaselinkerApiRepository;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getProducts()
    {
        $repo = new BaselinkerApiRepository;
        $repo->getProductsList();
    }

    public function getOrderStatusList()
    {
        $repo = new BaselinkerApiRepository;
        $repo->getOrderStatusList();
    }
}
