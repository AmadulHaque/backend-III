<?php
 
class Employee {
    protected $name;
    protected $hoursWorked;
    protected $hourlyRate;

    public function __construct($name, $hoursWorked, $hourlyRate) {
        $this->name = $name;
        $this->hoursWorked = $hoursWorked;
        $this->hourlyRate = $hourlyRate;
    }

    public function calculateSalary() {
        return $this->hoursWorked * $this->hourlyRate;
    }
}