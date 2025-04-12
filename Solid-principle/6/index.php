<?php


// Base class for all vehicles
abstract class Vehicle {
    protected $distance; 
    protected $time;

    public function __construct($distance, $time) {
        $this->distance = $distance;
        $this->time = max($time, 0.01);
    }

    public function calculateSpeed() {
        return $this->distance / $this->time; 
    }

    abstract public function getSpeedLimit();

    public function isOverSpeeding() {
        return $this->calculateSpeed() > $this->getSpeedLimit();
    }
}


// Subclass for bikes
class Bike extends Vehicle {
    public function getSpeedLimit() {
        return 120;
    }
}

// Subclass for cars
class Car extends Vehicle {
    public function getSpeedLimit() {
        return 80;
    }
}

// Subclass for airplanes
class Airplane extends Vehicle {
    public function getSpeedLimit() {
        return 180;
    }
}

function checkVehicleSpeed(Vehicle $vehicle) {
    echo "Vehicle Speed: " . $vehicle->calculateSpeed() . " km/h\n";
    echo "Speed Limit: " . $vehicle->getSpeedLimit() . " km/h\n";
    
    if ($vehicle->isOverSpeeding()) {
        echo "⚠ Warning: Over-speeding detected!\n";
    } else {
        echo "✅ Speed is within limit.\n";
    }
    echo "-----------------------------\n";
}

// Create instances of different vehicles
$bike = new Bike(100, 2);
$car = new Car(400, 2); 
$airplane = new Airplane(1800, 2);





// Check speeds
checkVehicleSpeed($bike);
checkVehicleSpeed($car);
checkVehicleSpeed($airplane);
