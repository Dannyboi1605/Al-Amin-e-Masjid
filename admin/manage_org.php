<?php
session_start();
include("../config/db.php");
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM org_chart WHERE id=$id");
    header("Location: manage_org.php?deleted=1");
    exit;}
// Handle Add Person
if (isset($_POST['add'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $role = $conn->real_escape_string($_POST['role']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $social = $conn->real_escape_string($_POST['social']);
    $desc = $conn->real_escape_string($_POST['description']);
    $parent = $_POST['parent_id'] ? intval($_POST['parent_id']) : "NULL";

    // Handle file upload
    $photo = null;
    if (!empty($_FILES['photo']['name'])) {
        $targetDir = "../uploads/org/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

        $filename = time() . "_" . basename($_FILES['photo']['name']);
        $targetFile = $targetDir . $filename;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            $photo = "uploads/org/" . $filename;
        }
    }

    $conn->query("INSERT INTO org_chart (name, role, phone, email, social, description, parent_id, photo) 
                  VALUES ('$name','$role','$phone','$email','$social','$desc',$parent,'$photo')");
    header("Location: manage_org.php");
    exit;
}


// Fetch all people
$result = $conn->query("SELECT * FROM org_chart ORDER BY id ASC");
$people = $result->fetch_all(MYSQLI_ASSOC);

// For parent dropdown
$parentOptions = $conn->query("SELECT id, name FROM org_chart");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Organization Chart</title>
      <?php include("includes/navbar.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>Manage Organization Chart</h2>

    <!-- Add Person Form -->
   <form method="post" enctype="multipart/form-data" class="mb-5">

        <h4>Add New Person</h4>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
    <label class="form-label">Photo</label>
    <input type="file" name="photo" class="form-control" accept="image/*">
</div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <input type="text" name="role" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Social Link</label>
            <input type="url" name="social" class="form-control" placeholder="https://facebook.com/...">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Parent</label>
            <select name="parent_id" class="form-select">
                <option value="">None (Top Level)</option>
                <?php while($row = $parentOptions->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" name="add" class="btn btn-success">Add Person</button>
    </form>

    <!-- List of People -->
    <h4>Organization Members</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th><th>Role</th><th>Phone</th><th>Email</th><th>Social</th><th>Description</th><th>Parent ID</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($people as $p): ?>
            <tr>
                <td><?= $p['name'] ?></td>
                <td><?= $p['role'] ?></td>
                <td><?= $p['phone'] ?></td>
                <td><?= $p['email'] ?></td>
                <td><a href="<?= $p['social'] ?>" target="_blank"><?= $p['social'] ?></a></td>
                <td><?= $p['description'] ?></td>
                <td><?= $p['parent_id'] ?></td>
                <td>
                    <a href="edit_org.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="manage_org.php?delete=<?= $p['id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this person?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
            