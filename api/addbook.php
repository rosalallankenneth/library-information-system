<?php
    require_once 'dbh.inc.php';

        $id = mysqli_real_escape_string($con, $_POST['id']);
        $name = strtoupper(mysqli_real_escape_string($con, $_POST['name']));
        $author = strtoupper(mysqli_real_escape_string($con, $_POST['author']));
        $genre = strtoupper(mysqli_real_escape_string($con, $_POST['genre']));
        $publisher = strtoupper(mysqli_real_escape_string($con, $_POST['publisher']));
        $year = mysqli_real_escape_string($con, $_POST['year']);

        if(empty($id) || empty($name) || empty($author) || empty($genre) || empty($publisher) || empty($year)) {
            echo "Unable to add. Empty fields.";
            exit();
        } else if(strlen($year) != 4) {
            echo "Unable to add. Year format is invalid.";
            exit();
        }

        $sql = "INSERT INTO book_info (book_number, book_name, book_author, genre, publisher, year_published) VALUES ('$id', '$name', '$author', '$genre', '$publisher', '$year')";

        mysqli_query($con, $sql) or die("Unable to add book information. Error: ".mysqli_error($con));

        echo "A book information was successfully added.";

?>


