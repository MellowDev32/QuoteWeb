<?php
    //HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require('../../config/Database.php');
    require('../../models/Post.php');

    // Instantiat DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new Post($db);

    //Blog post query
    $result = $post->read();
    //get row count
    $num = $result->rowCount();

    // Check if any posts
    if($num > 0){
        //Post array
        $posts_arr = array();
        $posts_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                'id' => $id,
                'quote' => $quote,
                'author_name' => $author_name,
                'authorID' => $authorID,
                'categoryID' => $categoryID,
                'category_name' => $category_name
            );

            // Push to "data"
            array_push($posts_arr['data'], $post_item);
        }

        // Turn to JSON & output
        echo json_encode($posts_arr);

    } else {
        // No posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }