<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagenes/red-mundial.ico">
    <title>Tecnología</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <script src="https://kit.fontawesome.com/2356e8f8d0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/productos.css">
    <!-- <link rel="stylesheet" href="css/modal.css"> -->
</head>

<body>
    <?php
    include "conex/conexion.php";
    include "navbar.php"; 
    $cn = Conectarse();
?>
    <div class="cont">
        
    <div style="display: flex; width:20%; justify-content:space-around; font-size:18px; position:fixed; bottom:0px; background:#130E49; color:white; padding:5px; border-radius:0px 5px 5px 0px;">
        <div style="font-weight:bold;">CANTIDAD DE REGISTROS: </div>
        <div id="resultBusqueda"> 9 </div>
    </div>
        <div class="contenedor__formulario" id="contenedor__formulario">
            <div class="div__formulario1">
                <div class="div__inputs1">
                    <input type="date" id="desde" placeholder="First name" aria-label="First name">
                    <input type="date" id="hasta" placeholder="Last name" aria-label="Last name">
                    <button style="font-weight:bold;" onclick="buscarFecha()">Buscar Fecha</button>
                </div>
            </div>
            <div class="div__formulario2">
                <div class="div__inputs2">
                    <input type="text" id="busqueda" class="busqueda" name="busqueda" placeholder="BUSCAR POR NOMBRE DE PRODUCTO"
                        required>
                    <select aria-label="Default select example" id="cod_categoria" onchange="listarCategoria()">
                        <option value="">BUSCAR POR CATEGORIA ...</option>
                        <?php 
                            $sql = "SELECT * FROM categoria";
                            $result = mysqli_query($cn, $sql);
                            while($lista = mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?php echo $lista["cod_categoria"]?>"><?php echo $lista["categoria"]?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <h4 class="titulo__botones">BOTONOS PARA INSERTAR, ELIMINAR, ACTUALIZAR (CRUD)</h4>
    <div class="" style="width:100%;">
        <div class="btn__crud">
            <div class="btn__crud-contenedor">
                <div class="btn__crud-todos">
                    <button class="btn btn-warning" onclick="insertarDatos()">INSERTAR</button>
                </div>
                <div id="botonActualizar" class="btn__crud-todos">
                    <input type="text" id="obtenerCodigo" style="display: none;">
                    <button class="btn btn-info" disabled style="width:100%; font-weight:bold;"
                        id="btn-actualizar">ACTUALIZAR</button>
                </div>
            </div>
            <div class="btn__crud-contenedor">
                <div id="botonEliminar" class="btn__crud-todos">
                    <button class="btn btn-danger" disabled style="width:100%; font-weight:bold;"
                        id="btn-eliminar">ELIMINAR</button>
                </div>
                <div class="btn__crud-todos">
                    <button class="btn btn-secondary" onclick="limpiardatos()">LIMPIAR</button>
                </div>
            </div>
        </div>
    </div>

    <div style="width:100%; margin:auto; overflow:scroll; max-height: 285px;" id="contenedor_ingresarDatos">
        <table class="table table-borderless table-hover" id="tabla-productos">
            <thead style="position: sticky;top: 0; color:#130E49; background:#467A9D; border-bottom:3px solid black;">
                <tr style="text-align:center;">
                    <th scope="col">#CODIGO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">F. REGISTRO</th>
                    <th scope="col">CATEGORIA</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col" colspan="2">VENTA</th>
                    <th scope="col"></th>
                </tr>
                <tr style="position:sticky; top: 30px; background:#93DFB7; border-bottom:3px solid black;">
                    <td>
                        <div class="col-auto">
                            <input type="input" disabled class="form-control" id="codpro" placeholder="codigo"
                                value="P000">
                        </div>
                    </td>
                    <td>
                        <div class="col-auto">
                            <input type="input" class="form-control" id="nombre" placeholder="Nombre*">
                        </div>
                    </td>
                    <td>
                        <div class="col-auto">
                            <input type="number" class="form-control" id="cantidad" placeholder="Cantidad*">
                        </div>
                    </td>
                    <td>
                        <div class="col-auto">
                            <input type="number" class="form-control" id="precio" placeholder="Precio*">
                        </div>
                    </td>
                    <td>
                        <div class="col-auto">
                            <input type="date" class="form-control" disabled id="fecharegistro"
                                placeholder="Fecha de registro*">
                        </div>
                    </td>
                    <td>
                        <div class="col-auto">
                            <select class="form-select" aria-label="Default select example" id="codcategoria">
                                <option value="">BUSCAR POR CATEGORIA ...</option>
                                <?php 
                                        $sql = "SELECT * FROM categoria";
                                        $result = mysqli_query($cn, $sql);
                                        while($lista = mysqli_fetch_assoc($result)){
                                    ?>
                                <option value="<?php echo $lista["cod_categoria"]?>">
                                    <?php echo $lista["categoria"]?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col-auto">
                            <select class="form-select" aria-label="Default select example" id="codestado">
                                <?php 
                                        $sql = "SELECT * FROM estado";
                                        $result = mysqli_query($cn, $sql);
                                        while($lista = mysqli_fetch_assoc($result)){
                                    ?>
                                <option value="<?php echo $lista["cod_estado"]?>"><?php echo $lista["estado"]?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td colspan="2" style="text-align: center; align-items:center;">TRANSA. VENTAS</td>
                    <td></td>
                    
                </tr>
                    <?php 
                        $sql = "SELECT * FROM cliente";
                        $result = mysqli_query($cn, $sql);
                        while($lista = mysqli_fetch_assoc($result)){
                    ?>
                    <input style="display:none;" type="text" id="fk_cliente" value="<?php echo $lista["cliente_codigo"] ?>">
    
                    <?php } ?>
                
            </thead>

            <tbody id="mostrarData" style="cursor: pointer;">
                <?php include "modal.php";  ?>
            </tbody>
        </table>
    </div>
    <script src="js/main.js"></script>

    <script>
        document.querySelector(".busqueda").addEventListener("keyup", ()=>{
        let busqueda = document.querySelector(".busqueda").value;
    
        data = new FormData();
        data.append("busqueda", busqueda);
        data.append("op", "countResultado");

        fetch("./consultas.php", {
            method: "POST",
            body: data,
        })
        .then((response) => response.json())
        .then((data) => {
            data.forEach((element) => {
                document.getElementById("resultBusqueda").innerHTML = element.RESULTADO;
            });        
        })
        .catch((err) => console.log(err));
        })
    </script>
</body>

</html>