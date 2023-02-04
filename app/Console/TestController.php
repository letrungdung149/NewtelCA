<?php

namespace App\Console;

class TestController
{
    public function index(){
        $ob1 = app()->make('MyTesting')->setAtt('Le Quoc Tich');
        $ob1 = $ob1->hello();
        $ob2 = app()->make('MyTesting')->hello();
    }
}
