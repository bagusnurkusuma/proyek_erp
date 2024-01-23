<?php
session_start();
include "koneksi.php";
$query = "select * from user_role.user_role where username ='$_POST[user]' and password ='$_POST[pass]'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rowcount = $stmt->rowCount();
if ($rowcount == 1) {
	$_SESSION['username'] = $_POST['user'];
	header("location: side_bar.php");
} else {
	echo "<center>Username atau Password anda Salah";
	echo " <a href='login.html'>login</a></p>";
}
