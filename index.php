<?php
include "asset_default/koneksi.php";
session_start();
if (empty($_SESSION['username'])) {
   header("location:asset_default/login.php");
} else
   header("location:asset_default/side_bar.php");
