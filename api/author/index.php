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

    //Author query
    $result = $auth->read();
    //get row count
    $num = $result->rowCount();

    // Check if any Authors
    if($num > 0){
        //Post array
        $auth_arr = array();
        $auth_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $auth_item = array(
                'id' => $id,
                'author' => $author
            );

            // Push to "data"
            array_push($auth_arr['data'], $auth_item);
        }

        // Turn to JSON & output
        echo json_encode($auth_arr);

    } else {
        // No Authors
        echo json_encode(
            array('message' => 'No Authors Found')
        );
    }