<?php

interface ComponentMediator {
    public function notify(object $sender, string $event): void;
}

// Concrete Mediator
class ConcreteMediator implements ComponentMediator {
    private $component1;
    private $component2;

    public function __construct(
        Component1 $component1, 
        Component2 $component2
    ) {
        $this->component1 = $component1;
        $this->component1->setMediator($this);
        $this->component2 = $component2;
        $this->component2->setMediator($this);
    }

    public function notify(object $sender, string $event): void {
        if ($event === "A") {
            echo "Mediator reacts on A and triggers following operations:\n";
            $this->component2->doC();
        }

        if ($event === "D") {
            echo "Mediator reacts on D and triggers following operations:\n";
            $this->component1->doB();
            $this->component2->doC();
        }
    }
}

// Base Component
class BaseComponent {
    protected $mediator;

    public function setMediator(ComponentMediator $mediator): void {
        $this->mediator = $mediator;
    }
}

// Concrete Component 1
class Component1 extends BaseComponent {
    public function doA(): void {
        echo "Component 1 does A.\n";
        $this->mediator->notify($this, "A");
    }

    public function doB(): void {
        echo "Component 1 does B.\n";
        $this->mediator->notify($this, "B");
    }
}

// Concrete Component 2
class Component2 extends BaseComponent {
    public function doC(): void {
        echo "Component 2 does C.\n";
        $this->mediator->notify($this, "C");
    }

    public function doD(): void {
        echo "Component 2 does D.\n";
        $this->mediator->notify($this, "D");
    }
}

// Usage
$c1 = new Component1();
$c2 = new Component2();
$mediator = new ConcreteMediator($c1, $c2);

echo "Client triggers operation A.\n";
$c1->doA();

echo "\nClient triggers operation D.\n";
$c2->doD();