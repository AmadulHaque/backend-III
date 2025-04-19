<?php
class BookCollection implements IteratorAggregate {
    private $books = [];

    public function addBook(string $book) {
        $this->books[] = $book;
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->books);
    }
}

// Usage
$collection = new BookCollection();
$collection->addBook("PHP Cookbook");
$collection->addBook("Modern PHP");

foreach ($collection as $book) {
    echo $book . "\n";
}