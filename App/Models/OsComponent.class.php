<?php

require_once './App/Models/Component.class.php';

final class OsComponent extends Component
{

}

function createOsComponent($id, $name, $price, $brandId) {
    return new OsComponent($id, $name, $price, $brandId);
}

function fetchAllOsComponents() {
    global $databaseHandler;

    $statement = $databaseHandler->query('SELECT * FROM `os`');
    return $statement->fetchAll(PDO::FETCH_FUNC, 'createOsComponent');
}

function fetchOsComponentById(int $id): ?OsComponent {
    global $databaseHandler;

    $statement = $databaseHandler->prepare('SELECT * FROM `os` WHERE `id` = :id');
    $statement->execute([ ':id' => $id ]);
    $result = $statement->fetchAll(PDO::FETCH_FUNC, 'createOsComponent');
    
    if (empty($result)) {
        return null;
    }

    return $result[0];
}
