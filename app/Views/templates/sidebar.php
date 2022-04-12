<?php
    $sesionU = session();
    $Url= base_url();
    $limpiarCadenaUrl = str_replace('_', ' ', $Url);
    $nombreAplicacion = ucfirst(substr(strrchr($limpiarCadenaUrl, "/"), 1));
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>/dashboard" class="brand-link">
        <img src="<?php echo base_url(); ?>/dist/img/logo_blanco.png" class="brand-image " style="opacity: .8">
        <span class="brand-text "><?php if (empty($sesionU->aplicacion)) {  ?>
                <span class="text-sm text-bold">- <?= $nombreAplicacion ?></span>
            <?php }else{ ?>
                    <span><?= $sesionU->aplicacion ?></span>
                <?php } ?>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name=<?php echo $sesionU->nombres; ?>&background=EBF4FF&color=7F9CF5&bold=true" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="<?php echo base_url() . '/Login/profile/' . $sesionU->idUsuario; ?>" class="d-block"><?php echo $sesionU->nombres; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <!--   <li class="nav-header">MENU</li>  -->
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>/dashboard" class="nav-link <?php if (uri_string() == 'dashboard' || uri_string() == 'Dashboard') {?>
                                                                                                active
                                                                                            <?php }else{ 
                                                                                                        
                                                                                                ?><?php }?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p> Inicio </p>
                    </a>
                <!-- Despliegue Opciones Disponibles para Usuario -->
                <script>

                </script>
                <?php
                $id = 0; // Creamos una variable para iterarla
                $varContadora = 0;
                $nant = 0;
                $burl = base_url();
                $ourl = "#";
                $submenu  = 0;
                if (is_array($sesionU->opciones_menu) || is_object($sesionU->opciones_menu)) {
                    foreach ($sesionU->opciones_menu as $om) {
                        if ($nant == $om['nivel']) {
                            if (!empty($om['url_opcion'])) {
                                $ourl = $om['url_opcion'];
                            } else {
                                $ourl = "#";
                            }
                            
                            // Identificamos cada opción que sea de tipo MENU para agregarle un ID unico
                            if ($om['tipo_opcion'] == 'MENU') {

                                // Creamos nuestro ID para cada opción de tipo MENU
                                $nombreMenu = 'MENU'.$id++;
                            }else{
                                // De lo contrario dejamos la variable vacia, haciendo referencia a que la opción que se creó es diferente a MENU
                                $nombreMenu = '';
                            }
                            
                            echo '<li id="'.$nombreMenu.'" class="nav-item "> ';

                                // Optenemos la URL en la que nos econtramos y le concatenamos un / para poderla comprar con $om['url_opcion'] 
                                $obtenerURL = '/'.uri_string();
                                if ($obtenerURL == $om['url_opcion']) {
                                    // Creamos una variable con la clase active para que cuando se cumpla el IF esta opción se cree con ella
                                    $opcionSeleccionada = 'active';
                                    
                                }else{
                                    // De lo contrario es porque no está seleccionada
                                    $opcionSeleccionada =  '';
                                }
                                echo '<a href=' . $burl . $ourl . ' class="nav-link '. $opcionSeleccionada .'">';
                                    echo '<i class="nav-icon ' . $om['icono_opcion'] . '"></i> ';
                                    echo '<p>' . $om['descripcion_corta'];
                            if ($om['tipo_opcion'] == 'MENU') {
                                    echo '<i class="right fas fa-angle-left"></i>';
                            }
                                    echo '</p>';
                                echo '</a>';
                            if ($om['tipo_opcion'] == 'MENU') {
                                echo '<ul class="nav nav-treeview"> ';
                                    $submenu = $submenu + 1;
                                    
                            } else {
                                echo '</li> ';
                            }
                        } else {
                            if ($om['nivel'] < $nant) {
                                if ($submenu > 0) {
                                    $submenu = $submenu - 1;
                                }
                                    echo '</ul>';
                                echo '</li>';
                            }
                            $nant = $om['nivel'];
                            
                            if (!empty($om['url_opcion'])) {

                                $ourl = $om['url_opcion'];
                            } else {
                                $ourl = "#";
                            }

                            // Optenemos la URL en la que nos econtramos y le concatenamos un / para poderla comprar con $om['url_opcion'] 
                            $obtenerURL2 = '/'.uri_string();
                            if ($obtenerURL2 == $om['url_opcion']) {
                                
                                // Creamos una variable con la clase active para que cuando se cumpla el IF esta opción se cree con ella
                                $opcionSeleccionada = 'active';
                            }else{

                                // De lo contrario es porque no está seleccionada
                                $opcionSeleccionada =  '';
                            }

                            // Identificamos cada opción que sea de tipo MENU para agregarle un ID unico
                            if ($om['tipo_opcion'] == 'MENU') {

                                // Creamos nuestro ID para cada opción de tipo MENU
                                $nombreMenu = 'MENU'.$id++;
                            }else{
                                // De lo contrario dejamos la variable vacia, haciendo referencia a que la opción que se creó es diferente a MENU
                                $nombreMenu = '';
                            }

                            echo '<li id="'.$nombreMenu.'" class="nav-item"> ';
                                echo '<a class="nav-link '. $opcionSeleccionada .'" href=' . $burl . $ourl . ' "> '; //Aqui se llama a los elementos de los submenu
                                    echo '<i class="nav-icon ' . $om['icono_opcion'] . '"></i> ';
                                        echo '<p>' . $om['descripcion_corta'];
                            if ($om['tipo_opcion'] == 'MENU') {
                                    echo '<i class="right fas fa-angle-left"></i>';
                            }
                                    echo '</p>';
                                echo '</a>';
                            if ($om['tipo_opcion'] == 'MENU') {
                                echo '<ul class="nav nav-treeview"> ';
                                    $submenu = $submenu + 1;
                             } else {
                                echo '</li> ';
                             }
                        }
                        // Pasamos nuestro iterador a una variable
                            // Con esto identificamos cuantas opciones de MENU se crearon
                        $varContadora = $id;
                    }
                } else {
                    // Aqui SALIR DEL SISTEMA (Destruir la sesion)
                    session_destroy();
                }
                // Si hubo manejo de submenues -- cierra los pendientes
                if ($submenu > 0) {
                        echo '  </ul> ';
                    echo '</li> ';
                }
                ?>
                <!-- /.Despliegue Opciones Disponibles para Usuario -->
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>/Login/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p> Salir del Sistema </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Creamos un SCRIPT para poder jugar con el DOM -->
<script>
    // Pasamos nuestra cantidad de MENU contados a una variable para poder iterar las veces necesarias
    let contador = <?= $varContadora ?>;
    for (var i = 0; i <= contador; i++) {
        //Identificamos los MENU secualciamente
        var menu = document.getElementById('MENU'+i);

        // Si este es encontrado, entonces es verdadero y entramos dentro del IF
        if (menu) {
            // Identificamos dentro de los elementos aquel que se haya creado con la clase active o en su defecto y explicación llana, que este seleccionado
                // Lo pasamos a una variable
            var f = document.querySelector('li ul li a.active');
            // Si este es encontrado, entonces es verdadero y entramos dentro del IF
            if (f) {
                // Igualamos b a MENU
                var b = menu;
                        // dentro de b que es MENU identificamos aquella opcion seleccionada
                var k = b.querySelector('li ul li a.active');
                // Si este es encontrado, entonces es verdadero y entramos dentro del IF
                    // Agregamos las clases que necesitamos para que el menu quede abierto si este esta seleccionado
                if (k) {
                    b.classList.add('menu-is-opening','menu-open');
                    var c = b.querySelector('a.nav-link'); // identificamos al MENU
                    c.classList.add('active');// Le pasamos la clase active para que cambie de color 
                }
            }
        }   
    }
</script>