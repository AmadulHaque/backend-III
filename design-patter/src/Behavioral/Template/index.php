<?php

// Purpose of the Template Method Pattern

// Algorithm structure: Defines the overall structure of an algorithm
// Step customization: Allows subclasses to redefine certain steps
// Code reuse: Promotes code reuse by putting common behavior in the base class
// Control flow: Maintains the control flow in the base class while allowing flexibility in specific steps

abstract class DataProcessor {
    // This is the template method
    final public function process() {
        $this->readData();
        $this->validateData();
        $this->transformData();
        $this->saveData();
    }

    abstract protected function readData(): void;
    abstract protected function validateData(): void;
    
    protected function transformData(): void {
        // Default implementation (can be overridden)
        echo "Performing default data transformation...\n";
    }

    abstract protected function saveData(): void;
}

class CSVProcessor extends DataProcessor {
    protected function readData(): void {
        echo "Reading data from CSV file...\n";
    }

    protected function validateData(): void {
        echo "Validating CSV data...\n";
    }

    protected function saveData(): void {
        echo "Saving processed CSV data to database...\n";
    }
}

class JSONProcessor extends DataProcessor {
    protected function readData(): void {
        echo "Reading data from JSON file...\n";
    }

    protected function validateData(): void {
        echo "Validating JSON data...\n";
    }

    protected function transformData(): void {
        echo "Performing custom JSON transformation...\n";
    }

    protected function saveData(): void {
        echo "Saving processed JSON data to cloud storage...\n";
    }
}

// Usage
echo "Processing CSV:\n";
$csvProcessor = new CSVProcessor();
$csvProcessor->process();

echo "\nProcessing JSON:\n";
$jsonProcessor = new JSONProcessor();
$jsonProcessor->process();