<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class UserController extends Controller
{
   public function showAdminName(){
        return 'E.Abdulrahman Alshayah';
   }
}
