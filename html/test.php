<?php

  /**
   * Testing OOP
   *
   */
$id = 2;
try {
    $db = new PDO(
        'mysql:host=rashevskaya.com; dbname=mydb; charset=utf8mb4',
        'rashevskaya', 'Adyax-2016'
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $db->prepare('SELECT * FROM authors WHERE author_id = ?');
    $stmt->execute(array($id));
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($results);
}
catch (PDOException $ex) {
    echo "An Error occured!";
    some_logging_function($ex->getMessage());
}