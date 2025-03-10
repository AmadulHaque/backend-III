<?php

require_once 'Employee.php';

class ContractEmployee extends Employee {
    private $contractRate;

    public function __construct($name, $contractRate) {
        parent::__construct($name);
        $this->contractRate = $contractRate;
    }

    public function calculateSalary() {
        return $this->contractRate;
    }
}