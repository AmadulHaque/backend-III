<?php


// Definition: Defines a one-to-many dependency between objects so that when one object changes state, 
// all its dependents are notified and updated automatically.
// Purpose: Notifies dependent objects when the subject changes.


// Subject interface
interface Observable {
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

// Observer interface
interface Observer {
    public function update(Observable $subject);
}

// Concrete subject
class WeatherStation implements Observable {
    private $observers = [];
    private $temperature;
    
    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }
    
    public function detach(Observer $observer) {
        foreach ($this->observers as $key => $obs) {
            if ($obs === $observer) {
                unset($this->observers[$key]);
                break;
            }
        }
    }
    
    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
    
    public function setTemperature(float $temperature) {
        $this->temperature = $temperature;
        $this->notify();
    }
    
    public function getTemperature(): float {
        return $this->temperature;
    }
}

// Concrete observers
class PhoneDisplay implements Observer {
    public function update(Observable $subject) {
        if ($subject instanceof WeatherStation) {
            $temp = $subject->getTemperature();
            echo "Phone Display: Temperature updated to {$temp}°C" . PHP_EOL;
        }
    }
}

class WebsiteDisplay implements Observer {
    public function update(Observable $subject) {
        if ($subject instanceof WeatherStation) {
            $temp = $subject->getTemperature();
            echo "Website Display: Weather now showing {$temp}°C" . PHP_EOL;
        }
    }
}

// Client code
$weatherStation = new WeatherStation();

$phoneDisplay = new PhoneDisplay();
$websiteDisplay = new WebsiteDisplay();

$weatherStation->attach($phoneDisplay);
$weatherStation->attach($websiteDisplay);

$weatherStation->setTemperature(25.5);
// Output:
// Phone Display: Temperature updated to 25.5°C
// Website Display: Weather now showing 25.5°C

$weatherStation->detach($phoneDisplay);
$weatherStation->setTemperature(26.8);
// Output:
// Website Display: Weather now showing 26.8°C
?>