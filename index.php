<?php

// Models and Database
require('config/Database.php');
require('models/Author.php');
require('models/Category.php');
require('models/Post.php');

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Create Objects
$quote = new Post($db);
$author = new Author($db);
$category = new Category($db);

$authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
$categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
$lim = filter_input(INPUT_GET, 'lim', FILTER_VALIDATE_INT); //limit

// Get Request Quote Data 
if ($authorId) { $quote->authorId = $authorId; }
if ($categoryId) { $quote->categoryId = $categoryId; }
if ($lim) { $quote->lim = $lim;}

// Read Data
$quotes = $quote->read();
$authors = $author->read();
$categories = $category->read();
if($authorID && $categoryID){
    $quotes_auth_cat = $quote->read_auth_cat();
} else if ($authorID){
    $quotes_auth = $quote->read_author();
} else if ($categoryID){
    $quotes_cat = $quote->read_category();
}

include('view/list_quotes.php');