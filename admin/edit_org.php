<?php
session_start();
include("../config/db.php");

if (!isset($_GET['id'])) {
    header("Location: manage_org.php");
    exit;
}

$id = intval($_GET['id']);

// Fetch person
$result = $conn->query("SELECT * FROM org_chart WHERE id=$id");
$person = $result->fetch_assoc();

if (!$person) {
    echo "Person not found!";
    exit;
}

// Update person
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $role = $conn->real_escape_string($_POST['role']);
    $desc = $conn->real_escape_string($_POST['description']);
    $parent = $_POST['parent_id'] ? intval($_POST['parent_id']) : "NULL";

    $photo = $person['photo']; // keep old photo by default
if (!empty($_FILES['photo']['name'])) {
    $targetDir = "../uploads/org/";
    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

    $filename = time() . "_" . basename($_FILES['photo']['name']);
    $targetFile = $targetDir . $filename;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
        $photo = "uploads/org/" . $filename;
    }
}

$conn->query("UPDATE org_chart SET 
              name='$name', role='$role', phone='$phone', email='$email', social='$social', 
              description='$desc', parent_id=$parent, photo='$photo'
              WHERE id=$id");


$conn->query("UPDATE org_chart SET 
              name='$name', role='$role', phone='$phone', email='$email', social='$social', description='$desc', parent_id=$parent 
              WHERE id=$id");


    header("Location: manage_org.php?updated=1");
    exit;
}

// Parent dropdown
$parentOptions = $conn->query("SELECT id, name FROM org_chart WHERE id != $id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Person</title>
      <?php include("includes/navbar.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>Edit Person</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="<?= $person['name'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
    <label class="form-label">Photo</label>
    <input type="file" name="photo" class="form-control" accept="image/*">
    <?php if ($person['photo']): ?>
        <p>Current: <img src="../<?= $person['photo'] ?>" width="80"></p>
    <?php endif; ?>
</div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <input type="text" name="role" value="<?= $person['role'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?= $person['description'] ?></textarea>
        </div>

<div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="text" name="phone" value="<?= $person['phone'] ?>" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" value="<?= $person['email'] ?>" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label">Social Link</label>
    <input type="url" name="social" value="<?= $person['social'] ?>" class="form-control">
</div>

        <div class="mb-3">
            <label class="form-label">Parent</label>
            <select name="parent_id" class="form-select">
                <option value="">None (Top Level)</option>
                <?php while($row = $parentOptions->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>" <?= $row['id']==$person['parent_id'] ? 'selected':'' ?>>
                        <?= $row['name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Person</button>
        <a href="manage_org.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>
