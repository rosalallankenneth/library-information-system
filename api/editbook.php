<?php
    require_once 'dbh.inc.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = strtoupper(mysqli_real_escape_string($con, $_POST['name']));
    $author = strtoupper(mysqli_real_escape_string($con, $_POST['author']));
    $genre = strtoupper(mysqli_real_escape_string($con, $_POST['genre']));
    $publisher = strtoupper(mysqli_real_escape_string($con, $_POST['publisher']));
    $year = mysqli_real_escape_string($con, $_POST['year']);

    $sqlid = "SELECT book_number FROM book_info WHERE book_number='$id'";
    $resultid = mysqli_query($con, $sqlid);
    $countid = mysqli_num_rows($resultid);

    if($countid == 0) {
        echo "There was an error in finding the book referred book information.";
        exit();
    }

    if(empty($id) || empty($name) || empty($author) || empty($genre) || empty($publisher) || empty($year)) {
        echo "Some required fields are empty.";
        exit();
    } else if(strlen($year) != 4) {
        echo "Unable to add. Year format is invalid.";
        exit();
    }

    $sql = "UPDATE book_info SET book_number='$id', book_name='$name', book_author='$author', genre='$genre', publisher='$publisher', year_published='$year' WHERE book_number='$id'";

    mysqli_query($con, $sql) or die("Unable to add member. Error: ".mysqli_error($con));

    echo "A book information was updated successfully.";
