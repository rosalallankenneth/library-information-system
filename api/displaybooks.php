<?php
    require_once 'dbh.inc.php';

    $sql = "SELECT * FROM book_info";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        echo "<tr style='background: #fff !important; border-bottom: 1px #01ac48 solid; color: #000;'><th>Book no.</th><th>Book name</th><th>Book author</th><th>Genre</th><th>Publisher</th><th>Year published</th><th>Action</th></tr>";

		while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row['book_number']."</td><td>".$row['book_name']."</td><td>".$row['book_author']."</td><td>".$row['genre']."</td><td>".$row['publisher']."</td><td>".$row['year_published']."</td><td>"."<button id='edit-".$row['book_number']."' class='btn-edit table-btn btn btn-outline-primary btn-sm'>Edit</button><button id='delete-".$row['book_number']."' class='btn-delete table-btn btn btn-outline-danger btn-sm'>Delete</button>"."</td></tr>";
        }
        
        echo "<tr style='background: #fff !important; border-top: 1px #01ac48 solid; color: #000;'><th>Book no.</th><th>Book name</th><th>Book author</th><th>Genre</th><th>Publisher</th><th>Year published</th><th>Action</th></tr>";
    } else {
        echo "0 results";
    }

?>