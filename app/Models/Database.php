<?php

class Database
{
    /* @property string $name */
    private $name;

    /* @property string $host */
    private $host;

    /* @property string $user */
    private $user;

    /* @property string $password */
    private $password;

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
