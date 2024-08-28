<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user_name = $_POST['user_name'];   
  $name = $_POST['name'];
  $email = $_POST['email']; // No obligatorio
  $password = $_POST['password']; // Sin encriptar
  $mobile = $_POST['phone']; // No obligatorio
  $gender = $_POST['gender'];

  // Verificar si el correo ya está registrado
  if (!empty($email)) {
    $query = mysqli_query($con, "SELECT email FROM user WHERE email='$email'");
    if (mysqli_num_rows($query) > 0) {
      echo "<script>alert('Correo electrónico ya registrado con nosotros. Intente con una identificación de correo electrónico diferente.');</script>";
      echo "<script>window.location.href='registration.php'</script>";
      exit();
    }
  }

  // Insertar el nuevo usuario en la base de datos
  $insert_query = "INSERT INTO user (user_name, name, email, password, mobile, gender) VALUES ('$user_name', '$name', '$email', '$password', '$mobile', '$gender')";
  if (mysqli_query($con, $insert_query)) {
    echo "<script>alert('Tu cuenta ha sido creada correctamente');</script>";
    echo "<script>window.location.href='login.php'</script>";
  } else {
    echo "<script>alert('Ocurrió un error. Por favor, intente nuevamente.');</script>";
    echo "<script>window.location.href='registration.php'</script>";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8" />
  <title>SGT-FCBCB</title>
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
  <script type="text/javascript">
    function checkpass() {
      if (document.signup.password.value != document.signup.cpassword.value) {
        alert('Los campos Nueva contraseña y Confirmar contraseña no coinciden');
        document.signup.cpassword.focus();
        return false;
      }
      return true;
    }
  </script>

</head>

<body class="error-body no-top">
  <div class="container">
    <div class="login-container">
      <div class="col-md-5">
        <h2 class="text-center text-white"><strong>Crear una Cuenta</strong></h2>
        <hr style="border-color:#ebe7e7">
        <p class="text-center">¿Ya tienes una cuenta?<a href="login.php"> ¡Accede aquí!</a></p>
      </div>
      <div class="col-md-5 "> <br>
        <form id="signup" name="signup" class="login-form" onsubmit="return checkpass();" method="post">
          <div class="form-group">
            <label for="name" class="control-label">Nombre</label>
            <input type="text" class="form-control rounded-0" id="name" name="name" required="required">
          </div>
          <div class="form-group">
            <label for="user_name" class="control-label">Nombre de Usuario</label>
            <input type="text" class="form-control rounded-0" id="user_name" name="user_name" required="required">
          </div>
          <div class="form-group">
            <label for="email" class="control-label">Correo (Opcional)</label>
            <input type="email" class="form-control rounded-0" id="email" name="email">
          </div>
          <div class="form-group">
            <label for="password" class="control-label">Contraseña</label>
            <input type="password" class="form-control rounded-0" id="password" name="password" required="required">
          </div>
          <div class="form-group">
            <label for="cpassword" class="control-label">Confirmar Contraseña</label>
            <input type="password" class="form-control rounded-0" id="cpassword" name="cpassword" required="required">
          </div>
          <div class="form-group">
            <label for="phone" class="control-label">Número de Contacto (Opcional)</label>
            <input type="text" class="form-control rounded-0" id="phone" name="phone">
          </div>
          <div class="form-group">
            <label for="gender" class="control-label">Género</label>
            <select class="form-control" name="gender" id="gender" required>
              <option value="male">Masculino</option>
              <option value="female">Femenino</option>
            </select>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary rounded-pill">Crear Cuenta</button>
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
