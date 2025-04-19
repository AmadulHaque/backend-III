<?php
abstract class BuildTool {
    // Template method
    final public function build() {
        $this->fetchDependencies();
        $this->runTests();
        $this->compile();
        $this->package();
        $this->deploy();
    }

    protected function fetchDependencies(): void {
        echo "Fetching dependencies...\n";
    }

    protected function runTests(): void {
        echo "Running tests...\n";
    }

    abstract protected function compile(): void;
    abstract protected function package(): void;

    protected function deploy(): void {
        // Optional hook
        // Default does nothing (can be overridden by subclasses)
    }
}

class JavaBuildTool extends BuildTool {
    protected function compile(): void {
        echo "Compiling Java sources...\n";
    }

    protected function package(): void {
        echo "Creating JAR file...\n";
    }
}

class PHPLaravelBuildTool extends BuildTool {
    protected function compile(): void {
        // PHP doesn't need compilation
        echo "Optimizing Laravel application...\n";
    }

    protected function package(): void {
        echo "Creating production-ready package...\n";
    }

    protected function deploy(): void {
        echo "Deploying to production server...\n";
    }
}

// Usage
echo "Java build process:\n";
$javaBuild = new JavaBuildTool();
$javaBuild->build();

echo "\nPHP Laravel build process:\n";
$phpBuild = new PHPLaravelBuildTool();
$phpBuild->build();