<?php 
    include "conex/conexion.php";
    $cn = Conectarse();

    if (isset($_POST["op"])) {
        $op = $_POST["op"];
        switch($op){
            ///////////////////
            case "mostrarDatos":
                $sql = "SELECT codpro,codigo,nombre, cantidad, precio, fecharegistro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado ORDER BY `producto`.`codigo` ASC";
                $exe = mysqli_query($cn, $sql);
                //Obtener todas las filas en un array asociativo, numérico, o en ambos
                $datos = mysqli_fetch_all($exe, MYSQLI_ASSOC);
                echo json_encode($datos);
                $cn->close();
            break;
            ///////////////////
            case "buscar":
                $salida = "";
                $query = "SELECT codpro,codigo,nombre, cantidad, precio, fecharegistro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado ORDER BY `producto`.`codigo` ASC";
                if (isset($_POST["busqueda"])) {
                    $busqueda = limpiar_cadena($_POST["busqueda"]);
                    $query = "SELECT codpro,codigo,nombre, cantidad, precio, fecharegistro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado WHERE producto.nombre LIKE '%" .$busqueda. "%' ORDER BY `producto`.`codigo` ASC;";
                }
                $result = mysqli_query($cn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($lista = mysqli_fetch_assoc($result)) {
                        $salida.= "
                                <tr id='codigo' ondblclick='darClick(" . $lista["codigo"] . ")'>
                                    <td scope='row' style='background:#B9F3B3; font-weight: bold;'>" . $lista["codpro"] .$lista["codigo"] . "</td>
                                    <td>" . $lista["nombre"] . "</td>
                                    <td>" . $lista["cantidad"] . "</td>
                                    <td>" . $lista["precio"] . "</td>
                                    <td>" . $lista["fecharegistro"] . "</td>
                                    <td>" . $lista["CATEGORIA"] . "</td>
                                    <td>" . $lista["ESTADO"] . "</td>
                                </tr>
                                ";
                    }
                }else {
                    $salida .= "No hay datos feo :(";
                }
                echo json_encode($salida);
                $cn->close();
            break;
            ///////////////////
            case "buscarFecha":
                $salida = "";
                $query = "SELECT codpro,codigo,nombre, cantidad, precio, fecharegistro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado ORDER BY `producto`.`codigo` ASC";
                if (isset($_POST["desde"]) && isset($_POST["hasta"])) {
                    $desde = limpiar_cadena($_POST["desde"]);
                    $hasta = limpiar_cadena($_POST["hasta"]);

                    $query = "SELECT codpro,codigo,nombre, cantidad, precio, fecharegistro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado WHERE fecharegistro BETWEEN '$desde' AND '$hasta'";
                }
                $result = mysqli_query($cn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($lista = mysqli_fetch_assoc($result)) {
                        $salida.= "
                                <tr id='codigo' ondblclick='darClick(" . $lista["codigo"] . ")'>
                                    <td scope='row' style='background:#B9F3B3; font-weight: bold;'>" . $lista["codpro"] .$lista["codigo"] . "</td>
                                    <td>" . $lista["nombre"] . "</td>
                                    <td>" . $lista["cantidad"] . "</td>
                                    <td>" . $lista["precio"] . "</td>
                                    <td>" . $lista["fecharegistro"] . "</td>
                                    <td>" . $lista["CATEGORIA"] . "</td>
                                    <td>" . $lista["ESTADO"] . "</td>
    
                                </tr>
                                ";
                    }
                }else {
                    $salida .= "No hay datos de fecha :(";
                }
                echo json_encode($salida);
                $cn->close();
            break;
            ///////////////////
            case "buscarCategoria":
                $salida = "";
                $sql = "SELECT codpro,codigo,nombre, cantidad, precio, fecharegistro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado ORDER BY `producto`.`codigo` ASC";
                if (isset($_POST["categoria"])) {
                    $categoria = $_POST["categoria"];
                    $sql = "SELECT codpro,codigo ,nombre, cantidad,precio,fecharegistro,categoria,estado FROM `producto` INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON estado.cod_estado = producto.codestado WHERE categoria.cod_categoria = '$categoria' ORDER BY `producto`.`codigo` ASC;";
                }else{
                    $sql = "SELECT codpro,codigo,nombre, cantidad, precio, fecharegistro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado ORDER BY `producto`.`codigo` ASC";
                }
                $query = mysqli_query($cn,$sql);
                if (mysqli_num_rows($query) > 0) {
                    while($lista =mysqli_fetch_assoc($query)){
                        $salida.= "
                        <tr id='codigo' ondblclick='darClick(" . $lista["codigo"] . ")'>
                            <td scope='row' style='background:#B9F3B3; font-weight: bold;'>" .$lista["codpro"] . $lista["codigo"] . "</td>
                            <td>" . $lista["nombre"] . "</td>
                            <td>" . $lista["cantidad"] . "</td>
                            <td>" . $lista["precio"] . "</td>
                            <td>" . $lista["fecharegistro"] . "</td>
                            <td>" . $lista["categoria"] . "</td>
                            <td>" . $lista["estado"] . "</td>
                        </tr>
                        ";
                    }
                } else {
                    $salida .= "<td colspan='7'>No hay datos de categoria :(</td>";
                }
                echo json_encode($salida);
                $cn->close();
            break;
            /////////////////////
            case "insertarDatos":

                try{
                    $base = new PDO("mysql:host=localhost; dbname=practica","root","");
                    $base->exec("SET CHARACTER SET utf8");

                    $codpro = limpiar_cadena($_POST["codpro"]);
                    $nombre = limpiar_cadena($_POST["nombre"]);
                    $cantidad = limpiar_cadena($_POST["cantidad"]);
                    $precio = limpiar_cadena($_POST["precio"]);
                    $fecharegistro = limpiar_cadena($_POST["fecharegistro"]);
                    $codcategoria = limpiar_cadena($_POST["codcategoria"]);
                    $codestado = limpiar_cadena($_POST["codestado"]);
                    // $sql = "INSERT INTO `producto`(`codpro`,`nombre`, `cantidad`, `precio`, `fecharegistro`, `codcategoria`, `codestado`) VALUES ('$codpro','$nombre','$cantidad','$precio','$fecharegistro','$codcategoria','$codestado')";
    
                    $sql = "INSERT INTO producto (codpro,nombre, cantidad, precio, fecharegistro, codcategoria, codestado) VALUES (:in_codpro, :in_nombre, :in_cantidad, :in_precio, :in_fecharegistro, :in_codcategoria, :in_codestado)";
                    $result = $base->prepare($sql);
                    $data = $result->execute(array( ":in_codpro"=>$codpro,
                                            ":in_nombre"=>$nombre,
                                            ":in_cantidad"=>$cantidad,
                                            ":in_precio"=>$precio,
                                            ":in_fecharegistro"=>$fecharegistro,
                                            ":in_codcategoria"=>$codcategoria,
                                            ":in_codestado"=>$codestado));
                    // $conex = mysqli_query($cn, $sql);
                    echo json_encode($data);
                }catch(Exception $e){
                    die("Error" . $e->getMessage());
                }
            break;
            //////////////////
            case "mostrarInput":
                $codigo = limpiar_cadena($_POST["codigo"]); 
                $sql = "SELECT * FROM producto WHERE codigo ='$codigo'";
                $result = mysqli_query($cn ,$sql);
                $datos = mysqli_fetch_all($result, MYSQLI_ASSOC);
                echo json_encode($datos);
                $cn->close();

            break;
            ////////////////
            case "actualizarDatos":
                $codigo = limpiar_cadena($_POST["codigo"]);
                $nombre = limpiar_cadena($_POST["nombre"]);
                $cantidad = limpiar_cadena($_POST["cantidad"]);
                $precio = limpiar_cadena($_POST["precio"]);
                $fecharegistro = limpiar_cadena($_POST["fecharegistro"]);
                $codcategoria = limpiar_cadena($_POST["codcategoria"]);
                $codestado = limpiar_cadena($_POST["codestado"]);
                $sql = "UPDATE producto SET nombre='$nombre', cantidad='$cantidad', precio='$precio', fecharegistro='$fecharegistro',codcategoria='$codcategoria',codestado='$codestado' WHERE codigo ='$codigo'";
                $result = mysqli_query($cn, $sql);
                echo json_encode($result);
                $cn->close();

            break;
            ////////////////
            case "eliminarDatos":
                $codigo = limpiar_cadena($_POST["codigo"]);
                $sql = "DELETE FROM `producto` WHERE `codigo`='$codigo'";
                $result = mysqli_query($cn, $sql);
                echo json_encode($result);
                $cn->close();
            break;

            case "logearse":
                try {
                    $base = new PDO("mysql:host=localhost; dbname=practica","root", "");
                    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT * FROM login WHERE usuario=:l_usuario AND contrasena=:l_contrasena";
                    $result = $base->prepare($sql);
                
                    $usuario = htmlentities(limpiar_cadena($_POST["usuario"]));
                    $contrasena = htmlentities(limpiar_cadena(md5($_POST["contrasena"])));
                    // $result->bindValue(":l_usuario",$usuario);
                    // $result->bindValue(":l_contrasena",$contrasena);
                    // $result->bindValue(array(":l_usuario"=>$usuario,
                    //                         ":l_contrasena"=>$contrasena));
                    $result->execute(array( ":l_usuario"=>$usuario,
                                            ":l_contrasena"=>$contrasena));
                    // $result->execute();
                    $num_registros = $result->rowCount();
                    session_start();
                    $_SESSION["usuario"] = $_POST["usuario"];
                    echo json_decode($num_registros);
                    
                    $result->closeCursor();
            
                } catch (Exception $e) {
                    die("Error" . $e->getMessage());
                }
            break;
            ////////////////
            case "registrarme":
                $nombre = limpiar_cadena($_POST["nombre"]);
                $apellido = limpiar_cadena($_POST["apellido"]);
                $correo = limpiar_cadena($_POST["correo"]);
                $usuario = limpiar_cadena($_POST["usuario"]);
                $contrasena = limpiar_cadena(md5($_POST["contrasena"]));
                // $contrasena = limpiar_cadena(md5($_POST["contrasena"]));
                $fecha = limpiar_cadena($_POST["fecha"]);
                $imagen = "";
                
                $verificar_usuario = mysqli_query($cn, "SELECT * FROM login WHERE usuario = '$usuario'");
                $verificar_contrasena = mysqli_query($cn, "SELECT * FROM login WHERE contrasena = '$contrasena'");
                $verificar_correo = mysqli_query($cn, "SELECT * FROM login WHERE correo = '$correo'");
                $verificar_imagen = mysqli_query($cn, "SELECT * FROM login WHERE imagen = '$imagen'");

                
                if (mysqli_num_rows($verificar_usuario) > 0 || mysqli_num_rows($verificar_contrasena) > 0 || mysqli_num_rows($verificar_correo) > 0 || mysqli_num_rows($verificar_imagen) > 0) {
                    echo json_encode("Ya existe el usuario registrado, intente ingresar otro");        
                    exit();       
                } else {
                    if (isset($_FILES["imagen"])) {
                        $file = $_FILES["imagen"];
                        $nombre_img = $file["name"];
                        $tipo = $file["type"];
                        $ruta_provisional = $file["tmp_name"];
                        $size = $file["size"];
                        $dimensiones = getimagesize($ruta_provisional);
                        $width = $dimensiones[0];
                        $height = $dimensiones[1];
                        $carpeta = "img/";
                        
                        if ($tipo != "image/jpg" && $tipo != "image/JPG" && $tipo != "image/jpeg" && $tipo != "image/png" && $tipo != "image/gif") {
                            echo "El archivo no es una imagen";
                        }else if($size > 3*2000*2000){
                            echo "Error, el tamañno maximo permitido es un 3MB";
                        }else{
                            $src = $carpeta . $nombre_img;
                            move_uploaded_file($ruta_provisional, $src);
                            $imagen = "img/" . $nombre_img;
                        }
                    }
                    $query = mysqli_query($cn, "INSERT INTO `login`(`nombre`, `apellido`, `correo`, `usuario`, `contrasena`, `fecha`, `imagen`) VALUES ('$nombre','$apellido','$correo','$usuario','$contrasena','$fecha','$imagen')");
                        echo json_encode($query);
            break;
        }
    }
}

    //TRIM:ELIMINA ESPACIOS EN BLANCO DESDE EL INICIO Y AL FINAL
    //stripcslashes: elimina los shlash de la cadena
    //str_ireplace: REEMPLAZA UN TEXTO MEDIANTE UNA BUSQUEDA
    function limpiar_cadena($cadena){
        $cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		$cadena=str_ireplace("<script>", "", $cadena);
		$cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
    }
?>