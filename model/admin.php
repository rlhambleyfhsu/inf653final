<?php
    require('./model/db.php');
    function add_admin($username, $password) {
     global $db;
     $hash = password_hash($password, PASSWORD_DEFAULT);
     $query = 'INSERT INTO administrators (username, password)
               VALUES (:username, :password)';
     $statement = $db->prepare($query);
     $statement->bindValue(':username', $username);
     $statement->bindValue(':password', $hash);
     $statement->execute();
     $statement->closeCursor();
    }
    function is_username_active($username) {
        global $db;
        $query = 'SELECT count(*)
                FROM administrators
                WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        $statement->closeCursor();
        return $result == 1 ? true : false;
    }
    function check_username($username) {
     global $db;
     $query = 'SELECT * FROM administrators WHERE username = :username';
     $statement = $db->prepare($query);
     $statement->bindValue(':username', $username);
     //echo "\n username = ";
     //echo $username;
     $statement->execute();
     $test = $statement->fetch();
     $statement->closeCursor();
     if ($test) {
       return false;
     }
     else { return true;}
    }
    function is_valid_admin_login($username, $password) {
        global $db;
        $query = 'SELECT password
                FROM administrators
                WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $hash = empty($row['password']) ? null : $row['password'];
        return password_verify($password, $hash);
    }
?>
