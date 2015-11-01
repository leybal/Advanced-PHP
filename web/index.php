<?php

require __DIR__ . '/../config/autoload.php';

use Layer\Connector\ConnectorClass;
use Layer\Manager\UserManager;
use Layer\Manager\GroupManager;

$pdo = new ConnectorClass($config["db_name"], $config["db_user"], $config["db_password"]);

$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'User';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

if ($controllerName == 'User') {
    $user = new UserManager($pdo);

    switch ($actionName) {
        case 'index':
            $response = $user->findAll($controllerName);
            $_POST['response'] = $response;
            require_once './templates/users.tpl.php';
            break;
        case 'new':
            require_once './templates/newUser.tpl.php';
            break;
        case 'saveNew':
            $response = $_GET;
            $user->insert($response);
            require_once './templates/saveSuccessfully.tpl.php';
            break;
        case 'delete':
            require_once './templates/delete.tpl.php';
            break;
        case 'finalDelete':
            $user->remove($_GET['id']);
            $response = $user->findAll($controllerName);
            $_POST['response'] = $response;
            require_once './templates/users.tpl.php';
            break;
        case 'edit':
            $response = $user->find($controllerName, $_GET['id']);
            $_POST['response'] = $response[0];
            require_once './templates/edit.tpl.php';
            break;
        case 'finalEdit':
            $entity['id'] = $_GET['id'];
            $entity['name'] = $_GET['name'];
            $entity['email'] = $_GET['email'];
            $user->update($entity);
            $response = $user->findAll($controllerName);
            $_POST['response'] = $response;
            require_once './templates/users.tpl.php';
            break;
        case 'findBy':
            require_once './templates/findBy.tpl.php';
            break;
        case 'findList':
            $criteria = $_GET;
            $response = $user->findBy($controllerName, $criteria);
            $_POST['response'] = $response;
            require_once './templates/users.tpl.php';
            break;
    }
}