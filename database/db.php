<?php
class DB {
    private $driver;
    public function __construct($driver, $hostname, $username, $password, $database) {
        $file = $driver . '.php';
        if (file_exists($file)) {
            require_once($file);
            $class = 'DB' . $driver;
            $this->driver = new $class($hostname, $username, $password, $database);
        } else exit('Error: Could not load database driver type ' . $driver . '!');
    }
    public function query($sql) {
        return $this->driver->query($sql);
    }
    public function getLastId() {
        return $this->driver->getLastId();
    }
} ?>