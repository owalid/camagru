#!/usr/bin/php
<?php
    require_once('database.php');
    try {
        $dbh = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);
        $db->exec("CREATE DATABASE '$DB_BASE'")
        or die(print_r($dbh->errorInfo(), true));

    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
    $db->closeCursor();
    $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    if (!$db)
        die("DB ERROR\n");
    $create = file_get_contents('./insert.sql');
    try {
        $db->exec($all_query);
        $db->closeCursor();
        echo "👌 \n";
    } catch (PDOException $e) {
        echo "DB ERROR:\n";
        echo $e->getMessage();
        $db->closeCursor();
        die();
    }
?>