<?php


interface OrderRepositoryInterface {
    public function saveOrder(array $orderData);
    public function getOrder(string $orderId);
}


class OrderRepositorySql implements OrderRepositoryInterface {
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function saveOrder(array $orderData)
    {
        // TODO: Implement saveOrder() method.
    }

    public function getOrder(string $orderId)
    {
        // TODO: Implement getOrder() method.
    }
}

class OrderRepositoryNoSql implements OrderRepositoryInterface {
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function saveOrder(array $orderData)
    {
        // TODO: Implement saveOrder() method.
    }

    public function getOrder(string $orderId)
    {
        // TODO: Implement getOrder() method.
    }
}


class OrderService {
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(array $orderData): mixed
    {
       return $this->orderRepository->saveOrder($orderData);
    }

    public function getOrder(string $orderId): mixed
    {
        return $this->orderRepository->getOrder($orderId);   
    }
}



// Example usage SQL : 
$connection = new PDO("mysql:host=localhost;dbname=ecommerce", "root", "");
$orderRepositorySql = new OrderRepositorySql($connection);
$orderService = new OrderService($orderRepositorySql);

$orderService->createOrder(['id' => 1, 'customer_id' => 1, 'total_amount' => 100.00]);
$order = $orderService->getOrder(1);

// Example usage NoSQL  :
$connection = new MongoDB\Client("mongodb://localhost:27017");
$orderRepositoryNoSql = new OrderRepositoryNoSql($connection);
$orderService = new OrderService($orderRepositoryNoSql);    

$orderService->createOrder(['id' => 1, 'customer_id' => 1, 'total_amount' => 100.00]);  
$order = $orderService->getOrder(1);


// ✅ Why This Design is Scalable and Maintainable 
/*
    1. Single Responsibility Principle (SRP):
        OrderService focuses on business logic.
        Repositories handle database-specific logic separately.

    2. Open/Closed Principle (OCP):
        The OrderService can be extended to support new storage types.
        Repositories can be extended to support different databases.


    3. Liskov Substitution Principle (LSP):
        OrderService can work with any OrderRepository implementation.
        OrderRepository implementations can be substituted without affecting the OrderService.

    4. Interface Segregation Principle (ISP):
        OrderRepositorySql and OrderRepositoryNoSql implement specific interfaces.
        OrderService uses these interfaces to interact with repositories.


    5. Dependency Inversion Principle (DIP):
        OrderService depends on abstractions (interfaces) rather than concrete implementations.
        This allows for easier testing and flexibility in choosing storage types.
 
*/