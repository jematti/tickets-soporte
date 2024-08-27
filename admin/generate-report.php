<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Admin | Gestionar Servicios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="../assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
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
            <div class="modal-body"> Widget settings form goes here </div>
        </div>
        <div class="clearfix"></div>
        <div class="content">
            <ul class="breadcrumb">
                <li>
                    <p>Inicio</p>
                </li>
                <li><a href="#" class="active">Servicios</a> </li>
            </ul>
            <div class="page-title">
                <h3>Gestionar Reporte de Tickets</h3>
            </div>
            <div class="row">
                <div class="col-md-12">

                <form class="form-horizontal" name="form1" method="post" action="reporte.php">
                    <div class="panel panel-default">
                        <div class="panel-body bg-white">
                            <p align="center" style="color:#FF0000"><?php echo $_SESSION['msg1']; ?><?php echo $_SESSION['msg1'] = ""; ?></p>

                            <!-- Fecha de inicio -->
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Fecha de Inicio</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="date" name="ini_fecha" id="ini_fecha" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Fecha de fin -->
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Fecha de Fin</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="date" name="fin_fecha" id="fin_fecha" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Categoría de Reportes -->
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Categoría de Reportes</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-list"></span></span>
                                        <select name="categoria_reporte" id="categoria_reporte" class="form-control" required>
                                            <option value="">Seleccione una categoría</option>
                                            <option value="servicios">Servicios</option>
                                            <option value="tickets">Tickets</option>
                                            <option value="todos">Todos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Usuario -->
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Usuario</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                        <select name="usuario" id="usuario" class="form-control" required>
                                            <option value="">Seleccione un usuario</option>
                                            <option value="todos" style="font-weight: bold;">Todos los usuarios</option>
                                            <?php
                                            // Supongamos que tienes una conexión a la base de datos ya establecida
                                            $sql = "SELECT name, id FROM user";
                                            $result = mysqli_query($con, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="panel-footer">
                            <button type="reset" class="btn btn-default">Resetear</button>
                            <input type="submit" value="Generar Reporte" name="generar_reporte" class="btn btn-primary pull-right">
                        </div>
                    </div>
                </form>

                </div>
            </div>
        </div>

        <div class="addNewRow"></div>
    </div>

    </div>
    <script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="../assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="../assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <script src="../assets/js/datatables.js" type="text/javascript"></script>
    <script src="../assets/js/core.js" type="text/javascript"></script>
    <script src="../assets/js/chat.js" type="text/javascript"></script>
    <script src="../assets/js/demo.js" type="text/javascript"></script>
</body>

</html>