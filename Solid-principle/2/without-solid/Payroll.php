<?php

include_once 'Employee.php';
include_once 'ContractEmployee.php';
//include_once 'HourlyEmployee.php';

class Payroll {
    public function processSalary($employee) {
        if ($employee instanceof ContractEmployee) {
            return $employee->calculateSalary();
        } elseif ($employee instanceof Employee) {
            return $employee->calculateSalary();
        }
        return 0;
    }
}

// Example usage
$fullTimeEmployee = new Employee("Alice", 40, 25);
$contractEmployee = new ContractEmployee("Bob", 3000);

$payroll = new Payroll();
echo "Full-time Employee Salary: " . $payroll->processSalary($fullTimeEmployee) . "\n";
echo "Contract Employee Salary: " . $payroll->processSalary($contractEmployee) . "\n";
