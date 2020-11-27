<?php
    require_once('database.php');

// Add the product to the database  
if (isset($_POST["Add_product"])) {
    $category_id = $_POST["category_id"];
    $code = $_POST["code"];
    $name = $_POST["name"];
    $price = $_POST["price"];

    if ($category_id!== "" && $code!= "" && $name!= "" && $price!= "") {
        // Add the product to the database  
        $query = "INSERT INTO products
                 (categoryID, productCode, productName, listPrice)
              VALUES
                 (:category_id, :code, :name, :price)";
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':price', $price);
        $statement->execute();
        $statement->closeCursor();

        // Display the Product List page
        include('index2.php');
    }
    else{
         $error = "Invalid product data. Check all fields and try again.";
        include('error.php');
    }
   
}
?>