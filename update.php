<?php

include("./data_connect.php");

$id = $_GET['id'];

$errors = [];

if (isset($_POST['update'])) {
    $text = $_POST['text'];

    if (empty($text)) {
        $errors['text'] = "Please Update Date"; 
    } else {
        $sql = "UPDATE `todo_data` SET `Data`='$text' WHERE Id = $id";
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
    <title>Update Data</title>
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

    <h3>Update Data</h3>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="text" name="text" class="form-control mb-2" placeholder="Update Data ...">
        <input type="submit" value="Update" name="update">
    </form>

    </div>
</body>
</html>