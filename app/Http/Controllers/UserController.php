<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function calcTax($salary, $taxPercentage=0.15){
        return floor($salary * $taxPercentage);
    }

    public function netSalary($salary){
        return $salary - $this->calcTax($salary);
    }

    public function index(){
//        $users = User::whereIn("nation", ["myanmar", "japan"])->where("salary", ">", 5000)
//            ->where("gender", "male")
//            ->orderBy("salary", "desc")->get();
//        $users = User::where("nation", "myanmar")->avg("salary");
        $users = User::where("nation", "myanmar")->paginate(5)->through(function ($user){
            $user->tax = $this->calcTax($user->salary);
            $user->net_salary = $this->netSalary($user->salary);
            return $user;
        });
        return $users;
    }
}
