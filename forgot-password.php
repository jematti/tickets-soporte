<?php
session_start();
error_reporting();
include("dbconnection.php");
if (isset($_POST['submit'])) {
  $row1 = mysqli_query($con, "select email,password from user where email='" . $_POST['email'] . "'");
  $row2 = mysqli_fetch_array($row1);
  if ($row2 > 0) {
    $email = $row2['email'];
    $subject = "Información de tu Contraseña";
    $password = $row2['password'];
    $message = "tu contraseña es " . $password;
    mail($email, $subject, $message, "From: $email");
    $_SESSION['msg'] = "Su contraseña ha sido enviada a su correo electrónico con éxito.";
  } else {
    $_SESSION['msg'] = "*Correo Electronico no registrado.";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8" />
  <title>ACCEDE AL SGT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />

</head>

<body class="error-body no-top">
  <div class="container">
    <div class="row login-container column-seperation">
      <div class="col-md-5 col-md-offset-1">
        <h2>Olvido su contraseña </h2>
        <p>
          <a href="registration.php">¡Regístrese ahora!</a> 
        </p>
        <br>


      </div>
      <div class="col-md-5 "> <br>
        <p style="color:#F00; font-size:12px;"><?php echo $_SESSION['msg']; ?><?php echo $_SESSION['msg'] = ""; ?></p>
        <form id="login-form" class="login-form" action="" method="post">
          <div class="row">
            <div class="form-group col-md-10">
              <label class="form-label">Correo FCBCB</label>
              <div class="controls">
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="email" id="txtusername" class="form-control">
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-10">
              <button class="btn btn-primary btn-cons pull-right" name="submit" type="submit">enviar</button>
            </div>
          </div>
        </form>
      </div>


    </div>
  </div>
  <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
  <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
  <script src="assets/js/login.js" type="text/javascript"></script>
</body>

</html>