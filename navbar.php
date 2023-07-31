<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/nav.css">
</head>

<body>
    <?php 
        session_start();
        if (!isset($_SESSION["usuario"])) {
            header("location: index.php");
        }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar navbar-dark bg-dark" style="position: sticky; top:0; z-index:100;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="div-logo">
                    <a class="navbar-brand logo-imagen" href="#"><img src="./imagenes/compuitadoras.png" alt=""></a>
                </div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="venta_producto.php">Vender producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="venta_producto.php">Vender producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="venta_producto.php">Vender producto</a>
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
                            <img style="border-radius:50%; height:63px; width:70px;"
                                src="<?php echo $registro["imagen"] ?>" alt="">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>