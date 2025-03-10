<?php

require_once "Payable.php";
abstract class Employee implements Payable {
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    abstract public function calculateSalary();
}
