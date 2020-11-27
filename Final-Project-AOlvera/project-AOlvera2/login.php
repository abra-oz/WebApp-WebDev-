<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> signup Form </title>
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
</head>

<body>


<?php
require_once('database.php');
 session_start ();
// Validate inputs
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($_POST['username']) || empty($_POST['password'])) {

        echo "<script>alert('Usename and Password is empty')</script>";
    }
    else{
        $query = "SELECT * FROM signup WHERE username= :username AND password= :password ";
        $statement = $db->prepare($query);
       
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();

        $count= $statement->rowCount();
         if ($count == 1) {
              $_SESSION['username']=$username;

              echo "<script>alert('Login successfull')</script>";
         }
         else{
            echo "<script>alert('Login Faild')</script>";
         }
    }
    
}
?>    

    
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <h2 class="text-center text-primary"> Signup Form </h2><br>
        		<form action ="" method="post">
        		    <div class="form-group">
        		     <label for="user"> User name</label>
        			 <input type="text" name="username" value="" placeholder="enter username" class="form-control">
        		    </div>

        		    <div class="form-group">
        		     <label for="user"> Password </label>
        			 <input type="password" name="password" value="" placeholder="enter password" class="form-control">
        		    </div>
        
        		    <input type="submit" name="login" value="Signup" class="btn btn-primary">
        		</form>
            </div>
            <div class="col-sm-4"></div>
        </div>
	</div>





</body>
</html>