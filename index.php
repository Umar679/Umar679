<?php

include("./data_connect.php");

$sql = "SELECT * FROM `todo_data`";
$result = $conn->query($sql);

$errors = [];

if(isset($_POST['submit'])) {
    $text = $_POST['text'];

    if (empty($text)) {
        $errors['text'] = "Please Enter Text"; 
    } else {
        $sql = "INSERT INTO `todo_data`(`Data`) VALUES ('$text')";
        $conn->query($sql);

        header("location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
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

</body>
</html>