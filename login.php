<?php include("./Includes_Folder/header.php"); ?>

<?php

include('./data_connect.php');

// print_r($_POST);

$errors = [];

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = false;

    if (empty($email)) {
        $errors['email'] = "Please Enter Email";
        $error = true;
    }
    if (empty($password)) {
        $errors['$password'] = "Please Enter Password";
        $error = true;
    }

    if ($error == false) {

        $sql = "SELECT `Id`,`Password` FROM `user_data` WHERE Email = '$email'";

        $result = $conn->query($sql);

        // print_r($result);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $db_password = $row['Password'];
            // print_r($row);

            if (password_verify($password, $db_password)) {
                session_start();
                
                $_SESSION['id'] = $row['Id'];

                header("location: index.php");

            } else {
                $errors["auth"] = "Email or Password Wrong";
            }
        } else {
            $errors["auth"] = "Email or Password Wrong";
        }
    }

}

?>

<?php if (!empty($errors)) : ?>
    <div class="container mt-2 col-8">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>    
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    </div>
<?php endif; ?>    

<div class="container d-flex justify-content-center mt-5">
<div class="card col-8">
  <div class="card-body">
    <h2 class="card-title">Login</h2>
    <div class="card-body">
        <form action="./login.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $email ?? "" ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-3">
        </form>
    </div>
    <p>Don't have an account? <a href="./signup.php">Sign Up</a></p>
</div>
</div>

</div>


<?php include("./Includes_Folder/footer.php"); ?>