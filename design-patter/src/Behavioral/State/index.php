<?php

// purpose of the State Pattern

// State-specific behavior: Encapsulate state-specific behavior in separate classes
// Clean state transitions: Simplify complex conditional state logic
// Extensibility: Easily add new states without changing existing code
// Single Responsibility: Each state class handles only its own behavior

// Key Components

// Context: The class that maintains the current state
// State Interface: Defines the interface for state-specific behavior
// Concrete States: Classes that implement behavior for specific states



interface OrderState {
    public function proceedToNext(OrderContext $context);
    public function cancel(OrderContext $context);
    public function displayState(): string;
}

// Concrete States
class NewOrderState implements OrderState {
    public function proceedToNext(OrderContext $context) {
        $context->setState(new ProcessingOrderState());
    }

    public function cancel(OrderContext $context) {
        $context->setState(new CancelledOrderState());
    }

    public function displayState(): string {
        return "New";
    }
}

class ProcessingOrderState implements OrderState {
    public function proceedToNext(OrderContext $context) {
        $context->setState(new ShippedOrderState());
    }

    public function cancel(OrderContext $context) {
        $context->setState(new CancelledOrderState());
    }

    public function displayState(): string {
        return "Processing";
    }
}

class ShippedOrderState implements OrderState {
    public function proceedToNext(OrderContext $context) {
        $context->setState(new DeliveredOrderState());
    }

    public function cancel(OrderContext $context) {
        throw new Exception("Cannot cancel already shipped order");
    }

    public function displayState(): string {
        return "Shipped";
    }
}

class DeliveredOrderState implements OrderState {
    public function proceedToNext(OrderContext $context) {
        throw new Exception("Order already delivered");
    }

    public function cancel(OrderContext $context) {
        throw new Exception("Cannot cancel already delivered order");
    }

    public function displayState(): string {
        return "Delivered";
    }
}

class CancelledOrderState implements OrderState {
    public function proceedToNext(OrderContext $context) {
        throw new Exception("Cannot proceed with cancelled order");
    }

    public function cancel(OrderContext $context) {
        throw new Exception("Order already cancelled");
    }

    public function displayState(): string {
        return "Cancelled";
    }
}

// Context class
class OrderContext {
    private OrderState $state;

    public function __construct() {
        $this->state = new NewOrderState();
    }

    public function setState(OrderState $state) {
        $this->state = $state;
    }

    public function proceedToNext() {
        $this->state->proceedToNext($this);
    }

    public function cancel() {
        $this->state->cancel($this);
    }

    public function getState(): string {
        return $this->state->displayState();
    }
}

// Usage
$order = new OrderContext();
echo "Initial state: " . $order->getState() . "\n";

$order->proceedToNext();
echo "After proceed: " . $order->getState() . "\n";

$order->proceedToNext();
echo "After proceed: " . $order->getState() . "\n";

// Try to cancel shipped order
try {
    $order->cancel();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}