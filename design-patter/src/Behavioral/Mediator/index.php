<?php

// Purpose of the Mediator Pattern

// Decouples components: Objects don't communicate directly but through the mediator
// Simplifies communication: Reduces the number of connections between objects from many-to-many to one-to-many
// Centralizes control: All interaction logic is contained in one place
// Improves maintainability: Easier to change how objects interact since it's all in one place


// Mediator interface
interface ChatRoomMediator {
    public function showMessage(User $user, string $message);
}

// Concrete Mediator
class ChatRoom implements ChatRoomMediator {
    public function showMessage(User $user, string $message) {
        $time = date('Y-m-d H:i:s');
        $sender = $user->getName();
        
        echo "[$time] $sender: $message\n";
    }
}

// Colleague/User class
class User {
    private $name;
    private $chatMediator;

    public function __construct(string $name, ChatRoomMediator $chatMediator) {
        $this->name = $name;
        $this->chatMediator = $chatMediator;
    }

    public function getName() {
        return $this->name;
    }

    public function send(string $message) {
        $this->chatMediator->showMessage($this, $message);
    }
}

// Usage example
$chatRoom = new ChatRoom();

$john = new User('John Doe', $chatRoom);
$jane = new User('Jane Doe', $chatRoom);

$john->send("Hi there!");
$jane->send("Hey John!");

