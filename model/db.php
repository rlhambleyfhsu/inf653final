<?php
        //$dsn = 'mysql:host=localhost;dbname=quotes';
        //$username = 'mgs_user';
        //$password = 'pa55word';
        $dsn = 'mysql:host=ijj1btjwrd3b7932.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=pmuczthrt8xi6ki6';
        $username = 'vsxsxfisei7nikok';
        $password = 'zho0b8qr127n8xeg';
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
