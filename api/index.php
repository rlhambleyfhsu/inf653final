<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../model/db.php';
include_once '../model/quotes_db.php';
include_once '../model/authors_db.php';
include_once '../model/categories_db.php';

global $db;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $authorID = filter_input(INPUT_GET, 'authorId');
    $categoryID = filter_input(INPUT_GET, 'categoryId');
    $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
    //$random = htmlspecialchars(filter_input(INPUT_GET, 'random')) == 'true' ? true : false;

    echo $authorID;
    
    if ($authorID == "all") {
      $authors = getAuthors();
      echo json_encode($authors, JSON_NUMERIC_CHECK);
    }
    else if ($categoryID == 'all') {
      $categories = getCategories();
      echo json_encode($categories, JSON_NUMERIC_CHECK);
    }
    else {
      $quotes = getQuotes($authorID, $categoryID, $limit);
      //$quotes = $random ? ($quotes[mt_rand(0, count($quotes) - 1)]) : $quotes;
      echo json_encode($quotes, JSON_NUMERIC_CHECK);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SERVER["CONTENT_TYPE"])) {
        $data = array("message" => "Required: Content-Type header.");
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        $data = json_decode(file_get_contents("php://input"));
        $text = htmlspecialchars(strip_tags($data->quotetext));
        $authorID = htmlspecialchars(strip_tags($data->authorId));
        $categoryID = htmlspecialchars(strip_tags($data->categoryId));
        addQuote($text, $authorID, $categoryID, 0);
        $data = array("message" => "Quote submitted for approval.");
        echo json_encode($data);
    }
} else {
    $data = array("message" => "Invalid Request");
    echo json_encode($data);
}
