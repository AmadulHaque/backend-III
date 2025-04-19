<?php

// Purpose of the Iterator Pattern ::
// Encapsulation of traversal logic: Keeps the traversal logic separate from the aggregate object
// Uniform interface: Provides a standard way to iterate different collections
// Multiple simultaneous traversals: Allows multiple iterations of the same collection simultaneously
// Simplifies collection interface: Removes the need for bulky collection interfaces with traversal methods



// Iterator interface
interface MyIterator {
    public function current();
    public function next();
    public function key();
    public function valid();
    public function rewind();
}

// Aggregate interface
interface MyIterableCollection {
    public function getIterator(): MyIterator;
}

// Concrete collection
class BookCollection implements MyIterableCollection {
    private $books = [];

    public function addBook(string $book) {
        $this->books[] = $book;
    }

    public function getIterator(): MyIterator {
        return new BookIterator($this);
    }

    public function getCount(): int {
        return count($this->books);
    }

    public function getBook(int $index): string {
        return $this->books[$index] ?? null;
    }
}

// Concrete iterator
class BookIterator implements MyIterator {
    private $collection;
    private $position = 0;

    public function __construct(BookCollection $collection) {
        $this->collection = $collection;
    }

    public function current() {
        return $this->collection->getBook($this->position);
    }

    public function next() {
        $this->position++;
    }

    public function key() {
        return $this->position;
    }

    public function valid() {
        return $this->position < $this->collection->getCount();
    }

    public function rewind() {
        $this->position = 0;
    }
}

// Usage example
$collection = new BookCollection();
$collection->addBook("Design Patterns");
$collection->addBook("Clean Code");
$collection->addBook("Refactoring");

$iterator = $collection->getIterator();

echo "Books in collection:\n";
for ($iterator->rewind(); $iterator->valid(); $iterator->next()) {
    echo "- " . $iterator->current() . "\n";
}

// Alternatively using while
echo "\nBooks again:\n";
$iterator->rewind();
while ($iterator->valid()) {
    echo "- " . $iterator->current() . "\n";
    $iterator->next();
}