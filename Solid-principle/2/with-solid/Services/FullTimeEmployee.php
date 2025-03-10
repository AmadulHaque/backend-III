<?php

require_once 'Employee.php';

class FullTimeEmployee extends Employee {
    private $hoursWorked;
    private $hourlyRate;

    public function __construct($name, $hoursWorked, $hourlyRate) {
        parent::__construct($name);
        $this->hoursWorked = $hoursWorked;
        $this->hourlyRate = $hourlyRate;
    }

    public function calculateSalary() {
        return $this->hoursWorked * $this->hourlyRate;
    }
}