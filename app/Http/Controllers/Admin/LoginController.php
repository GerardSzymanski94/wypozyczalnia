<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('redirectAdmin');
    }

    public function index()
    {
        return view('admin.login');
    }
}
