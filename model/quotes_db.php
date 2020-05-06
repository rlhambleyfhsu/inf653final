<?php
function getQuotes($authorID, $categoryID, $limit)
{
    global $db;
    $bindValues = [];
    $query = 'SELECT q.id, q.quotetext, a.authorName as authorName, c.categoryName as categoryName
          FROM quotes q
          LEFT JOIN authors a on q.authorID = a.id
          LEFT JOIN categories c on q.categoryID = c.id
                WHERE q.approved = 1';
    if ($authorID >= 1) {
        $query .= ' AND q.authorID = :authorID';
        array_push($bindValues, [':authorID', $authorID]);
    }
    if ($categoryID >= 1) {
        $query .= ' AND q.categoryID = :categoryID';
        array_push($bindValues, [':categoryID', $categoryID]);
    }
    //echo $query;
    $query .= $limit > 0 ? ' LIMIT ' . $limit : "";
    $statement = $db->prepare($query);
    for ($i = 0; $i < count($bindValues); $i++) {
        $statement->bindValue($bindValues[$i][0], $bindValues[$i][1]);
    }
    $statement->execute();
    $quotes = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $quotes;
}

function getApprovals()
{
    global $db;
    $query = 'SELECT q.id, q.quotetext, a.authorName as authorName, c.categoryName as categoryName
          FROM quotes q
          LEFT JOIN authors a on q.authorID = a.id
          LEFT JOIN categories c on q.categoryID = c.id
          WHERE q.approved = 0';

    $statement = $db->prepare($query);
    $statement->execute();
    $quotes = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $quotes;
}

function deleteQuote($quoteID)
{
    global $db;
    $query = 'DELETE FROM quotes
                WHERE id = :quoteID';
    $statement = $db->prepare($query);
    $statement->bindValue(':quoteID', $quoteID);
    $statement->execute();
    $statement->closeCursor();
}

function approveQuote($quoteID)
{
    global $db;
    $query = 'UPDATE quotes
                SET approved = 1
                WHERE id = :quoteID';
    $statement = $db->prepare($query);
    $statement->bindValue(':quoteID', $quoteID);
    $statement->execute();
    $statement->closeCursor();
}

function addQuote($text, $authorID, $categoryID, $approved)
{
    global $db;
    $query = 'INSERT INTO quotes
                 (quotetext, authorID, categoryID, approved)
              VALUES
                 (:text, :authorID, :categoryID, :approved)';
    $statement = $db->prepare($query);
    $statement->bindValue(':text', $text);
    $statement->bindValue(':authorID', $authorID);
    $statement->bindValue(':categoryID', $categoryID);
    $statement->bindValue(':approved', $approved);
    $statement->execute();
    $statement->closeCursor();
}
?>
