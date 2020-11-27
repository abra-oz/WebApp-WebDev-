<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}
// Get name for selected category
$queryCategory = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();


// Get all categories
$query = 'SELECT * FROM categories
                       ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

// Get products for selected category
$queryProducts = 'SELECT * FROM products
                  WHERE categoryID = :category_id
                  ORDER BY id';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();


// Delete Product Query
if (isset($_POST["delete"])) {
    $id = $_POST['id'];

    $del_qry = 'DELETE FROM products
              WHERE id =:id';
    $result = $db->prepare($del_qry);
    $result->bindValue(':id', $id);
    $success = $result->execute();

}

?>


<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Product Manager</h1></header>
<main>
    <h1>Product List</h1>
    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
            <ul>
                <?php foreach ($categories as $category) : ?>
                <li><a href="index2.php?categoryID=<?php echo $category['categoryID']; ?>">
                        <?php echo $category['categoryName']; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>

        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th colspan="2">Action</th>
               
            </tr>

        <?php
            // Get products for selected category
           if(isset($_GET['categoryID'])){
           $categoryid=$_GET['categoryID'];
            $queryProducts ="SELECT * FROM products WHERE categoryID='$categoryid'";
            $statement3 = $db->prepare($queryProducts);
        
            $statement3->execute();
            
            if ($statement3->rowCount() > 0) {
                while ($row= $statement3->fetch(PDO::FETCH_ASSOC)) {  
        ?>

            <tr>
                <td><?php echo $row["productCode"]?></td>
                <td><?php echo $row["productName"]?></td>
                <td class="right"><?php echo $row["listPrice"]?></td>
                
                <td><form action="product_edit_form2.php" method="post">
                    <input type="hidden" name="id"
                           value="<?php echo $row["id"]; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $row["categoryID"]; ?>">
                    <input type="submit" name="edit" value="Edit">
               
                    </form></td>
                
                <td><form action="" method="post">
                    <input type="hidden" name="id"
                           value="<?php echo $row["id"]; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $row["categoryID"]; ?>">
                    <input type="submit" name="delete" value="Delete">
                </form></td>
                
            </tr>
       
    <?php }} 
    }else{
        // Get all products
            $queryProducts ="SELECT * FROM products";
            $statement3 = $db->prepare($queryProducts);
        
            $statement3->execute();
            
            if ($statement3->rowCount() > 0) {
                while ($row= $statement3->fetch(PDO::FETCH_ASSOC)) {  
        ?>

            <tr>
                <td><?php echo $row["productCode"]?></td>
                <td><?php echo $row["productName"]?></td>
                <td class="right"><?php echo $row["listPrice"]?></td>
                
                <td><form action="product_edit_form2.php" method="post">
                    <input type="hidden" name="id"
                           value="<?php echo $row["id"]; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $row["categoryID"]; ?>">
                    <input type="submit" name="edit" value="Edit">
               
                    </form></td>
                
                <td><form action="" method="post">
                    <input type="hidden" name="id"
                           value="<?php echo $row["id"]; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $row["categoryID"]; ?>">
                    <input type="submit" name="delete" value="Delete">
                </form></td>
                
            </tr>
       
    <?php }} }?>
     </table>
        <p><a href="add_product_form.php">Add Product</a></p>
        <p><a href="category_list.php">List Categories</a></p>        
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>