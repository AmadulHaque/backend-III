<?php

class CharacterMemento {
    private $level;
    private $health;
    private $inventory;

    public function __construct(int $level, int $health, array $inventory) {
        $this->level = $level;
        $this->health = $health;
        $this->inventory = $inventory;
    }

    public function getLevel(): int {
        return $this->level;
    }

    public function getHealth(): int {
        return $this->health;
    }

    public function getInventory(): array {
        return $this->inventory;
    }
}

class GameCharacter {
    private $level = 1;
    private $health = 100;
    private $inventory = [];

    public function levelUp() {
        $this->level++;
        $this->health = 100; // Restore health on level up
    }

    public function takeDamage(int $damage) {
        $this->health -= $damage;
        if ($this->health < 0) $this->health = 0;
    }

    public function addToInventory(string $item) {
        $this->inventory[] = $item;
    }

    public function getStatus(): string {
        return sprintf(
            "Level: %d, Health: %d, Inventory: %s\n",
            $this->level,
            $this->health,
            implode(', ', $this->inventory)
        );
    }

    public function save(): CharacterMemento {
        return new CharacterMemento(
            $this->level,
            $this->health,
            $this->inventory
        );
    }

    public function restore(CharacterMemento $memento) {
        $this->level = $memento->getLevel();
        $this->health = $memento->getHealth();
        $this->inventory = $memento->getInventory();
    }
}

class CheckpointManager {
    private $checkpoints = [];

    public function saveCheckpoint(CharacterMemento $memento) {
        $this->checkpoints[] = $memento;
    }

    public function loadLastCheckpoint(): ?CharacterMemento {
        if (empty($this->checkpoints)) {
            return null;
        }
        return array_pop($this->checkpoints);
    }
}

// Usage
$character = new GameCharacter();
$checkpointManager = new CheckpointManager();

// Initial state
$character->addToInventory("Sword");
echo "Initial state: " . $character->getStatus();

// Save checkpoint
$checkpointManager->saveCheckpoint($character->save());

// Play the game
$character->levelUp();
$character->takeDamage(30);
$character->addToInventory("Shield");
echo "After playing: " . $character->getStatus();

// Restore to last checkpoint
$lastCheckpoint = $checkpointManager->loadLastCheckpoint();
if ($lastCheckpoint !== null) {
    $character->restore($lastCheckpoint);
    echo "After restore: " . $character->getStatus();
}