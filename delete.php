<?php

include("./data_connect.php");

// print_r($_GET);

$id = $_GET['id'];

$sql = "DELETE FROM `todo_data` WHERE Id = $id";

$conn->query($sql);

header("location: index.php");

?>