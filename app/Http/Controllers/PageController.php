<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Hash;
use Auth;

class PageController extends Controller
{
    
    function index(){
        return view('pages.home');
    }
    
}
// bcrypt