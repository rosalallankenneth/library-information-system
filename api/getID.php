<?php
    require_once 'dbh.inc.php';

    $sql = "SELECT book_number FROM book_info ORDER BY book_number  DESC LIMIT 1";
    $result = mysqli_query($con, $sql) or die("Database error:".mysqli_error($con));
    $row = mysqli_fetch_assoc($result);
    $id = (int) $row['book_number'] + 1;

    echo $id;
?>