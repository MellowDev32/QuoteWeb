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

    // Get ID
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get Post
    $post->read_single();

    // Creat Array

    $post_arr = array(
        'id' => $post->id,
        'quote' => $post->quote,
        'authorID' => $post->authorID,
        'author_name' => $post->author_name,
        'categoryID' => $post->categoryID,
        'category_name' => $post->category_name
    );

    // Make JSON
    print_r(json_encode($post_arr));