<?php

include("./data_connect.php");

session_start();

if (!isset($_SESSION['id'])) {
  header("Location: login.php");
}

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM `todo_data` WHERE user_id = $user_id";
$result = $conn->query($sql);

$errors = [];

if(isset($_POST['submit'])) {
    $text = $_POST['text'];

    if (empty($text)) {
        $errors['text'] = "Please Enter Text"; 
    } else {
        $sql = "INSERT INTO `todo_data`(`Data`,`user_id`) VALUES ('$text','$user_id')";
        $conn->query($sql);

        header("location: index.php");
    }
}

include("./Includes_Folder/header.php");

?>


    <div class="container mt-2">

    <?php if ($errors) : ?>
        <?php foreach ($errors as $error) : ?>
            <?php echo $error; ?>
        <?php endforeach ?>
    <?php endif ?> 

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="text" name="text" class="form-control mb-2" placeholder="Enter Task ...">
        <input type="submit" value="Submit" name="submit">
    </form>

    <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>DATA</th>
      <th>UPDATE</th>
      <th>DELETE</th>
    </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
    <tr>
      <td><?php echo $row['Id']; ?></td>
      <td><?php echo $row['Data']; ?></td>
      <td><a href="./update.php?id=<?php echo $row['Id']; ?>" class="btn btn-primary">Update</a></td>
      <td><a href="./delete.php?id=<?php echo $row['Id'] ?>" class="btn btn-danger">Delete</a></td>
    </tr>
    <?php endwhile ?>
    </tbody>
    </table>


    </div>

<?php include(".//Includes_Folder/footer.php"); ?>