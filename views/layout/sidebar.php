<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <?php
                    
                    $sesion = json_decode($_SESSION['usuario']['menu']);
                    foreach($sesion as $key=>$posicion){
                        echo '<a class="nav-link" href="'.base_url.$posicion->urlMenu.'">
                                    <div class="sb-nav-link-icon"><i class="'.$posicion->iconoMenu.'" aria-hidden="true"></i></div>
                                    '.$posicion->nombreMenu.'
                                </a>';
                    }
                    ?>




                    <!-- <div class="sb-sidenav-menu-heading">Inicio</div>
                    <a class="nav-link" href="<?= base_url ?>Cliente/index">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        NUEVO CLIENTE
                    </a>
                    <a class="nav-link" href="<?= base_url ?>Cliente/lista">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        CONSULTA CLIENTE
                    </a>
                    <a class="nav-link" href="<?= base_url ?>Proveedor/index">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        NUEVO PROVEEDOR
                    </a>
                    <a class="nav-link" href="<?= base_url ?>Proveedor/lista">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        CONSULTA PROVEEDOR
                    </a>
                    <a class="nav-link" href="<?= base_url ?>Compras/index">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        COMPRAS
                    </a>
                    <a class="nav-link" href="<?= base_url ?>Remision/index">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        REMISIONES
                    </a>
                    <a class="nav-link" href="<?= base_url ?>Pedido/index">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        PEDIDOS
                    </a>
                    <a class="nav-link" href="<?= base_url ?>Preventa/index">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        PREVENTA
                    </a>
                    <a class="nav-link" href="<?= base_url ?>Venta/index">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        VENTA
                    </a> -->
                    <div class="sb-sidenav-menu-heading">SUCURSALES</div>
                  <!--   <a class="nav-link" href="<?= base_url ?>Consultorio/nuevo">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        PACIENTES NUEVOS
                    </a> -->
                 <!--    <a class="nav-link" href="<?= base_url ?>Consulta/lista">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        MIS PACIENTES
                    </a> -->

                    <div class="sb-sidenav-menu-heading">Administracion</div>
                 <!--    <a class="nav-link" href="<?= base_url ?>Consultorio/control">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        CONTROL
                    </a> -->
                <!--     <a class="nav-link" href="<?= base_url ?>Doctor/index">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        ALTA DOCTOR
                    </a> -->

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small" id="idCamara" data-id="<?=$_SESSION['usuario']["camra"]; ?>">Hola Usuario:</div>
                <?php
                echo ucwords($_SESSION['usuario']['nombre']) . ' ' . ucwords($_SESSION['usuario']['apeliidos']);
                //echo ucwords(SED::decryption($_SESSION['usuario']['nombre']));  
                ?>

            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">