<?php

// Background: An e-commerce platform manages products with various types,
// such as physical goods, digital downloads, and services.
// Physical goods need methods for shipping, inventory tracking, 
// and delivery, while digital products only require download and 
// licensing methods. Service-based products may need scheduling functionality.
// The product interface should avoid imposing irrelevant methods on different
//  product types.

// Question: How would you design interfaces for these different product types?


interface Product
{
    public function getName(): string;
    public function getPrice(): float;
}

interface Shippable
{
    public function getShippingCost(): float;
    public function getInventory(): int;
    public function deliver(): void;
}

interface Downloadable
{
    public function download(): void;
    public function license(): string;
}

interface Schedulable
{
    public function schedule(): void;
}

// Implementations

class PhysicalProductImpl implements Product, Shippable
{
    public function getName(): string
    {
        return "Laptop";
    }

    public function getPrice(): float
    {
        return 999.99;
    }

    public function getShippingCost(): float
    {
        return 20.0;
    }

    public function getInventory(): int
    {
        return 50;
    }

    public function deliver(): void
    {
        echo "Shipping the product.";
    }
}

class DigitalProductImpl implements Product, Downloadable
{
    public function getName(): string
    {
        return "E-Book";
    }

    public function getPrice(): float
    {
        return 19.99;
    }

    public function download(): void
    {
        echo "Downloading the digital product.";
    }

    public function license(): string
    {
        return "License Key: XYZ-123";
    }
}

class ServiceProductImpl implements Product, Schedulable
{
    public function getName(): string
    {
        return "Consultation Service";
    }

    public function getPrice(): float
    {
        return 150.00;
    }

    public function schedule(): void
    {
        echo "Service scheduled.";
    }
}
