<?php
    function getCategories() {
        global $db;
        $query = 'SELECT *
                FROM categories
                ORDER BY categoryName';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $categories;
    }
    function delCategory($categoryID)
    {  //echo"here";
      //  echo $categoryID;
        global $db;
        $query = 'DELETE FROM categories WHERE id = :catID';
        $statement = $db->prepare($query);
        $statement->bindValue(':catID', $categoryID);
        $statement->execute();
        $statement->closeCursor();
    }
    function addCategory($categoryName)
    {
        global $db;
        $query = 'insert into categories (categoryName)
                    values (:categoryName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryName', $categoryName);
        $statement->execute();
        $statement->closeCursor();
    }
?>
