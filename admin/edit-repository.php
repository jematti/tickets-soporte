<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();

// Obtener el ID del repositorio a editar
$repository_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($repository_id == 0) {
    echo "<script>alert('ID de repositorio inválido');</script>";
    echo "<script>window.location.href='manage-repositories.php'</script>";
    exit;
}

// Lógica para actualizar un repositorio
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_repository'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Actualizar el repositorio en la base de datos
    $update_query = "UPDATE repository SET name='$name', description='$description' WHERE id='$repository_id'";
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Repositorio actualizado exitosamente');</script>";
        echo "<script>window.location.href='manage-repositories.php'</script>";
    } else {
        echo "<script>alert('Ocurrió un error. Por favor, intente nuevamente.');</script>";
    }
}

// Obtener la información del repositorio actual
$repository_query = "SELECT * FROM repository WHERE id='$repository_id'";
$repository_result = mysqli_query($con, $repository_query);
$repository_data = mysqli_fetch_array($repository_result);

if (!$repository_data) {
    echo "<script>alert('Repositorio no encontrado');</script>";
    echo "<script>window.location.href='manage-repositories.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Admin | Editar Repositorio</title>
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
                <li><a href="manage-repositories.php" class="active">Gestionar Repositorios</a>
                </li>
                <li><a href="#" class="active">Editar Repositorio</a>
                </li>
            </ul>

            <div class="page-title">
                <h3>Editar Repositorio</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="grid simple">
                        <div class="grid-title no-border">
                            <h4>Editando el Repositorio <strong><?php echo htmlspecialchars($repository_data['name']); ?></strong></h4>
                            <div class="tools"> <a href="javascript:;" class="collapse"></a>
                            </div>
                        </div>
                        <div class="grid-body no-border">

                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="name">Nombre del Repositorio</label>
                                    <input type="text" class="form-control rounded-0" id="name" name="name" value="<?php echo htmlspecialchars($repository_data['name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea class="form-control rounded-0" id="description" name="description" rows="4" required><?php echo htmlspecialchars($repository_data['description']); ?></textarea>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="update_repository" class="btn btn-primary">Actualizar</button>
                                    <a href="manage-repositories.php" class="btn btn-default">Cancelar</a>
                                </div>
                            </form>

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
