<?php
    //HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authroization, X-Requested-With');

    require('../../config/Database.php');
    require('../../models/Category.php');

    // Instantiat DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $cat = new Category($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to delete
    $cat->id = $data->id;

    // Delete category
    if($cat->delete()){
        echo json_encode(
            array('message' => 'Category Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Category Not Deleted')
        );
    }