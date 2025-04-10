<?php

// Background: A web application requires logging for various events,
//  initially using a specific logging library. However, there might be 
// a need to replace or extend the logging system in the future
//  (e.g., to support a cloud-based logging service or custom logging formats).

// Question: How would you design the logging system to allow easy replacement 
// or addition of different logging implementations without modifying the main 


interface Logger
{
    public function log(string $message): void;
}

class FileLogger implements Logger
{
    public function __construct(private string $filename)
    {
        // Initialize the file logger
    }

    public function log(string $message): void
    {
        // Log to a file
    }
}

class DatabaseLogger implements Logger
{
    public function __construct(private string $connectionString)
    {
        // Initialize the database logger
    }
    
    public function log(string $message): void
    {
        // Log to a database
    }
}

class CloudLogger implements Logger
{
    public function __construct(private string $connectionString)
    {
        // Initialize the database logger
    }
    
    public function log(string $message): void
    {
        // Log to a database
    }
}

class LoggerFactory
{
    public function createLogger(string $type): Logger
    {
        switch ($type) {
            case 'file':
                return new FileLogger('log.txt');
            case 'database':
                return new DatabaseLogger('connection_string');
            case 'cloud':
                return new CloudLogger('connection_string');
            default:
                throw new Exception('Unsupported logger type');
        }
    }
}

$loggerFactory = new LoggerFactory();
$logger = $loggerFactory->createLogger('file');
$logger->log('Hello, world!');