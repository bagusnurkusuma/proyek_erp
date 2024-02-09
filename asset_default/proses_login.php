<?php
require_once "koneksi.php";
require_once "../asset_default/global_function.php";
$_POST = casting_htmlentities_array($_POST);
$input = array("body" => array("username" => $_POST['user'], "password" => $_POST['pass']));
$input = json_encode($input);
// $query = "SELECT user_role.get_user_by_login('" . $input . "') as result";
$query = "SELECT user_role.get_user_by_login(:input) as result";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':input', $input);
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
	$_SESSION['menu_proces'] = get_menu_proces($_SESSION["user_role_id"]);
	$_SESSION['menu_parent'] = get_menu_parent($_SESSION["user_role_id"]);
	$_SESSION['go_to_home_pages'] = "location:../dashboard/form.php";
	header($_SESSION['go_to_home_pages']);
} else {
	echo "<center>Username atau Password anda Salah";
	echo " <a href='login.php'>login</a></p>";
}
