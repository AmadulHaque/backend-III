<?php

// Background: An e-commerce platform applies different discounts based on promotions
//  or customer segments (e.g., seasonal discounts, loyalty discounts, bulk 
//  purchase discounts). The marketing team frequently introduces new types of
//  discounts. The system should allow adding new discount types without modifying
//  the code for existing discounts.

// Question: How would you design the discount calculation system so that 
// new discount types can be introduced without changing the existing discount logic?


interface DiscountStrategy {
    public function applyDiscount($total);
}

class SeasonalDiscount implements DiscountStrategy {
    public function applyDiscount($total) {
        // TODO: Implement seasonal discount calculation
    }
}

class LoyaltyDiscount implements DiscountStrategy {
    public function applyDiscount($total) {
        // TODO: Implement loyalty discount calculation
    }
}

class BulkPurchaseDiscount implements DiscountStrategy {
    public function applyDiscount($total) {
        // TODO: Implement bulk purchase discount calculation
    }
}

class Order {
    private $total;
    private $discountStrategy;

    public function __construct($total, DiscountStrategy $discountStrategy) {
        $this->total = $total;
        $this->discountStrategy = $discountStrategy;
    }

    public function apply() {
        return $this->total - $this->discountStrategy->applyDiscount($this->total);
    }
}

// Usage
$seasonalDiscount = new SeasonalDiscount();
$order = new Order(100, $seasonalDiscount);
echo $order->apply(); 



// Usage Principles :
// 1. SRP (Single Responsibility Principle)
// 2. OCP (Open/Closed Principle)
