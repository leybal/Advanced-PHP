<?php

namespace Layer\Manager;

/**
 * Class GroupManager
 * @package Layer\Manager
 */
class GroupManager implements ManagerInterface
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
              ->prepare('INSERT INTO groups (g_name, description) VALUES(:g_name, :description)');
            $statement->bindValue(':g_name', $entity['g_name']);
            $statement->bindValue(':description', $entity['description']);
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
          ->prepare('UPDATE users SET g_name=:g_name, description=:description WHERE id=:id');
        $statement->bindValue(':id', $entity['id']);
        $statement->bindValue(':g_name', $entity['g_name']);
        $statement->bindValue(':description', $entity['description']);
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
          ->prepare("DELETE FROM groups WHERE id = :id");
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
        if ($entityName == 'Group') {
            $statement = $this->pdo->connect()
              ->prepare('SELECT * FROM groups WHERE id = :id LIMIT 1');
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
        if ($entityName == 'Group') {
            $statement = $this->pdo->connect()
              ->prepare('SELECT * FROM groups LIMIT :limit OFFSET :offset');
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
              'g_name' => $result['g_name'],
              'description' => $result['description'],
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
        if ($entityName == 'Group') {
            $statement = $this->pdo->connect()
              ->prepare('SELECT * FROM groups WHERE g_name=:g_name AND description=:description');
            $statement->bindValue(':g_name', $criteria['g_name']);
            $statement->bindValue(':description', $criteria['description']);
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
              'g_name' => $result[$i]['g_name'],
              'description' => $result[$i]['description']
            ];
            ++$i;
        }
        return $results;
    }
}