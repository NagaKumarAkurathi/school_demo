<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $query = "INSERT INTO classes (name) VALUES ('$name')";
    $conn->query($query);
    header("Location: classes.php");
}

$query = "SELECT * FROM classes";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Manage Classes</h1>
    <form method="POST">
        Add New Class: <input type="text" name="name" required>
        <button type="submit">Add</button>
    </form>
    <h2>Classes List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['class_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>
                <a href="edit_class.php?id=<?php echo $row['class_id']; ?>">Edit</a> |
                <a href="delete_class.php?id=<?php echo $row['class_id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="index.php">Back to Home</a>
</body>
</html>
