<?php

class Database
{
    private string $name;
    private string $host;
    private string $user;
    private string $password;

    public function __construct(string $host, string $name, string $user, string $password)
    {
        $this->password = $password;
        $this->user = $user;
        $this->host = $host;
        $this->name = $name;
    }

    public function getConnection(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";

        return new PDO($dsn, $this->user, $this->password, [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false
        ]);
    }
}









