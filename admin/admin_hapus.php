<?php 
include '../koneksi.php';
session_start(); // Start the session to access session variables

$id = $_GET['id'];

// Check if the logged-in admin is the one being deleted
if ($_SESSION['admin_id'] == $id) {
    // Log out the current admin
    session_destroy(); // Destroys the session, logging the admin out
    header("Location: login.php"); // Redirect to the login page or any other page
    exit;
}

// Query to check if the admin is the first admin (assuming 'admin_id' 1 is the first admin)
$data = mysqli_query($koneksi, "SELECT * FROM admin WHERE admin_id='$id'");
$d = mysqli_fetch_assoc($data);

// Prevent the first admin from being deleted
if ($id == 1) {
    $_SESSION['error'] = "The first admin cannot be deleted."; // Set an error message
    header("Location: admin.php"); // Redirect to admin list page
    exit; // Stop further execution
}

// If the admin is not the first one, proceed with deletion
$foto = $d['admin_foto'];
if ($foto) {
    unlink("../gambar/user/$foto"); // Remove the admin's photo from the directory
}
mysqli_query($koneksi, "DELETE FROM admin WHERE admin_id='$id'"); // Delete the admin from the database

header("Location: admin.php"); // Redirect back to the admin list page
exit;
?>
