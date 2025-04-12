<?php

// Definition: Defines a family of algorithms, encapsulates each one, and makes them interchangeable.
// Purpose: Lets the algorithm vary independently from clients that use it.

interface PaymentStrategy {
    public function pay(float $amount);
}

// Concrete strategies
class CreditCardPayment implements PaymentStrategy {
    private $cardNumber;
    private $name;
    
    public function __construct(string $cardNumber, string $name) {
        $this->cardNumber = $cardNumber;
        $this->name = $name;
    }
    
    public function pay(float $amount) {
        echo "Paid $amount using Credit Card ({$this->cardNumber})" . PHP_EOL;
    }
}

class PayPalPayment implements PaymentStrategy {
    private $email;
    
    public function __construct(string $email) {
        $this->email = $email;
    }
    
    public function pay(float $amount) {
        echo "Paid $amount using PayPal ({$this->email})" . PHP_EOL;
    }
}

class BankTransferPayment implements PaymentStrategy {
    private $accountNumber;
    
    public function __construct(string $accountNumber) {
        $this->accountNumber = $accountNumber;
    }
    
    public function pay(float $amount) {
        echo "Paid $amount using Bank Transfer (Acc: {$this->accountNumber})" . PHP_EOL;
    }
}

// Context
class ShoppingCart {
    private $strategy;
    private $items = [];
    
    public function addItem(string $item, float $price) {
        $this->items[$item] = $price;
    }
    
    public function setPaymentStrategy(PaymentStrategy $strategy) {
        $this->strategy = $strategy;
    }
    
    public function checkout() {
        $total = array_sum($this->items);
        
        if ($this->strategy) {
            $this->strategy->pay($total);
        } else {
            echo "No payment method set!" . PHP_EOL;
        }
    }
}

// Client code
$cart = new ShoppingCart();
$cart->addItem("Laptop", 999.99);
$cart->addItem("Headphones", 129.99);

// Pay with credit card
$cart->setPaymentStrategy(strategy: new CreditCardPayment("1234-5678-9012-3456", "John Doe"));
$cart->checkout();
// Output: Paid 1129.98 using Credit Card (1234-5678-9012-3456)

// Pay with PayPal
$cart->setPaymentStrategy(new PayPalPayment("john.doe@example.com"));
$cart->checkout();
// Output: Paid 1129.98 using PayPal (john.doe@example.com)

// Pay with bank transfer
$cart->setPaymentStrategy(new BankTransferPayment("987654321"));
$cart->checkout();
