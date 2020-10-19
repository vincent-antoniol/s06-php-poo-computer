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
