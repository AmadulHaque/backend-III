<?php

require_once 'Payable.php';

class Payroll {
    public function processSalary(Payable $employee) {
        return $employee->calculateSalary();
    }
}


// Example usage
$fullTimeEmployee = new FullTimeEmployee("Alice", 40, 25);
$contractEmployee = new ContractEmployee("Bob", 3000);

$payroll = new Payroll();
echo "Full-time Employee Salary: " . $payroll->processSalary($fullTimeEmployee) . "\n";
echo "Contract Employee Salary: " . $payroll->processSalary($contractEmployee) . "\n";
