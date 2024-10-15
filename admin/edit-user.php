<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();

// Obtener el ID del usuario a editar
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($user_id == 0) {
    echo "<script>alert('ID de usuario inválido');</script>";
    echo "<script>window.location.href='manage-users.php'</script>";
    exit;
}

// Lógica para actualizar un usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['phone'];
    $gender = $_POST['gender'];
    $repository_id = $_POST['repository_id'];  // Nuevo campo

    // Actualizar el usuario en la base de datos
    $update_query = "UPDATE user SET user_name='$user_name', name='$name', email='$email', password='$password', mobile='$mobile', gender='$gender', repository_id='$repository_id' WHERE id='$user_id'";
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Usuario actualizado exitosamente');</script>";
        echo "<script>window.location.href='manage-users.php'</script>";
    } else {
        echo "<script>alert('Ocurrió un error. Por favor, intente nuevamente.');</script>";
    }
}

// Obtener la información del usuario actual
$user_query = "SELECT * FROM user WHERE id='$user_id'";
$user_result = mysqli_query($con, $user_query);
$user_data = mysqli_fetch_array($user_result);

if (!$user_data) {
    echo "<script>alert('Usuario no encontrado');</script>";
    echo "<script>window.location.href='manage-users.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Admin | Editar Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
</head>

<body class="">
    <?php include("header.php"); ?>
    <div class="page-container row">

        <?php include("leftbar.php"); ?>

        <div class="clearfix"></div>
        <!-- END SIDEBAR MENU -->
    </div>
    </div>
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div id="portlet-config" class="modal hide">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"></button>
                <h3>Widget Settings</h3>
            </div>
            <div class="modal-body">Widget settings form goes here</div>
        </div>
        <div class="clearfix"></div>
        <div class="content">
            <ul class="breadcrumb">
                <li>
                    <p>Inicio</p>
                </li>
                <li><a href="manage-users.php" class="active">Gestionar Usuarios</a>
                </li>
                <li><a href="#" class="active">Editar Usuario</a>
                </li>
            </ul>

            <div class="page-title">
                <h3>Editar Usuario</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="grid simple">
                        <div class="grid-title no-border">
                            <h4>Editando el Usuario <strong><?php echo htmlspecialchars($user_data['name']); ?></strong></h4>
                            <div class="tools"> <a href="javascript:;" class="collapse"></a>
                            </div>
                        </div>
                        <div class="grid-body no-border">

                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control rounded-0" id="name" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_name">Nombre de Usuario</label>
                                    <input type="text" class="form-control rounded-0" id="user_name" name="user_name" value="<?php echo htmlspecialchars($user_data['user_name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo (Opcional)</label>
                                    <input type="email" class="form-control rounded-0" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control rounded-0" id="password" name="password" value="<?php echo htmlspecialchars($user_data['password']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Número de Contacto (Opcional)</label>
                                    <input type="text" class="form-control rounded-0" id="phone" name="phone" value="<?php echo htmlspecialchars($user_data['mobile']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Género</label>
                                    <select class="form-control rounded-0" id="gender" name="gender" required>
                                        <option value="male" <?php echo ($user_data['gender'] == 'male') ? 'selected' : ''; ?>>Masculino</option>
                                        <option value="female" <?php echo ($user_data['gender'] == 'female') ? 'selected' : ''; ?>>Femenino</option>
                                    </select>
                                </div>
                                <div class="form-group"> <!-- Nuevo campo -->
                                    <label for="repository_id">Repositorio</label>
                                    <select class="form-control rounded-0" id="repository_id" name="repository_id" required>
                                        <?php
                                        $repos_query = mysqli_query($con, "SELECT id, name FROM repository");
                                        while ($repo = mysqli_fetch_array($repos_query)) {
                                            $selected = ($user_data['repository_id'] == $repo['id']) ? 'selected' : '';
                                            echo "<option value='" . $repo['id'] . "' $selected>" . $repo['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-actions text-right">
                                    <button type="submit" name="update_user" class="btn btn-success">Guardar Cambios</button>
                                    <a href="manage-users.php" class="btn btn-default">Cancelar</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- END PAGE -->
    

    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN CORE JS FRAMEWORK-->
    <script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
    <script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
        //Too Small for new file - Helps the to tick all options in the table 
        $('table .checkbox input').click(function() {
            if ($(this).is(':checked')) {
                $(this).parent().parent().parent().toggleClass('row_selected');
            } else {
                $(this).parent().parent().parent().toggleClass('row_selected');
            }
        });
        // Demo charts - not required 
        $('.customer-sparkline').each(function() {
            $(this).sparkline('html', {
                type: $(this).attr("data-sparkline-type"),
                barColor: $(this).attr("data-sparkline-color"),
                enableTagOptions: true
            });
        });
    </script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="../assets/js/core.js" type="text/javascript"></script>
    <script src="../assets/js/chat.js" type="text/javascript"></script>
    <script src="../assets/js/demo.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
</body>

</html>
