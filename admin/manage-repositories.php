<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();

// Lógica para agregar un nuevo repositorio
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_repository'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Insertar el nuevo repositorio en la base de datos
    $insert_query = "INSERT INTO repository (name, description) VALUES ('$name', '$description')";
    if (mysqli_query($con, $insert_query)) {
        echo "<script>alert('Repositorio agregado exitosamente');</script>";
        echo "<script>window.location.href='manage-repositories.php'</script>";
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
    <title>Admin | Gestionar Repositorios</title>
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
                <li><a href="#" class="active">Gestionar Repositorios</a>
                </li>
            </ul>
        
            <div class="page-title" style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center;">
                    <i class="fa fa-database" style="font-size: 24px; margin-right: 10px;"></i>
                    <h3 style="margin: 0;">Gestionar Repositorios</h3>
                </div>
                <button class="btn btn-success btn-xs rounded-0" data-toggle="modal" data-target="#addRepositoryModal" style="display: flex; align-items: center; padding: 6px 12px;">
                    <i class="fa fa-plus" style="color: #fff; margin-right: 8px;"></i> 
                    <span style="color: #fff; font-weight: 500;">Agregar Repositorio</span>
                </button>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple ">
                                <div class="grid-title no-border">
                                    <h4>Toda la Información de los Repositorios</h4>
                                    <div class="tools"> <a href="javascript:;" class="collapse"></a>
                                    </div>
                                </div>
                                <div class="grid-body no-border">

                                    <table class="table table-bordered table-hover no-more-tables">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre del Repositorio</th>
                                                <th>Descripción</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $ret = mysqli_query($con, "select * from repository");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($ret)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td>
                                                        <form name="abc" action="" method="post">
                                                            <a href="edit-repository.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-xs btn-mini rounded-0">Editar</a>
                                                            <!-- <button type="button" class="btn btn-danger btn-xs btn-mini rounded-0">Eliminar</button> -->
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

    <!-- Modal para agregar un nuevo repositorio -->
    <div id="addRepositoryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center; font-weight: bold;">Agregar Repositorio</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="name">Nombre del Repositorio</label>
                        <input type="text" class="form-control rounded-0" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control rounded-0" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer" style="justify-content: flex-end;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="add_repository" class="btn btn-success">Guardar</button>
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
