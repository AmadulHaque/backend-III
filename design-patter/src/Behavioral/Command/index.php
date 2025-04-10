<?php

// Definition: Encapsulates a request as an object, allowing for parameterization of clients with different requests,
//  queuing of requests, and logging of operations.
// Purpose: Decouples object that invokes the operation from the one that knows how to perform it.


// Command interface
interface Command {
    public function execute();
}

// Concrete commands
class LightOnCommand implements Command {
    private $light;
    
    public function __construct($light) {
        $this->light = $light;
    }
    
    public function execute() {
        $this->light->turnOn();
    }
}

class LightOffCommand implements Command {
    private $light;
    
    public function __construct($light) {
        $this->light = $light;
    }
    
    public function execute() {
        $this->light->turnOff();
    }
}

// Receiver
class Light {
    private $location;
    
    public function __construct($location) {
        $this->location = $location;
    }
    
    public function turnOn() {
        echo "The {$this->location} light is ON" . PHP_EOL;
    }
    
    public function turnOff() {
        echo "The {$this->location} light is OFF" . PHP_EOL;
    }
}

// Invoker
class RemoteControl {
    private $command;
    
    public function setCommand(Command $command) {
        $this->command = $command;
    }
    
    public function pressButton() {
        $this->command->execute();
    }
}

// Client code
$livingRoomLight = new Light("living room");
$kitchenLight = new Light("kitchen");

$livingRoomLightOn = new LightOnCommand($livingRoomLight);
$livingRoomLightOff = new LightOffCommand($livingRoomLight);
$kitchenLightOn = new LightOnCommand($kitchenLight);
$kitchenLightOff = new LightOffCommand($kitchenLight);

$remote = new RemoteControl();

// Turn on living room light
$remote->setCommand($livingRoomLightOn);
$remote->pressButton();

// Turn on kitchen light
$remote->setCommand($kitchenLightOn);
$remote->pressButton();

// Turn off all lights
$remote->setCommand($livingRoomLightOff);
$remote->pressButton();
$remote->setCommand($kitchenLightOff);
$remote->pressButton();
