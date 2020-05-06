<?php
    function getAuthors() {
        global $db;
        $query = 'SELECT id, authorName
                FROM authors
                ORDER BY authorName';
        $statement = $db->prepare($query);
        $statement->execute();
        $authors = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $authors;
    }
    function delAuthor($authorID)
    {
        global $db;
        $query = 'DELETE FROM authors
                    WHERE id = :authorID';
        $statement = $db->prepare($query);
        $statement->bindValue(':authorID', $authorID);
        $statement->execute();
        $statement->closeCursor();
    }
    function addAuthor($authorName)
    {
        global $db;
        $query = 'insert into authors (authorName)
                    values (:authorName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':authorName', $authorName);
        $statement->execute();
        $statement->closeCursor();
    }
?>
