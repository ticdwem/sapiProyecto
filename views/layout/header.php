<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" /> -->
    <meta name="viewport" content="width=device-width, user-scalable=no, shrink-to-fit=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bienestar y Nueva Imagen</title>
    <!-- css stylo base -->
    <link href="<?=base_url?>assets/css/styles.css" rel="stylesheet" />
    <!-- css stylo propio -->
    <link href="<?=base_url?>assets/css/stilo.css" rel="stylesheet" />
    <!-- css boostrap -->
    <link rel="stylesheet" href="<?=base_url?>assets/css/css/bootstrap.min.css" >
    <!-- max css -->
    <link rel="stylesheet" href="<?=base_url?>assets/css/ccsBootstrap/maxcdn.bootstrap.min.css" >
    <!-- css datatable -->
    <link href="<?=base_url?>assets/css/ccsBootstrap/datable.bootstrap.min.css" rel="stylesheet" />
    <!-- css datepicker -->    
    <link href="<?=base_url?>assets/css/ccsBootstrap/datepicker.gijgo.min.css" rel="stylesheet" type="text/css" />

    
    <!-- js boostrap -->
    <script src="<?=base_url?>assets\js\bootstrap\jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <!-- <script src="<?=base_url?>assets\js\bootstrap\popper.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="<?=base_url?>assets\js\bootstrap\bootstrap.min.js"crossorigin="anonymous"></script> -->
    <!-- jquery -->
    <script src="<?=base_url?>assets\js\bootstrap\jquery.min.js"></script>
    <script src="<?=base_url?>assets\js\bootstrap\jquery-ui.js"></script>
    <!-- max js -->
    <script src="<?=base_url?>assets\js\bootstrap\1.12.9.umd.popper.min.js" crossorigin="anonymous"></script>
    <script src="<?=base_url?>assets\js\bootstrap\4.0.0.bootstrap.min.js" crossorigin="anonymous"></script>
    <!-- datepicker -->
    <script src="<?=base_url?>assets\js\bootstrap\gijgo@1.9.13.gijgo.min.js" type="text/javascript"></script> 
    <script src="<?=base_url?>assets\js\bootstrap\gijgo@1.19.13.messages.es-es.js" type="text/javascript">   </script>    
  <!-- datatables -->
    <script src="<?=base_url?>assets\js\bootstrap\1.10.20.jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="<?=base_url?>assets\js\bootstrap\1.10.20.dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <!-- fontawensome -->
    <script src="<?=base_url?>assets\js\bootstrap\fontAwensome.1849e1867b.js" crossorigin="anonymous"></script>
    <!-- swet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script src="<?=base_url?>assets/js/myjs.js"></script>
    <script src="<?=base_url?>assets/js/scripts.js"></script>
    <script src="<?=base_url?>assets/js/validar-campos.js"></script>
<!--     <script src="<?=base_url?>assets/demo/chart-area-demo.js"></script>
    <script src="<?=base_url?>assets/demo/chart-bar-demo.js"></script>
    <script src="<?=base_url?>assets/demo/datatables-demo.js"></script> -->

</head>
    <body class="sb-nav-fixed">
        <div id="container">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- <a class="navbar-brand" href="index.html">CByNI</a> --> <img src="<?=base_url?>assets/img/pila.png" width="225px" height="60px" alt=""> 
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button><!-- Navbar Search-->
            <div class="" id="headerBienestar">
                <div class="input-group divconsul">
                    <p class="consul"><?php if(isset($_SESSION['usuario'])){echo $_SESSION["usuario"]["consultorio"];} ?></p>
                </div>
            </div>
        <!-- Navbar-->
                <ul class="navbar-nav ml-auto ml-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <div id="menuDesplegable" class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">Herramientas</a>
                              <a class="dropdown-item" href="#">Activity Log</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?=base_url?>Loggin/logout">Salir</a>
                        </div>
                    </li>
  
                </ul>
            </nav>
           