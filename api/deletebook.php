<?php
    require_once 'dbh.inc.php';

    $id = trim(mysqli_real_escape_string($con, $_POST['id']));
    
    $sql = "DELETE FROM book_info WHERE book_number='$id'";
    $result = mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));

    if($result) {
        echo "The book information was successfully deleted.";
    } else {
        echo "There was an error deleting book information.";
    }