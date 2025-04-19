<?php


// Purpose of the Memento Pattern

// State preservation: Save an object's state for later restoration
// Undo/Redo functionality: Implement undo mechanisms without violating encapsulation
// Snapshot capability: Capture checkpoints of an object's state
// Non-intrusive: Doesn't require changes to the original object's code

// Key Components

// Originator: The object whose state needs to be saved
// Memento: The object that stores the saved state
// Caretaker: Manages and keeps track of multiple mementos

// Memento class
class TextMemento {
    private $text;
    private $date;

    public function __construct(string $text) {
        $this->text = $text;
        $this->date = date('Y-m-d H:i:s');
    }

    public function getText(): string {
        return $this->text;
    }

    public function getDate(): string {
        return $this->date;
    }
}

// Originator class
class TextEditor {
    private $text = '';

    public function write(string $text) {
        $this->text .= $text;
    }

    public function getText(): string {
        return $this->text;
    }

    public function save(): TextMemento {
        return new TextMemento($this->text);
    }

    public function restore(TextMemento $memento) {
        $this->text = $memento->getText();
    }
}

// Caretaker class
class History {
    private $mementos = [];

    public function addMemento(TextMemento $memento) {
        $this->mementos[] = $memento;
    }

    public function getLastMemento(): ?TextMemento {
        if (empty($this->mementos)) {
            return null;
        }
        return array_pop($this->mementos);
    }
}

// Usage example
$editor = new TextEditor();
$history = new History();

// Type some text and save states
$editor->write("Hello ");
$history->addMemento($editor->save());

$editor->write("World!");
$history->addMemento($editor->save());

$editor->write(" How are you?");
echo "Current text: " . $editor->getText() . "\n";

// Undo last change
$lastState = $history->getLastMemento();
if ($lastState !== null) {
    $editor->restore($lastState);
    echo "After undo: " . $editor->getText() . "\n";
}

// Undo again
$lastState = $history->getLastMemento();
if ($lastState !== null) {
    $editor->restore($lastState);
    echo "After second undo: " . $editor->getText() . "\n";
}