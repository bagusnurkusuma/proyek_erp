<!DOCTYPE html>
<html lang="en">
<?php
require_once "api.php";
$hasil = get_company_profile();
if (is_array($hasil) && count($hasil)) {
  foreach ($hasil as $baris) :
    $company_name = $baris["company_name"];
    $company_addres = $baris["company_addres"];
  endforeach;
} else {
  $company_name = "Proyek ERP";
  $company_addres = "Malang";
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $baris["company_name"]; ?></title>
  <!-- Web page CSS -->
  <link rel="stylesheet" href="..\asset_default\login.css">
  <!-- Font Awesome library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>


<body class="login" onload="document.login.user.focus();">
  <form action="proses_login.php" id="login-form">
    <div class="left">
      <div class="container">
        <img src="log.png" alt="">
      </div>
    </div>
    <div class="right">
      <div class="connect">Welcome to <?php echo $baris["company_name"]; ?></div>
      <div class="heading">Login to Your Account</div>

      <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" />
      </div>
      <div>
        <label for="password">Password</label>
        <div class="password-input-container">
          <input type="password" name="password" id="password" />
          <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility()"></i>
        </div>
      </div>

      <div class="input-group">
        <input type="checkbox" name="remember-me" id="remember-me" />
        <label for="remember-me">Remember Me</label>
      </div>

      <div class="submit">
        <button type="submit">Logn</button>
      </div>

      <div class="register">
        <p>Don't Have an Account ? <a href="../asset_default/register.php">Sign Up!</a></p>
      </div>
    </div>
  </form>
</body>

<script>
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.querySelector("i");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  }
</script>

</html>