<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();

// Lógica para agregar un nuevo usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['phone'];
    $gender = $_POST['gender'];
    $repository_id = $_POST['repository_id'];  // Nuevo campo

    // Insertar el nuevo usuario en la base de datos
    $insert_query = "INSERT INTO user (user_name, name, email, password, mobile, gender, repository_id) VALUES ('$user_name', '$name', '$email', '$password', '$mobile', '$gender', '$repository_id')";
    if (mysqli_query($con, $insert_query)) {
        echo "<script>alert('Usuario agregado exitosamente');</script>";
        echo "<script>window.location.href='manage-users.php'</script>";
    } else {
        echo "<script>alert('Ocurrió un error. Por favor, intente nuevamente.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Admin | Gestionar Usuarios</title>
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
                <li><a href="#" class="active">Gestionar Usuarios</a>
                </li>
            </ul>
        
            <div class="page-title" style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center;">
                    <i class="fa fa-users" style="font-size: 24px; margin-right: 10px;"></i>
                    <h3 style="margin: 0;">Gestionar Usuarios</h3>
                </div>
                <button class="btn btn-success btn-xs rounded-0" data-toggle="modal" data-target="#addUserModal" style="display: flex; align-items: center; padding: 6px 12px;">
                    <i class="fa fa-plus" style="color: #fff; margin-right: 8px;"></i> 
                    <span style="color: #fff; font-weight: 500;">Agregar Usuario</span>
                </button>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple ">
                                <div class="grid-title no-border">
                                    <h4>Toda la Información de los Usuarios</h4>
                                    <div class="tools"> <a href="javascript:;" class="collapse"></a>
                                    </div>
                                </div>
                                <div class="grid-body no-border">

                                    <table class="table table-bordered table-hover no-more-tables">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre Completo</th>
                                                <th>UserName</th>
                                                <th>Correo</th>
                                                <th>Repositorio</th> <!-- Nuevo campo -->
                                                <th>Fecha de Registro</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $ret = mysqli_query($con, "SELECT user.*, repository.name AS repository_name FROM user LEFT JOIN repository ON user.repository_id = repository.id");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($ret)) {
                                                $_SESSION['ids'] = $row['id'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['user_name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['repository_name']; ?></td> <!-- Mostrar el nombre del repositorio -->
                                                    <td><?php echo $row['posting_date']; ?></td>
                                                    <td>
                                                        <form name="abc" action="" method="post">
                                                            <a href="edit-user.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-xs btn-mini rounded-0">Editar</a>
                                                            <button type="button" class="btn btn-danger btn-xs btn-mini rounded-0">Eliminar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php $cnt = $cnt + 1;
                                            } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>        
    </div>

    <!-- Modal para agregar un nuevo usuario -->
    <div id="addUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center; font-weight: bold;">Agregar Usuario</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control rounded-0" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="user_name">Nombre de Usuario</label>
                        <input type="text" class="form-control rounded-0" id="user_name" name="user_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo (Opcional)</label>
                        <input type="email" class="form-control rounded-0" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control rounded-0" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Número de Contacto (Opcional)</label>
                        <input type="text" class="form-control rounded-0" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="gender">Género</label>
                        <select class="form-control rounded-0" id="gender" name="gender" required>
                            <option value="male">Masculino</option>
                            <option value="female">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Nuevo campo -->
                        <label for="repository_id">Repositorio</label>
                        <select class="form-control rounded-0" id="repository_id" name="repository_id" required>
                            <?php
                            $repos_query = mysqli_query($con, "SELECT id, name FROM repository");
                            while ($repo = mysqli_fetch_array($repos_query)) {
                                echo "<option value='" . $repo['id'] . "'>" . $repo['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer" style="justify-content: flex-end;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="add_user" class="btn btn-success">Guardar</button>
                    </div>
                </form>
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
