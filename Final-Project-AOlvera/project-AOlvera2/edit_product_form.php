<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();


// Edit data
if (isset($_POST['btn_Edit'])) {
    $id = $_POST['product_id'];

    $slct_query = "SELECT * FROM products WHERE id= '$id' " ;
    $statement3 = $db->prepare($slct_query);
    $statement3->bindValue(':product_id', $id);
    $statement3->execute();
    $Data = $statement3->fetchAll();
    $statement3->closeCursor();

}
?>



<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Product Manager</h1></header>

    <main>
        <h1>Edit Product</h1>
        <form action="edit_product.php" method="post"
              id="edit_product_form">

            <label>Category ID:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : 
                
                
            if ($category['categoryID'] == $product['categoryID']) 
            {
                $selected = 'selected';
            } 
            else 
            {
                $selected = '';
            }
            ?>
            <option value="<?php echo $category['categoryID']; ?>" <?php echo $selected ?>>
            <?php echo $category['categoryName']; ?>
            </option>
            <?php endforeach; ?>
            </select>
            <br>
                    
            <label>Code:</label>
            <input type="text" name="code" value="<?php echo $Data['productCode'] ?>" action="<?php echo $category['code']; ?>">
            <br>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $Data['productName'] ?>" action="<?php echo $category['name']; ?>">
            <br>

            <label>List Price:</label>
            <input type="text" name="price" value="<?php echo $Data['listPrice'] ?>" action="<?php echo $category['price']; ?>">
            <br>

            <label>&nbsp;</label>
            <input type="submit" name="btn_update" value="Save Changes"><br>
        </form>
        <p><a href="index.php">View Product List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>