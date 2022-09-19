<?php
    require_once 'dbh.inc.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = "SELECT * FROM book_info WHERE book_number='$id'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

	if ($count > 0) {
	
		$response["data"] = array();
        	
		while($row = mysqli_fetch_assoc($result)) {
            $member = array();
            
			$book["id"] = $row["book_number"];
			$book["name"] = $row["book_name"];
			$book["author"] = $row["book_author"];
			$book["genre"] = $row["genre"];
			$book["publisher"] = $row["publisher"];
			$book["year"] = $row["year_published"];
			
			array_push($response["data"], $book);
		}
		
        echo json_encode($response);
        
    } else {
        echo "Unable to retrieve info. Please refresh.";
        //echo "A member information was updated successfully.";
    }
