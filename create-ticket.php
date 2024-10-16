<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
date_default_timezone_set('America/La_Paz');
check_login();

if (isset($_POST['send'])) {
    $user_id = $_SESSION['id'];
    $repository_id = $_POST['repository']; // Obtener el repositorio seleccionado
    $subject = $_POST['subject'];
    $tt = $_POST['tasktype'];
    $ticket = $_POST['description'];
    $st = "Open";
    $pdate = date('Y-m-d H:i:s'); // Formato de fecha y hora

    $a = mysqli_query($con, "INSERT INTO ticket (user_id, repository_id, subject, task_type, ticket, status, posting_date) VALUES ('$user_id', '$repository_id', '$subject', '$tt', '$ticket', '$st', '$pdate')");
    if ($a) {
        echo "<script>alert('Ticket Registrado Correctamente'); location.replace(document.referrer)</script>";
    } else {
        echo "<script>alert('Error al registrar el ticket'); location.replace(document.referrer)</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>SGTD Crear Ticket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
</head>

<body class="">
    <?php include("header.php"); ?>
    <div class="page-container row-fluid">
        <?php include("leftbar.php"); ?>
        <div class="clearfix"></div>
        <!-- END SIDEBAR MENU -->
    </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="page-content">
        <div class="clearfix"></div>
        <div class="content">
            <div class="page-title">
                <h3>Crear ticket</h3>
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" name="form1" method="post" action="" onSubmit="return valid();">
                            <div class="panel panel-default">
                                <div class="panel-body bg-white">
                                    <?php if (isset($_SESSION['msg1'])) : ?>
                                        <p align="center" style="color:#FF0000"><?= $_SESSION['msg1']; ?><?= $_SESSION['msg1'] = ""; ?></p>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Asunto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="subject" id="subject" value="" required class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Tipo de Tarea</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select name="tasktype" class="form-control select" required>
                                                <option value="">Seleccionar</option>
                                                <option>Soporte Técnico</option>
                                                <option>Soporte Técnico Externo(comision)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Repositorio</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select name="repository" class="form-control select" required>
                                                <option value="">Seleccionar Repositorio</option>
                                                <?php
                                                $repos = mysqli_query($con, "SELECT * FROM repository");
                                                while ($repo = mysqli_fetch_assoc($repos)) {
                                                    echo "<option value='" . $repo['id'] . "'>" . $repo['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Descripción</label>
                                        <div class="col-md-6 col-xs-12">
                                            <textarea name="description" required class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-default">Resetear</button>
                                <input type="submit" value="Enviar" name="send" class="btn btn-primary pull-right">
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="assets/js/core.js" type="text/javascript"></script>
    <script src="assets/js/chat.js" type="text/javascript"></script>
    <script src="assets/js/demo.js" type="text/javascript"></script>

</body>

</html>
