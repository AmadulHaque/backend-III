✅ Implementation With SOLID Principles

This version ensures that the payroll system can handle multiple employee types without special conditions.

✅ Benefits of the SOLID Approach:

1. Single Responsibility Principle (SRP): Each class has a single responsibility.

2. Open-Closed Principle (OCP): We can add new employee types without modifying existing code.

3. Liskov Substitution Principle (LSP): Every subclass can be used interchangeably through the Payable interface.

4. Interface Segregation Principle (ISP): We define a Payable interface to keep classes focused on salary calculation.

5. Dependency Inversion Principle (DIP): Payroll depends on the Payable interface, not concrete classes, making it flexible.