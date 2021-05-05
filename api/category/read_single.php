<?php
    //HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require('../../config/Database.php');
    require('../../models/Category.php');

    // Instantiat DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $cat = new Category($db);

    // Get ID
    $cat->id = (null !== filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) ? filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) : die();

    // Get Post
    $cat->read_single();

    // Creat Array

    $cat_arr = array(
        'id' => $cat->id,
        'category' => $cat->category
    );

    // Make JSON
    print_r(json_encode($cat_arr));
