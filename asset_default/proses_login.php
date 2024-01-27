<?php
session_start();
include "koneksi.php";
// $query = "select * from user_role.user_role where username ='$_POST[user]' and password ='$_POST[pass]'";
$input = array("body" => array("username" => $_POST['user'], "password" => $_POST['pass']));
$input = json_encode($input);
$query = "SELECT user_role.get_user_by_login('" . $input . "') as result";
$stmt = $pdo->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$results = json_decode($row['result'], true);
$results = $results['body'];
if (is_array($results) && count($results)) {
	foreach ($results as $row) :
		$_SESSION['username'] = $_POST['user'];
		$_SESSION['employee_id'] = $row['employee_id'];
		$_SESSION['employee_name'] = $row['employee_name'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['telepon'] = $row['telepon'];
		$_SESSION['file_id'] = $row['file_id'];
		header("location: side_bar.php");
	endforeach;
} else {
	echo "<center>Username atau Password anda Salah";
	echo " <a href='login.html'>login</a></p>";
}
