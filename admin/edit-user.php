<?php
session_start();
include("checklogin.php");
check_login();
include("dbconnection.php");

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $user_name = $_POST['user_name'];
  $gender = $_POST['gender'];
  $userid = $_GET['id'];

  // Opcionales
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $altemail = isset($_POST['alt_email']) ? $_POST['alt_email'] : '';
  $contact = isset($_POST['mobile']) ? $_POST['mobile'] : '';
  $address = isset($_POST['address']) ? $_POST['address'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  // Construcción de la consulta de actualización
  $update_query = "UPDATE user SET name='$name', user_name='$user_name', gender='$gender'";

  if (!empty($email)) {
    $update_query .= ", email='$email'";
  }

  if (!empty($altemail)) {
    $update_query .= ", alt_email='$altemail'";
  }

  if (!empty($contact)) {
    $update_query .= ", mobile='$contact'";
  }

  if (!empty($address)) {
    $update_query .= ", address='$address'";
  }

  if (!empty($password)) {
    $update_query .= ", password='$password'"; // Puedes aplicar hashing aquí si es necesario.
  }

  $update_query .= " WHERE id='$userid'";

  $ret = mysqli_query($con, $update_query);
  if ($ret) {
    echo "<script>alert('Datos Actualizados'); location.replace(document.referrer)</script>";
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
  <link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
</head>

<body class="">
  <?php include("header.php"); ?>
  <div class="page-container row-fluid">
    <?php include("leftbar.php"); ?>
    <div class="clearfix"></div>
  </div>
  </div>
  <a href="#" class="scrollup">Scroll</a>
  <div class="footer-widget">
    <div class="progress transparent progress-small no-radius no-margin">
      <div data-percentage="79%" class="progress-bar progress-bar-success animate-progress-bar"></div>
    </div>
    <div class="pull-right">
    </div>
  </div>
  <div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
      <div class="page-title">
        <?php 
        $rt = mysqli_query($con, "SELECT * FROM user WHERE id='" . $_GET['id'] . "'");
        while ($rw = mysqli_fetch_array($rt)) { ?>
          <h3>Update <?php echo $rw['name']; ?>'s Perfil</h3>

          <form name="muser" method="post" action="" enctype="multipart/form-data">
            <div class="row justify-content-center">
              <div class="col-lg-8 col-md-10 col-xs-12 mx-auto">
                <div class="form-group">
                  <label for="name" class="control-label">Nombre</label>
                  <input type="text" class="form-control rounded-0" id="name" name="name" value="<?php echo $rw['name']; ?>" required="required">
                </div>
                <div class="form-group">
                  <label for="user_name" class="control-label">Username</label>
                  <input type="text" class="form-control rounded-0" id="user_name" name="user_name" value="<?php echo $rw['user_name']; ?>" required="required">
                </div>
                <div class="form-group">
                  <label for="password" class="control-label">Nueva Contraseña (Opcional)</label>
                  <input type="password" class="form-control rounded-0" id="password" name="password">
                </div>
                <div class="form-group">
                  <label for="gender" class="control-label">Genero</label>
                  <select class="form-control rounded-0" id="gender" name="gender" required="required">
                    <option value="male" <?= $rw['gender'] == 'male' ? "selected" : "" ?>>Masculino</option>
                    <option value="female" <?= $rw['gender'] == 'female' ? "selected" : "" ?>>Femenino</option>
                  </select>
                </div>
                <!-- Campos Opcionales -->
                <div class="form-group">
                  <label for="email" class="control-label">Correo (Opcional)</label>
                  <input type="email" class="form-control rounded-0" id="email" name="email" value="<?php echo $rw['email']; ?>">
                </div>
                <div class="form-group">
                  <label for="alt_email" class="control-label">Correo Alternativo (Opcional)</label>
                  <input type="email" class="form-control rounded-0" id="alt_email" name="alt_email" value="<?php echo $rw['alt_email']; ?>">
                </div>
                <div class="form-group">
                  <label for="mobile" class="control-label">Contact Number (Opcional)</label>
                  <input type="text" class="form-control rounded-0" id="mobile" name="mobile" value="<?php echo $rw['mobile']; ?>">
                </div>
                <div class="form-group">
                  <label for="address" class="control-label">Address (Opcional)</label>
                  <textarea rows="3" class="form-control rounded-0" id="address" name="address"><?php echo $rw['address']; ?></textarea>
                </div>
                
                <div class="form-group">
                  <div class="text-center">
                    <button type="submit" name="update" class="btn btn-primary">Guardar Cambios</button>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          </form>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/breakpoints.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js"></script>
  <script src="../assets/js/core.js" type="text/javascript"></script>
  <script src="../assets/js/chat.js" type="text/javascript"></script>
  <script src="../assets/js/demo.js" type="text/javascript"></script>

</body>

</html>
