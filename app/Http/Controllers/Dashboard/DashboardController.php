<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
 public function __invoke(){

    $flag = 0;

    return view('dashboard.index',compact('flag'));
 }
}
