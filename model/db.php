<?php
        // DB variables set to required settings
        $dsn = 'mysql:host=localhost;dbname=quotes';
        $username = 'mgs_user';
        $password = 'pa55word';
        //$dsn = 'mysql:host=bbj31ma8tye2kagi.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=ns05o8od4aqphelr';
        //$username = 'hzcr7bqchttlxf8b';
        //$password = 'v7s4ss0bhn3rsxlc';
        try {
            $db = new PDO($dsn, $username, $password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('./view/header.php');
                include('./errors/database_error.php');
                include('./view/footer.php');
            exit();
        }
?>
