<?php

class MyApi
{
    private static $instance;
    private static $indexcallname;
    private static $db;

    private function __construct()
    {
        # code...
    }

    public function getDB(): SimpleDB
    {
        return self::$db;
    }

    public function setDB(SimpleDB $db): void
    {
        self::$db = $db;
    }

    public function getInstance(): MyApi
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function register(string $callname, string $method, Closure $callback): void
    {
        $this->indexcallname[$method][$callname] = $callback;
    }

    public function get(string $callname): string
    {
        return $this->call($callname, "GET");
    }

    public function post(string $callname): string
    {
        return $this->call($callname, "POST");
    }

    public function put(string $callname): string
    {
        return $this->call($callname, "PUT");
    }

    public function remove(string $callname): string
    {
        return $this->call($callname, "REMOVE");
    }

    public function call(string $callname, string $method, array $args): string
    {
        return isset($this->indexcallname[$method][$callname]) ? $this->indexcallname[$method][$callname]($args) : $this->error();
    }

    private function error(): string
    {
        return json_encode(array("status" => "Unknown command"));
    }
}

class eMyApiMethods
{
    const GET = "GET";
    const POST = "POST";
    const PUT = "PUT";
    const DELETE = "DELETE";
    const REMOVE = "DELETE";
}