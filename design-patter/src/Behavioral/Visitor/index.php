<?php

// Purpose of the Visitor Pattern

// Separation of concerns: Keeps operations separate from object structure
// Extensibility: Easily add new operations without changing visited classes
// Multiple operations: Perform different operations on the same object structure
// Clean object classes: Avoid polluting classes with unrelated operations

// Key Components

// Visitor Interface: Declares visit methods for each concrete element type
// Concrete Visitors: Implement the operations defined in the visitor interface
// Element Interface: Defines an accept method that takes a visitor
// Concrete Elements: Implement the accept method to dispatch to the visitor



interface DocumentElement {
    public function accept(DocumentVisitor $visitor);
}

// Concrete elements
class TextElement implements DocumentElement {
    private $text;

    public function __construct(string $text) {
        $this->text = $text;
    }

    public function getText(): string {
        return $this->text;
    }

    public function accept(DocumentVisitor $visitor) {
        $visitor->visitText($this);
    }
}

class HeadingElement implements DocumentElement {
    private $text;
    private $level;

    public function __construct(string $text, int $level) {
        $this->text = $text;
        $this->level = $level;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getLevel(): int {
        return $this->level;
    }

    public function accept(DocumentVisitor $visitor) {
        $visitor->visitHeading($this);
    }
}

class Document {
    private $elements = [];

    public function addElement(DocumentElement $element) {
        $this->elements[] = $element;
    }

    public function accept(DocumentVisitor $visitor) {
        foreach ($this->elements as $element) {
            $element->accept($visitor);
        }
    }
}

// Visitor interface
interface DocumentVisitor {
    public function visitText(TextElement $text);
    public function visitHeading(HeadingElement $heading);
}

// Concrete visitors
class HTMLExportVisitor implements DocumentVisitor {
    private $output = '';

    public function visitText(TextElement $text) {
        $this->output .= '<p>' . htmlspecialchars($text->getText()) . '</p>';
    }

    public function visitHeading(HeadingElement $heading) {
        $this->output .= sprintf(
            '<h%d>%s</h%d>',
            $heading->getLevel(),
            htmlspecialchars($heading->getText()),
            $heading->getLevel()
        );
    }

    public function getHTML(): string {
        return $this->output;
    }
}

class PlainTextExportVisitor implements DocumentVisitor {
    private $output = '';

    public function visitText(TextElement $text) {
        $this->output .= $text->getText() . "\n\n";
    }

    public function visitHeading(HeadingElement $heading) {
        $this->output .= strtoupper($heading->getText()) . "\n";
        $this->output .= str_repeat('=', strlen($heading->getText())) . "\n\n";
    }

    public function getText(): string {
        return $this->output;
    }
}

// Usage
$document = new Document();
$document->addElement(new HeadingElement('Welcome', 1));
$document->addElement(new TextElement('This is a sample document.'));
$document->addElement(new HeadingElement('Features', 2));
$document->addElement(new TextElement('It demonstrates the Visitor pattern.'));

// Export to HTML
$htmlVisitor = new HTMLExportVisitor();
$document->accept($htmlVisitor);
echo "HTML Export:\n" . $htmlVisitor->getHTML() . "\n\n";

// Export to plain text
$textVisitor = new PlainTextExportVisitor();
$document->accept($textVisitor);
echo "Plain Text Export:\n" . $textVisitor->getText();