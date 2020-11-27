<?php
if (isset($_POST['btn_update'])) {
    $product_id = $_POST['id'];    
    $category_id = $_POST['category_id'];    
    $code = $_POST['code'];    
    $name = $_POST['name'];    
    $price = $_POST['price'];    

    $query = 'UPDATE products
              SET (categoryID = :category_id, productCode = :code, productName = :name, and listPrice = :price)
              WHERE id = :product_id';
               
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':product_id', $product_id);
    $sucess = $statement->execute();
    $statement->closeCursor();
}
    include('index.php');
?>