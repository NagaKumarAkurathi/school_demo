<?php
include 'includes/db.php';

$id = $_GET['id'];

$query = "SELECT image FROM student WHERE id = $id";
$result = $conn->query($query);
$student = $result->fetch_assoc();
unlink($student['image']); 


$query = "DELETE FROM student WHERE id = $id";
$conn->query($query);

header("Location: index.php");
?>
