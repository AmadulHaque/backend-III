❌ Implementation Without SOLID Principles

This version lacks flexibility, violating key SOLID principles (especially Open-Closed Principle and Liskov Substitution Principle). The Payroll class uses special conditions (if-else) to handle different employee types.


❌ Issues in the Non-SOLID Approach:

    Open-Closed Principle Violation: If a new employee type is added, we must modify the Payroll class.
    Liskov Substitution Violation: The ContractEmployee class extends Employee, but it doesn’t use hoursWorked or hourlyRate, making it an improper subclass.
    Single Responsibility Violation: The Payroll class has to check employee types, adding unnecessary complexity.