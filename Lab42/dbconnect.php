<?php
/**
 * Function to extablish a databse connection
 *
 * @return PDO Object
 */
function dbconnect() // DB CONNECT FUNCTION
{
    $dsn = "mysql:host=localhost;dbname=PHPClassFall2017";
    $username = "root";
    $password = "";
    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $db;
    } catch (PDOException $e) { // IF THERE WAS A PROBLEM OUTPUTS PROBLEM
        die("There was a problem connecting to the db.");
    }
}
function getColumnNames($db, $tbl){ // function that gets column names
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
?>
