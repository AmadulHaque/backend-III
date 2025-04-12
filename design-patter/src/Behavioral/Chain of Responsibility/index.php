<?php

// Definition: Passes a request along a chain of handlers. Each handler decides to process the request or pass it to the next handler in the chain.
// Purpose: Decouples senders and receivers, giving multiple objects a chance to handle the request.


interface PaymentHandler {
    public function setNext(PaymentHandler $handler): PaymentHandler;
    public function handle(int $amount): ?string;
}

// Abstract handler
abstract class AbstractPaymentHandler implements PaymentHandler {
    private $nextHandler;
    
    public function setNext(PaymentHandler $handler): PaymentHandler {
        $this->nextHandler = $handler;
        return $handler;
    }
    
    public function handle(int $amount): ?string {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($amount);
        }
        return null;
    }
}

// Concrete handlers
class CashHandler extends AbstractPaymentHandler {
    public function handle(int $amount): ?string {
        if ($amount <= 100) {
            return "Paid with cash";
        }
        return parent::handle($amount);
    }
}

class DebitCardHandler extends AbstractPaymentHandler {
    public function handle(int $amount): ?string {
        if ($amount <= 1000) {
            return "Paid with debit card";
        }
        return parent::handle($amount);
    }
}

class CreditCardHandler extends AbstractPaymentHandler {
    public function handle(int $amount): ?string {
        if ($amount <= 5000) {
            return "Paid with credit card";
        }
        return parent::handle($amount);
    }
}

// Client code
$cash = new CashHandler();
$debit = new DebitCardHandler();
$credit = new CreditCardHandler();

$cash->setNext($debit)->setNext($credit);

// Process payment with amount
echo $cash->handle(50) . PHP_EOL;    // Output: Paid with cash
echo $cash->handle(500) . PHP_EOL;   // Output: Paid with debit card
echo $cash->handle(2000) . PHP_EOL;  // Output: Paid with credit card
echo $cash->handle(10000) . PHP_EOL; // Output: null (no handler available)
