<?php

require_once 'Employee.php'; // Include the Employee class

class ContractEmployee extends Employee {
    private $contractRate;

    public function __construct($name, $contractRate) {
        parent::__construct($name, 0, 0); // Dummy values for unused properties
        $this->contractRate = $contractRate;
    }

    public function calculateSalary() {
        return $this->contractRate;
    }
}
