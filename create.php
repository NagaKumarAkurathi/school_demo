<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];

    
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . time() . '_' . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $query = "INSERT INTO student (name, email, address, class_id, image) 
              VALUES ('$name', '$email', '$address', '$class_id', '$target_file')";
    $conn->query($query);
    header("Location: index.php");
}


$classes_result = $conn->query("SELECT * FROM classes");
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Create Student</h1>
    <form method="POST" enctype="multipart/form-data">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email"><br>
        Address: <textarea name="address"></textarea><br>
        Class: 
        <select name="class_id">
            <?php while($row = $classes_result->fetch_assoc()) { ?>
            <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
            <?php } ?>
        </select><br>
        Image: <input type="file" name="image" accept="image/png, image/jpeg" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
