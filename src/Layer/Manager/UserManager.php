<?php

namespace Layer\Manager;

/**
 * Class UserManager
 * @package Layer\Manager
 */
class UserManager implements ManagerInterface
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert($entity)
    {
        if ($entity) {
            $statement = $this->pdo->connect()
              ->prepare('INSERT INTO users (name, email) VALUES(:name, :email)');
            $statement->bindValue(':name', $entity['name']);
            $statement->bindValue(':email', $entity['email']);
            return $statement->execute();
        }
    }

    /**
     * Update exist entity data in the DB
     * @param $entity
     * @return mixed
     */
    public function update($entity)
    {
        $statement = $this->pdo->connect()
          ->prepare('UPDATE users SET name=:name, email=:email WHERE id=:id');
        $statement->bindValue(':id', $entity['id']);
        $statement->bindValue(':name', $entity['name']);
        $statement->bindValue(':email', $entity['email']);
        return $statement->execute();
    }

    /**
     * Delete entity data from the DB
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        $statement = $this->pdo->connect()
          ->prepare("DELETE FROM users WHERE id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        return $statement->execute();

    }

    /**
     * Search entity data in the DB by Id
     * @param $entityName
     * @param $id
     * @return mixed
     */
    public function find($entityName, $id)
    {
        if ($entityName == 'User') {
            $statement = $this->pdo->connect()
              ->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
            $statement->bindValue(':id', (int) $id, \PDO::PARAM_INT);
            $statement->execute();
            return $this->fetchUserData($statement);
        }
    }

    /**
     * Search all entity data in the DB
     * @param $entityName
     * @return array
     */
    public function findAll($entityName, $limit = 100, $offset = 0)
    {
        if ($entityName == 'User') {
            $statement = $this->pdo->connect()
              ->prepare('SELECT * FROM users LIMIT :limit OFFSET :offset');
            $statement->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
            $statement->bindValue(':offset', (int) $offset, \PDO::PARAM_INT);
            $statement->execute();
            return $this->fetchUserData($statement);
        }
    }

    private function fetchUserData($statement)
    {
        $results = array();
        while ($result = $statement->fetch()) {
            $results[] = [
              'id' => $result['id'],
              'name' => $result['name'],
              'email' => $result['email'],
            ];
        }
        return $results;
    }

    /**
     * Search all entity data in the DB like $criteria rules
     * @param $entityName
     * @param array $criteria
     * @return mixed
     */
    public function findBy($entityName, $criteria = array())
    {
        if ($entityName == 'User') {
            $statement = $this->pdo->connect()
              ->prepare('SELECT * FROM users WHERE name=:name AND email=:email');
            $statement->bindValue(':name', $criteria['name']);
            $statement->bindValue(':email', $criteria['email']);
            $statement->execute();
            return $this->fetchAllUserData($statement);
        }
    }

    private function fetchAllUserData($statement)
    {
        $results = array();
        $i = 0;
        while ($result = $statement->fetchAll()) {
            $results[$i] = [
              'id' => $result[$i]['id'],
              'name' => $result[$i]['name'],
              'email' => $result[$i]['email']
            ];
            ++$i;
        }
        return $results;
    }
}