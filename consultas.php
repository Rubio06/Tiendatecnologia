<?php 
    include "conex/conexion.php";
    $cn = Conectarse();

    if (isset($_POST["op"])) {
        $op = $_POST["op"];
        switch($op){
            ///////////////////
            case "mostrarDatos":
                $sql = "SELECT codpro,codigo,nombre, cantidad, precio,fecha_registro,categoria.categoria'CATEGORIA',estado.estado'ESTADO',cliente.cliente_codigo'CODCLIENTE' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado INNER JOIN cliente ON producto.fk_cliente = cliente.cliente_codigo  ORDER BY `producto`.`codigo` ASC";
                $exe = mysqli_query($cn, $sql);
                //Obtener todas las filas en un array asociativo, numérico, o en ambos
                $datos = mysqli_fetch_all($exe, MYSQLI_ASSOC);
                echo json_encode($datos);
                $cn->close();
            break;
            ///////////////////
            case "buscar":
                $salida = "";
                $query = "SELECT codpro,codigo,nombre, cantidad, precio,fecha_registro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado ORDER BY `producto`.`codigo` ASC";
                if (isset($_POST["busqueda"])) {
                    $busqueda = limpiar_cadena($_POST["busqueda"]);
                    $query = "SELECT codpro,codigo,nombre, cantidad, precio,fecha_registro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado WHERE producto.nombre LIKE '%" .$busqueda. "%' ORDER BY `producto`.`codigo` ASC;";
                }
                $result = mysqli_query($cn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($lista = mysqli_fetch_assoc($result)) {
                        $salida.= "
                                <tr id='codigo' ondblclick='darClick(" . $lista["codigo"] . ")'>
                                    <td scope='row' style='background:#B9F3B3; font-weight: bold;'>" . $lista["codpro"] .$lista["codigo"] . "</td>
                                    <td>" . $lista["nombre"] . "</td>
                                    <td style='text-align:center;'>" . $lista["cantidad"] . "</td>
                                    <td style='text-align:center;'>" . $lista["precio"] . "</td>
                                    <td style='text-align:center;'>" . $lista["fecha_registro"] . "</td>
                                    <td style='text-align:center;'>" . $lista["CATEGORIA"] . "</td>
                                    <td>" . $lista["ESTADO"] . "</td>
                                    
                                    <td style='text-align:center;'> <button onclick='mandarId(`" .  $lista['codigo'] ."`,`" . $lista['nombre'] . "`,`" . $lista['precio'] . "`,`" . $lista['CATEGORIA'] . "`,`" . $lista['ESTADO'] ."`)' style='border:none; font-size:25px;' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-cart-shopping'></i></button></td>
                                </tr>
                                ";
                    }
                }else {
                    $salida .= "No hay datos feo :(";
                }
                echo json_encode($salida);
                $cn->close();
            break;

            ///
            case "countResultado":
                $busqueda = $_POST["busqueda"];
                $sql = "SELECT COUNT(*) AS 'RESULTADO' FROM producto WHERE nombre LIKE '%" . $busqueda. "%'";

                $exe = mysqli_query($cn, $sql);
                if (mysqli_num_rows($exe) > 0) {
                    $datos = mysqli_fetch_all($exe, MYSQLI_ASSOC);
                }
                echo json_encode($datos);
                $cn->close();

            break;

            ///////////////////
            case "buscarFecha":
                $salida = "";
                $query = "SELECT codpro,codigo,nombre, cantidad, precio, fecha_registro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado ORDER BY `producto`.`codigo` ASC";
                if (isset($_POST["desde"]) && isset($_POST["hasta"])) {
                    $desde = limpiar_cadena($_POST["desde"]);
                    $hasta = limpiar_cadena($_POST["hasta"]);

                    $query = "SELECT codpro,codigo,nombre, cantidad, precio, fecha_registro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado WHERE fecha_registro BETWEEN '$desde' AND '$hasta'";
                }
                $result = mysqli_query($cn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($lista = mysqli_fetch_assoc($result)) {
                        $salida.= "
                                <tr id='codigo' ondblclick='darClick(" . $lista["codigo"] . ")'>
                                    <td scope='row' style='background:#B9F3B3; font-weight: bold;'>" . $lista["codpro"] .$lista["codigo"] . "</td>
                                    <td>" . $lista["nombre"] . "</td>
                                    <td style='text-align:center;'>" . $lista["cantidad"] . "</td>
                                    <td style='text-align:center;'>" . $lista["precio"] . "</td>
                                    <td>" . $lista["fecha_registro"] . "</td>
                                    <td style='text-align:center;'>" . $lista["CATEGORIA"] . "</td>
                                    <td style='text-align:center;'>" . $lista["ESTADO"] . "</td>

                                    <td style='text-align:center;'> <button onclick='mandarId(`" .  $lista['codigo'] ."`,`" . $lista['nombre'] . "`,`" . $lista['precio'] . "`,`" . $lista['CATEGORIA'] . "`,`" . $lista['ESTADO'] ."`)'  style='border:none; font-size:25px;' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-cart-shopping'></i></button></td>
    
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
                $sql = "SELECT codpro,codigo,nombre, cantidad, precio, fecha_registro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado ORDER BY `producto`.`codigo` ASC";
                if (isset($_POST["categoria"])) {
                    $categoria = $_POST["categoria"];
                    $sql = "SELECT codpro,codigo ,nombre, cantidad,precio,fecha_registro,categoria,estado FROM `producto` INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON estado.cod_estado = producto.codestado WHERE categoria.cod_categoria = '$categoria' ORDER BY `producto`.`codigo` ASC;";
                }else{
                    $sql = "SELECT codpro,codigo,nombre, cantidad, precio, fecha_registro,categoria.categoria'CATEGORIA',estado.estado'ESTADO' FROM producto INNER JOIN categoria ON producto.codcategoria = categoria.cod_categoria INNER JOIN estado ON producto.codestado = estado.cod_estado ORDER BY `producto`.`codigo` ASC";
                }
                $query = mysqli_query($cn,$sql);
                if (mysqli_num_rows($query) > 0) {
                    while($lista =mysqli_fetch_assoc($query)){
                        $salida.= "
                        <tr id='codigo' ondblclick='darClick(" . $lista["codigo"] . ")'>
                            <td scope='row' style='background:#B9F3B3; font-weight: bold;'>" .$lista["codpro"] . $lista["codigo"] . "</td>
                            <td>" . $lista["nombre"] . "</td>
                            <td style='text-align:center;'>" . $lista["cantidad"] . "</td>
                            <td style='text-align:center;'>" . $lista["precio"] . "</td>
                            <td style='text-align:center;'>" . $lista["fecha_registro"] . "</td>
                            <td style='text-align:center;'>" . $lista["categoria"] . "</td>
                            <td style='text-align:center;'>" . $lista["estado"] . "</td>

                            <td style='text-align:center;'> <button onclick='mandarId(`" .  $lista['codigo'] ."`,`" . $lista['nombre'] . "`,`" . $lista['precio'] . "`,`" . $lista['categoria'] . "`,`" . $lista['estado'] ."`)'  style='border:none; font-size:25px;' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-cart-shopping'></i></button></td>
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
                    $codcategoria = limpiar_cadena($_POST["codcategoria"]);
                    $codestado = limpiar_cadena($_POST["codestado"]);
                    $fk_cliente = limpiar_cadena($_POST["fk_cliente"]);

                    $sql = "INSERT INTO producto (codpro,nombre, cantidad, precio, codcategoria, codestado,fk_cliente) VALUES (:in_codpro, :in_nombre, :in_cantidad, :in_precio, :in_codcategoria, :in_codestado, :in_fkcliente)";
                    $result = $base->prepare($sql);
                    $data = $result->execute(array( ":in_codpro"=>$codpro,
                                            ":in_nombre"=>$nombre,
                                            ":in_cantidad"=>$cantidad,
                                            ":in_precio"=>$precio,
                                            ":in_codcategoria"=>$codcategoria,
                                            ":in_codestado"=>$codestado,
                                            ":in_fkcliente"=>$fk_cliente));
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
                $codigo = $_POST["codigo"];
                $nombre = $_POST["nombre"];
                $cantidad = $_POST["cantidad"];
                $precio = $_POST["precio"];
                // $fecharegistro = limpiar_cadena($_POST["fecharegistro"]);
                $codcategoria = $_POST["codcategoria"];
                $codestado = $_POST["codestado"];
                $sql = "UPDATE producto SET nombre='$nombre', cantidad='$cantidad', precio='$precio' , codcategoria='$codcategoria',codestado='$codestado' WHERE codigo ='$codigo'";
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
            ///////REPONER STOCK
            case "reponerStock":               
                $codigo = $_POST['codigo'];
                $cn->begin_transaction();
                // Obtener el stock actual del producto
                $stock_query = "SELECT listar_cantidad FROM listar_productos WHERE listar_id = '$codigo'";
                $stock_result = $cn->query($stock_query);
                $stock_row = $stock_result->fetch_assoc();
                $stock_cantidad = $stock_row['listar_cantidad'];
                
                $stock_query = "SELECT * FROM listar_productos INNER JOIN producto ON listar_productos.fk_productos = producto.codigo WHERE listar_productos.listar_id = $codigo;";
                $stock_result = $cn->query($stock_query);
                $stock_row = $stock_result->fetch_assoc();
                $stock_productos = $stock_row['listar_cantidad'];
                
                // Actualizar el stock
                $nuevo_stock = $stock_cantidad + $stock_productos;
                $update_query = "UPDATE producto INNER JOIN listar_productos SET cantidad = producto.cantidad + listar_productos.listar_cantidad WHERE listar_productos.listar_id = $codigo";
                $cn->query($update_query);
                
                // Registrar la transacción de reposición
                $reposicion_query = "DELETE FROM `listar_productos` WHERE listar_id = '$codigo'";
                $cn->query($reposicion_query);
                
                // Confirmar la transacción
                $cn->commit();
                
                // echo "La reposición se realizó correctamente.";
                echo json_encode($cn);
                $cn->close();
            break;
            case "realizarVenta":
                // $codcliente = $_POST['codcliente'];

                $producto_id = $_POST['recibirCodigo'];
                $recibirNombre = $_POST['recibirNombre'];

                //BOTON PARA RESTAR EL PRECIO
                $cantidad = $_POST['restarPrecio'];
                //////////////////////////
                $recibirPrecio= $_POST['recibirPrecio'];
                // $recibirFecharegistro = $_POST['recibirFecharegistro'];
                $recibirCategoria = $_POST['recibirCategoria'];
                $recibirEstado = $_POST['recibirEstado'];
                $recibircliente = $_POST['recibircliente'];

                // Iniciar la transacción
                $cn->begin_transaction();
                
                // Obtener el nombre del producto
                $nombre_query = "SELECT * FROM producto WHERE codigo = $producto_id";
                $nombre_result = $cn->query($nombre_query);
                $nombre_row = $nombre_result->fetch_assoc();
                $nombre_producto = $nombre_row['nombre'];
                
                // Obtener el stock actual del producto
                $stock_query = "SELECT * FROM producto WHERE codigo = $producto_id";
                $stock_result = $cn->query($stock_query);
                $stock_row = $stock_result->fetch_assoc();
                $stock_actual = $stock_row['cantidad'];
                
                // Verificar si hay suficiente stock para la venta
                if ($stock_actual >= $cantidad) {
                    // Actualizar el stock
                    $nuevo_stock = $stock_actual - $cantidad;
                    $update_query = "UPDATE producto SET cantidad = $nuevo_stock WHERE codigo = $producto_id";
                    $cn->query($update_query);
                    // Confirmar la transacción
                    $venta_query = "INSERT INTO listar_productos(listar_nombre, listar_cantidad, listar_precio,listar_categoria,listar_estado,fk_productos,fk_codcliente) VALUES ('$nombre_producto',$cantidad,$recibirPrecio,'$recibirCategoria','$recibirEstado',$producto_id,$recibircliente)";
                    $cn->query($venta_query);
                    // Confirmar la transacción
                    $cn->commit();
                    echo json_encode("La venta ah sido realizada correctamente");
                } else {
                    // Rollback si no hay suficiente stock
                    $cn->rollback();
                    echo json_encode("No hay suficiente sotck para realizar la venta");
                }
                // echo json_encode($conn);
                $cn->close();
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
            //////////////
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