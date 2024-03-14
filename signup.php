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

    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT `Password` FROM `user_data` WHERE Email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $errors['email_error'] = "This Email is Exist Change Email";

    } else {
            $sql = "INSERT INTO `user_data`(`Email`, `Password`) VALUES ('$email','$encrypted_password')";
            $conn->query($sql);
    
            session_start();
                
            $_SESSION['id'] = $conn->insert_id;

            header("location: index.php");
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
    <h2 class="card-title">Sign Up</h2>
    <div class="card-body">
        <form action="./signup.php" method="POST">
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
    <p>Don't have an account? <a href="./login.php">Login</a></p>
</div>
</div>

</div>

<?php include("./Includes_Folder/footer.php"); ?>