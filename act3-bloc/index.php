<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de notas</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

    <!-- Navegador -->
    <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper">
            <a href="#!" class="brand-logo center">Actividad 3</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons white-text">menu</i></a>
          </div>   
        </nav>
    </div>

    <div id="container" class="section white">
        <h3><b>Bloc de notas</b></h3>
        <!-- Formulario para crear un nuevo archivo de texto -->
        <form method="POST" action="index.php">
            <div class="row">
                <div class="col s12 m6">
                    <label for="filename">Nombre del archivo:</label>
                    <input type="text" name="filename" id="filename">
                </div>
                <div class="col s12 m6">
                    <br>
                    <input class="waves-effect waves-light red btn" type="submit" name="create" value="Nuevo Archivo">
                </div>
            </div>
            
            <div id="botones" class="row">
                <div class="col s12 m6">
                    <label for="openfile">Abrir archivo:</label>
                    <select name="openfile" id="openfile">
                        <!-- Lista de archivos -->
                        <?php
                        $files = scandir('./archivos');
                        foreach ($files as $file) {
                            if ($file != '.' && $file != '..' && is_file('./archivos/' . $file)) {
                                echo "<option value='$file'>$file</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col s12 m6">
                    <br>
                    <input class="waves-effect waves-light red btn" type="submit" name="open" value="Abrir archivo">
                </div>
                
            </div>

            <div class="row">
                <?php
                if (!isset($_POST['openfile'])) {
                    echo "<br><br><br>";
                    echo "<textarea name='content' rows='10' cols='40'></textarea>";
                }
                ?>
            </div>

        </form>

        <!-- Formulario para guardar un archivo abierto -->
        <?php
        if (isset($_POST['openfile'])) {
            $filename = $_POST['openfile'];
            $content = file_get_contents('./archivos/' . $filename); // Lee el contenido del archivo seleccionado
            echo "<form method='POST' action='index.php'>";
            echo "<input type='hidden' name='currentfile' value='$filename'>";
            echo "<h5><b>$filename.txt</b></h5>";
            echo "<textarea name='content' rows='10' cols='40'>$content</textarea>";
            echo "<br><br>";
            echo "<input class='waves-effect waves-light red btn' type='submit' name='save' value='Guardar'>";
            echo "</form>";
        }
        ?>

        <!-- PHP para manejar la creación y guardado de archivos -->
        <?php
        if (isset($_POST['create'])) {
            $filename = $_POST['filename'];
            $content = $_POST['content'];
            file_put_contents('./archivos/' . $filename, $content); // Guarda el contenido en un archivo
            echo "Archivo creado: $filename";
            header("Location: ".$_SERVER['REQUEST_URI']);
            exit();
        }

        if (isset($_POST['save'])) {
            $filename = $_POST['currentfile'];
            $content = $_POST['content'];
            file_put_contents('./archivos/' . $filename, $content); // Guarda el contenido en el archivo abierto
            echo "Archivo guardado: $filename";
        }
        ?>

    </div>

    <!-- Footer -->
    <footer class="page-footer">
        <div class="container">
          <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Más información</h5>
                <p class="grey-text text-lighten-4">Actividad 3 de Programación Web</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                <li><a class="grey-text text-lighten-3" href="http://www.virtudvirtual.site">Página Principal</a></li>
                <li><a class="grey-text text-lighten-3" href="https://github.com/Mariduq/pw-act3.git">Github</a></li>
                </ul>
            </div>
          </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
            © 2023 Copyright. Todos los derechos reservados. <br> Maracaibo - Zulia. Venezuela
            </div>
        </div>
    </footer>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="assets/js/index.js"></script>
</body>
</html>