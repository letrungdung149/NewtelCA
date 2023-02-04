<?php
namespace App;

class test{
    public $testAtt;

    public function setAtt($name){
        $this->testAtt = $name;
    }

    public function hello(){
        return "hello ban: " . $this->testAtt;
    }
}
