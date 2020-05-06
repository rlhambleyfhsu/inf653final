<?php
//session_start();
#require('../model/db.php');
//require_once('../model/admin.php');
//require_once('util/valid_admin.php');
?>
<?php
$username = '';
$password = '';
$confirm_password ='';
$error_username = true;
$error_password = true;
$error_confirm = true;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'administrators';
    }
}
//echo $action;
if ($action == 'register')
{
  if (isset($_POST['username']) && isset($_POST['password'] )) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
  }

  $error_username = (!empty($username) && (strlen($username)>4) && check_username($username))?true:false;
  $error_password = (!empty($password) && (strlen($password)>4))?true:false;
  $error_confirm = ($password == $confirm_password);
  if ($error_username && $error_password && $error_confirm)
  {
    add_admin($username, $password);
    echo "Admin $username Added";
    include('admin.php');
  }
  else {
    $action ='administrators';
    include('admin.php');
  }
}
if ($action == 'administrators')
{
   ?>
  <main>
      <h2>Admin Login</h2>
      <form action="admin.php" method="POST" id="addadmin"  >
        <div>
          <input type="hidden" name="action" value="addadmin">
          <label>Username:*</label>
          <input type="text" name="username"/> <?php if (!$error_username) { echo "<font color = red>Please enter a username </font> ";}?>
          <P>
          <label>Password:*</label>
          <input type="text" name="password" /> <?php if (!$error_password) { echo "<font color = red> Your password must be 8 characters or more and contain at least one number, one lower case and one uppercase letter </font><p>";} ?>
          <P>
          <label>Confirm Password:*</label>
          <input type="text" name="confirm_password"  /> <?php if (!$error_confirm) { echo "<font color = red> Passwords did not match  </font><p>";} ?>
          <input  id="button" type="submit" value="Add Admin" />
        </div>
      </form>
      * Indicates a required field.
  </main>
<?php }
?>
