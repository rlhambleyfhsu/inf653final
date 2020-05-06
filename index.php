<?php
require('./model/db.php');
require('./model/quotes_db.php');
require('./model/authors_db.php');
require('./model/categories_db.php');

$authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
$categoryID = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
$random = filter_input(INPUT_GET, 'random', FILTER_VALIDATE_INT);
$sortDirection = filter_input(INPUT_GET, 'sortDirection', FILTER_VALIDATE_INT);
$authors = getAuthors();
$categories = getCategories();

//echo $categoryID;
$quotes = getQuotes($authorID, $categoryID, 0);
$quotes = $random == 'true' ? ($quotes[mt_rand(0, count($quotes) - 1)]) : $quotes;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authorIDSubmit = filter_input(INPUT_POST, 'authorIDSubmit', FILTER_VALIDATE_INT);
    $categoryIDSubmit = filter_input(INPUT_POST, 'categoryIDSubmit', FILTER_VALIDATE_INT);
    $textsubmit = htmlspecialchars(filter_input(INPUT_POST, 'textsubmit'));
    addQuote($textsubmit, $authorIDSubmit, $categoryIDSubmit, false);
}

$loggedIn = false;
$approval = false;

include('view/header.php');
include('view/nav.php');
include('view/quotes.php');
include('view/footer.php');
?>
