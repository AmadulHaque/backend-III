<?php
interface TrafficLightState {
    public function change(TrafficLight $light);
    public function display(): string;
}

class RedLightState implements TrafficLightState {
    public function change(TrafficLight $light) {
        $light->setState(new GreenLightState());
    }

    public function display(): string {
        return "RED";
    }
}

class GreenLightState implements TrafficLightState {
    public function change(TrafficLight $light) {
        $light->setState(new YellowLightState());
    }

    public function display(): string {
        return "GREEN";
    }
}

class YellowLightState implements TrafficLightState {
    public function change(TrafficLight $light) {
        $light->setState(new RedLightState());
    }

    public function display(): string {
        return "YELLOW";
    }
}

class TrafficLight {
    private TrafficLightState $state;

    public function __construct() {
        $this->state = new RedLightState();
    }

    public function setState(TrafficLightState $state) {
        $this->state = $state;
    }

    public function change() {
        $this->state->change($this);
    }

    public function show() {
        echo "Current light: " . $this->state->display() . "\n";
    }
}

// Usage
$trafficLight = new TrafficLight();

for ($i = 0; $i < 6; $i++) {
    $trafficLight->show();
    $trafficLight->change();
    sleep(1); // Just for demonstration
}