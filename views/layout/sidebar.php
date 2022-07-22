<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <?php if (isset($_SESSION['usuario'])): ?>
                <div class="nav">
                    <?php
                    $sesion = json_decode($_SESSION['usuario']['menu']);
                    foreach($sesion as $key=>$posicion){
                        echo '<a class="nav-link"  href="'.base_url.$posicion->urlMenu.'">
                                    <div class="sb-nav-link-icon"><i class="'.$posicion->iconoMenu.'" aria-hidden="true"></i></div>
                                    '.$posicion->nombreMenu.'
                                </a>';
                    }
                    ?>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small" id="idCamara" data-id="<?=$_SESSION['usuario']["camra"]; ?>">Hola Usuario:</div>
                <?php
                echo ucwords($_SESSION['usuario']['nombre']) . ' ' . ucwords($_SESSION['usuario']['apeliidos']);
                //echo ucwords(SED::decryption($_SESSION['usuario']['nombre']));  
                ?>

            </div>
            <?php endif;?>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">