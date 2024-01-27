<?php
session_start();
require_once "koneksi.php";
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
		$_SESSION['user_role_id'] = $row['user_role_id'];
		$_SESSION['employee_id'] = $row['employee_id'];
		$_SESSION['employee_name'] = $row['employee_name'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['telepon'] = $row['telepon'];
		$_SESSION['file_name'] = $row['file_name'];
		$_SESSION['file_type'] = $row['file_type'];
		$_SESSION['file_location'] = $row['file_location'];
		$_SESSION['file_default_location'] = $row['file_default_location'];
		header("location: side_bar.php");
	endforeach;

	require_once "api.php";
	$hasil = get_company_profile();
	if (is_array($hasil) && count($hasil)) {
		foreach ($hasil as $row) :
			$_SESSION['company_name'] = $row["company_name"];
			$_SESSION['company_addres'] = $row["company_addres"];
		endforeach;
	}
	$hasil = get_watermark();
	if (is_array($hasil) && count($hasil)) {
		foreach ($hasil as $row) :
			$_SESSION['watermark'] = $row["watermark"];
		endforeach;
	}
} else {
	echo "<center>Username atau Password anda Salah";
	echo " <a href='login.html'>login</a></p>";
}
