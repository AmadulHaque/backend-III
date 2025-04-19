<?php
interface CartItem {
    public function accept(CartVisitor $visitor);
}

class Book implements CartItem {
    private $price;
    private $isbn;

    public function __construct(float $price, string $isbn) {
        $this->price = $price;
        $this->isbn = $isbn;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getIsbn(): string {
        return $this->isbn;
    }

    public function accept(CartVisitor $visitor) {
        $visitor->visitBook($this);
    }
}

class Fruit implements CartItem {
    private $price;
    private $weight;
    private $name;

    public function __construct(float $pricePerKg, float $weight, string $name) {
        $this->price = $pricePerKg;
        $this->weight = $weight;
        $this->name = $name;
    }

    public function getPricePerKg(): float {
        return $this->price;
    }

    public function getWeight(): float {
        return $this->weight;
    }

    public function getName(): string {
        return $this->name;
    }

    public function accept(CartVisitor $visitor) {
        $visitor->visitFruit($this);
    }
}

interface CartVisitor {
    public function visitBook(Book $book);
    public function visitFruit(Fruit $fruit);
}

class TaxCalculatorVisitor implements CartVisitor {
    private $totalTax = 0;

    public function visitBook(Book $book) {
        // Books have 5% tax
        $this->totalTax += $book->getPrice() * 0.05;
    }

    public function visitFruit(Fruit $fruit) {
        // Fruits have no tax
        $this->totalTax += 0;
    }

    public function getTotalTax(): float {
        return $this->totalTax;
    }
}

class PriceCalculatorVisitor implements CartVisitor {
    private $totalPrice = 0;

    public function visitBook(Book $book) {
        $this->totalPrice += $book->getPrice();
    }

    public function visitFruit(Fruit $fruit) {
        $this->totalPrice += $fruit->getPricePerKg() * $fruit->getWeight();
    }

    public function getTotalPrice(): float {
        return $this->totalPrice;
    }
}

// Usage
$cart = [
    new Book(19.99, '123-4567890'),
    new Fruit(2.99, 1.5, 'Apples'),
    new Book(9.99, '987-6543210'),
    new Fruit(1.99, 0.5, 'Bananas')
];

$taxVisitor = new TaxCalculatorVisitor();
$priceVisitor = new PriceCalculatorVisitor();

foreach ($cart as $item) {
    $item->accept($taxVisitor);
    $item->accept($priceVisitor);
}

echo "Total price: $" . number_format($priceVisitor->getTotalPrice(), 2) . "\n";
echo "Total tax: $" . number_format($taxVisitor->getTotalTax(), 2) . "\n";
echo "Total with tax: $" . 
     number_format($priceVisitor->getTotalPrice() + $taxVisitor->getTotalTax(), 2) . "\n";