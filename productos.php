<?php 
    include "conex/conexion.php";
    $cn = Conectarse();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecnología</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2356e8f8d0.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->
    <link rel="icon" href="imagenes/red-mundial.ico">
</head>

<body>
    <div class="conteiner">
        <?php 
            include "navbar.php";
        ?>
        <div style="width: 80%; margin:auto;">
            <div style="width: 60%; margin:auto;">
                <div class="row g-3">
                    <div class="col">
                        <input type="date" class="form-control" id="desde" placeholder="First name"
                            aria-label="First name">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" id="hasta" placeholder="Last name"
                            aria-label="Last name">
                    </div>
                    <div class="col">
                        <button class="btn btn-success" style="font-weight:bold;" onclick="buscarFecha()">Buscar
                            Fecha</button>
                    </div>
                </div>
            </div><br>
            <div style="width: 80%; margin:auto;">
                <div class="row g-3">
                    <div class="col">
                        <!-- <label for="validationCustom02" class="form-label">BUSCAR POR NOMBRE DE PRODUCTO</label> -->
                        <input type="text" class="form-control" id="busqueda" name="busqueda"
                            placeholder="BUSCAR POR NOMBRE DE PRODUCTO" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col">
                        <!-- <label for="validationCustom02" class="form-label">BUSCAR POR CATEGORIA</label> -->
                        <select class="form-select" aria-label="Default select example" id="cod_categoria"
                            onchange="listarCategoria()">
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
        </div><br>
        <div class="">
            <h4 style="text-align: center; background:#DAF0D8">BOTONOS PARA INSERTAR, ELIMINAR, ACTUALIZAR (CRUD)</h4>
            <br>
            <div style="display: flex; width:100%;">
                <div style="width: 20%; margin:auto;">
                    <button class="btn btn-warning" style="width:100%; font-weight:bold;"
                        onclick="insertarDatos()">INSERTAR</button>
                </div>
                <div id="botonActualizar" style="width: 20%; margin:auto;">
                </div>
                <div id="botonEliminar" style="width: 20%; margin:auto;">
                </div>
                <div style="width: 20%; margin:auto;">
                    <button class="btn btn-secondary" style="width:100%; font-weight:bold;"
                        onclick="limpiardatos()">LIMPIAR</button>
                </div>
            </div>
        </div><br>
        <div style="width:100%; margin:auto; overflow:scroll; max-height: 285px;">
            <table class="table table-borderless table-hover">
                <thead
                    style="position: sticky;top: 0; color:#130E49; background:#467A9D; border-bottom:3px solid black;">
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
                                <input type="date" class="form-control" id="fecharegistro"
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
                </thead>
                <tbody id="mostrarData" style="cursor: pointer;">
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>