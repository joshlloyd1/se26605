<?php
/**
 * Created by PhpStorm.
 * User: calexander
 * Date: 10/29/17
 * Time: 5:15 PM
 */

function getDB() {
    $dsn = "mysql:host=localhost;dbname=wk4demo";
    $username = "wk4demo";
    $pwd = "se266";
    try {
        $db = new PDO($dsn, $username, $pwd);
        $db->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die ("There was a problem establishing the database connection");
    }
    return $db;
}

function getColumnNames($db, $tbl){

    $sql = "select column_name from information_schema.columns where lower(table_name)=lower('". $tbl . "')";
    $stmt = $db->prepare($sql);

    try {
        if($stmt->execute()):
            $raw_column_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($raw_column_data as $outer_key => $array):
                foreach($array as $inner_key => $value):
                    if (!(int)$inner_key):
                            $column_names[] = $value;
                    endif;
                endforeach;
            endforeach;
        endif;
    } catch (Exception $e){
            die("There was a problem retrieving the column names");
    }
    return $column_names;
}