<?php
require_once "../asset_default/api.php";
$hasil = get_company_profile();
if (is_array($hasil) && count($hasil)) {
  foreach ($hasil as $row) :
    $company_name = $row["company_name"];
  endforeach;
}
?>
<html>

<head>
  <title>TOKO VAGANZA</title>
  <!-- Bootstrap -->
  <link href="../asset_design/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../asset_design/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../asset_design/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="../asset_designvendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../asset_design/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login" onload="document.login.user.focus();">
  <div>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form action="proses_login.php" method="post" name="login">
            <h1>Login Form</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" name="user" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" name="pass" />
            </div>
            <div>
              <button type="submit" class="btn btn-default submit">Log In</button>
            </div>

            <div class="clearfix"></div>

            <div class="clearfix"></div>
            <br />
            <div>
              <h1><i class="fa fa-building-o"></i>
                <?php echo $company_name ?>
              </h1>
            </div>
      </div>
      </form>
      </section>
    </div>
  </div>
  </div>
</body>

</html>