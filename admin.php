<?php
require('./model/db.php');
require('./model/quotes_db.php');
require('./model/authors_db.php');
require('./model/categories_db.php');
require('./model/admin.php');

session_status() === PHP_SESSION_ACTIVE ? '' : session_start();
$loggedIn = isset($_SESSION['is_valid_admin']);

$loggedIn = true;
$display = '';
$approval = false;
$quotes = [];

if (!empty($_POST)) {
    $action = filter_input(INPUT_POST, 'action');
    $quoteID = filter_input(INPUT_POST, 'quoteID');
} else {
    $action = filter_input(INPUT_GET, 'action');
}
if (!$loggedIn) {
    $display = 'view/login.php';
    $display = 'view/quotes.php';
} else if ($action == "approvals") {
    $quotes = getApprovals();
    $approval = true;
    $display = 'view/quotes.php';
} else if ($action == 'delete') {
    deleteQuote($quoteID);
    header("Location: admin.php");
} else if ($action == 'approve') {
    approveQuote($quoteID);
    header("Location: admin.php");
} else if ($action == 'logout') {
    session_unset();
    session_destroy();
    $name = session_name();
    $expire = strtotime('-1 year');
    $params = session_get_cookie_params();
    $path = $params['path'];
    $domain = $params['domain'];
    $secure = $params['secure'];
    $httponly = $params['httponly'];
    setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
    header("Location: admin.php");
} else if ($action == "submit") {
    $authorIDSubmit = filter_input(INPUT_POST, 'authorIDSubmit', FILTER_VALIDATE_INT);
    $categoryIDSubmit = filter_input(INPUT_POST, 'categoryIDSubmit', FILTER_VALIDATE_INT);
    $textsubmit = htmlspecialchars(filter_input(INPUT_POST, 'textsubmit'));
    addQuote($textsubmit, $authorIDSubmit, $categoryIDSubmit, true);
    header("Location: admin.php");
} else if ($action == "editcategories") {
    $categories = getCategories();
    $display = 'view/categories.php';
}  else if ($action == "editauthors") {
    $categories = getAuthors();
    $display = 'view/authors.php';
}  else if ($action == "addcategories") {
    $cat = $_POST['categoryName'];
    addCategory($cat);
    $display = 'view/categories.php';
}  else if ($action == "addauthors") {
    $an = $_POST['authorName'];
    addAuthor($an);
    $display = 'view/authors.php';
}  else if ($action == "delcategories") {
    $catid = $_POST['catid'];
    //echo "here";
    //echo $catid;
    delCategory($catid);
    $display = 'view/categories.php';
}  else if ($action == "delauthors") {
    $anid = $_POST['authid'];
    delAuthor($anid);
    $display = 'view/authors.php';
}   else if ($action == "administrators") {
    $display = 'view/administrators.php';
    #include ( 'view/administrators.php');
} else if ($action == "addadmin") {

  if (isset($_POST['username']) && isset($_POST['password'] )) {
    $un = $_POST['username'];
    $pw = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
  }
  $error_username = (!empty($un) && (strlen($un)>5) && check_username($un))?true:false;
  $error_password = (!empty($pw) && (strlen($pw)>7) && preg_match('@[A-Z]@',$pw)&&preg_match('@[a-z]@',$pw)&&preg_match('@[0-9]@',$pw))?true:false;
  $error_confirm = ($pw == $confirm_password);
  if ($error_username && $error_password && $error_confirm)
  {
    add_admin($un, $pw);
    echo "Admin $un Added";
  }
  else {
    echo "Incorrect Username/Password";
  }
    $display = 'view/administrators.php';
    #include ( 'view/administrators.php');
}else {
    $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
    $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
    $quotes = getQuotes($authorID, $categoryID, 0);
    $display = 'view/quotes.php';
}
$authors = getAuthors();
$categories = getCategories();

include('view/header.php');
include('view/nav_admin.php');
include($display);
include('view/footer.php');
?>
