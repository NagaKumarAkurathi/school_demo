<?php
include 'includes/db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];

    $image = $_FILES['image']['name'];
    if ($image) {
        $target_dir = "uploads/";
        $target_file = $target_dir . time() . '_' . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        
        $query = "UPDATE student SET name='$name', email='$email', address='$address', class_id='$class_id', image='$target_file' WHERE id=$id";
    } else {
        
        $query = "UPDATE student SET name='$name', email='$email', address='$address', class_id='$class_id' WHERE id=$id";
    }
    $conn->query($query);
    header("Location: index.php");
}

$query = "SELECT * FROM student WHERE id = $id";
$result = $conn->query($query);
$student = $result->fetch_assoc();

$classes_result = $conn->query("SELECT * FROM classes");
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Edit Student</h1>
    <form method="POST" enctype="multipart/form-data">
        Name: <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $student['email']; ?>"><br>
        Address: <textarea name="address"><?php echo $student['address']; ?></textarea><br>
        Class: 
        <select name="class_id">
            <?php while($row = $classes_result->fetch_assoc()) { ?>
            <option value="<?php echo $row['class_id']; ?>" <?php echo $row['class_id'] == $student['class_id'] ? 'selected' : ''; ?>>
                <?php echo $row['name']; ?>
            </option>
            <?php } ?>
        </select><br>
        Image: <input type="file" name="image" accept="image/png, image/jpeg"><br>
        <button type="submit">Update</button>
    </form>
    <a href="index.php">Cancel</a>
</body>
</html>
