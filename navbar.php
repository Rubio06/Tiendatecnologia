<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <?php 
        session_start();
        if (!isset($_SESSION["usuario"])) {
            header("location: index.php");
        }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MENU DE NAVEGACIÓN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Vender producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Menú
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex form div-sesion">
                    <div class="div-bienvenido">
                        <div class="div-foto">
                        <?php 
                            try{
                                $base = new PDO("mysql:host=localhost; dbname=practica","root", "");
                                $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = "SELECT imagen FROM login WHERE usuario= :i_usuario";
                                $result = $base->prepare($query);
                                $varsesion = $_SESSION['usuario'];
                                $result->execute(array(":i_usuario"=>$varsesion));
                                    while($registro = $result->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <img style="border-radius:50%; height:63px; width:70px;"src="<?php echo $registro["imagen"] ?>" alt="">
                                    <?php 
                                    }
                            }catch (Exception $e) {
                                die("Error" . $e->getMessage());
                            }
                        ?>
                        </div>
                        <div class="div-usuario">
                            <?php echo "|| Bienvenido administrador: ||<br>" . $_SESSION["usuario"]; ?>
                        </div>
                    </div>       
                    <div class="div-btncerrar">
                        <a class="btn btn-outline-success" href="cierre_sesion.php">Cerrar sessión</a>
                    </div>         
                </div>
            </div>
        </div>
    </nav><br>
</body>
</html>
