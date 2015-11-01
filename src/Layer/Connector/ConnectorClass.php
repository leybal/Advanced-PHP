<?php

namespace Layer\Connector;

class ConnectorClass implements ConnectorInterface
{
    private $pdo;

    public function  __construct($databasename, $user, $password)
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=' . $databasename . ';charset=UTF8', $user, $password);
        if (!$this->pdo) {
            return false;
        }
    }

    /**
     * @return \PDO
     */
    public function connect()
    {
        return $this->pdo;
    }

    /**
     * @return null
     */
    public function connectClose()
    {
        return $this->pdo = null;
    }

}