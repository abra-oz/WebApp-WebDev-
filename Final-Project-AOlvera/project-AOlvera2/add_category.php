<?php
   require_once('database.php');

// Add Category
if(isset($_POST['addcategory'])){
    $category_name = $_POST['category_name'];

    if ($category_name== "") {
        $error = "Invalid category data. Check all fields and try again.";
        include('error.php');
    }
    else{
    
        // Add the Category to the database  
        $query = 'INSERT INTO categories (categoryName)
                  VALUES (:category_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $category_name);
        $statement->execute();
        $statement->closeCursor();

        // Display the Category List page
      include('category_list.php');
    }
}
?>


