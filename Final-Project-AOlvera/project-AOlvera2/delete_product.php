<?php
require_once('database.php');

// Delete the product from the database
if (isset($_POST['delete'])) {
	$id = $_POST['id'];

	$query = 'DELETE FROM products
              WHERE id =:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $success = $statement->execute();
    // $statement->closeCursor();  

    // Display the Product List page
	include('index.php');  
}



