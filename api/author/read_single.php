<?php
    //HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require('../../config/Database.php');
    require('../../models/Author.php');

    // Instantiat DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Author object
    $auth = new Author($db);

     // Get ID
     $auth->id = (null !== filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) ? filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) : die();

     // Get Author
     $auth->read_single();
 
     // Creat Array
 
     $auth_arr = array(
         'id' => $auth->id,
         'author' => $auth->author
     );
 
     // Make JSON
     print_r(json_encode($auth_arr));