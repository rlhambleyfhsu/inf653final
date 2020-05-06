<?php
$error_username = "";
$error_password = "";
if (!empty($_POST)) {
    require_once('./model/admin.php');
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    if (empty($username) || empty($password)) {
        if (empty($username)) {
            $error_username = "Please include username";
        } else {
            $error_password = "Please include password";
        }
    } else {
        if (is_valid_admin_login($username, $password)) {
            session_status() === PHP_SESSION_ACTIVE ? '' : session_start();
            $_SESSION["is_valid_admin"] = true;
            header("Location: ./admin.php");
        } else {
            $error_password = "Incorrect Password";
        }
    }
}
?>
<section>
    <h1>Admin Login</h1>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div>
                <div>
                    <input type="text" name="username" id="username" placeholder="Username" />
                    <p><?php echo $error_username ?></p>
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="Password" />
                    <p><?php echo $error_password ?></p>
                </div>
                <div>
                    <button type="submit">Login</button>
                </div>
        </form>
    </div>
</section>
