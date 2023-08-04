<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .tabla-body {
        margin: auto;
        width: 100%;
    }

    .th-encabezados {
        background: #33393f;
        color: white;
    }

    .th-encabezados,
    .td-datos {
        border: 2px solid black;
        font-size: 13px;
        padding: 3px;
        text-align: center;
    }

    .tabla-body tr:hover {
    background: rgb(160, 222, 225);
    }

    </style>
</head>

<body>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background: #F2F5F2;">
                <div class="modal-header" style="background: #A3E4D7;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Agregar cliente</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-6 mb-3">
                        <label for="campo" class="visually"><b>BUSCAR USUARIO</b></label>
                        <input type="text" class="form-control" id="campo"
                            placeholder="Nombre o apellido *">
                    </div>
                    <table class="tabla-body">
                        <thead>
                            <th class="th-encabezados">CODIGO</th>
                            <th class="th-encabezados">NOMBRE</th>
                            <th class="th-encabezados">APELLIDO</th>
                            <th class="th-encabezados">SEXO</th>
                            <th class="th-encabezados">CORREO</th>
                            <th class="th-encabezados">TELEFONO</th>
                        </thead>
                        <tbody id="content">
                            <!-- <?php 
                                // $sql = "SELECT * FROM cliente";
                                // $exec = mysqli_query($cn, $sql);
                                // while ($lista = mysqli_fetch_assoc($exec)) {
                                    ?>
                            <tr onclick="idCliente('<?php //echo $lista['cliente_codigo']?>')">
                                <td class="td-datos"><b><?php //echo $lista["codcliente"] . $lista["cliente_codigo"]?></b></td>
                                <td class="td-datos"><?php //echo $lista["cliente_nombre"]?></td>
                                <td class="td-datos"><?php //echo $lista["cliente_apellido"]?></td>
                                <td class="td-datos"><?php //echo $lista["cliente_sexo"]?></td>
                                <td class="td-datos"><?php //echo $lista["cliente_correo"]?></td>
                                <td class="td-datos"><?php //echo $lista["cliente_telefono"]?></td>
                            </tr>
                            <?php //} ?> -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div style="display: flex; justify-content:space-between; width:55%; margin:auto;">
                        <button class="" style="border:none; border-radius:10px; padding:7px; width:45%; background:#D98880;" type="button" data-bs-dismiss="modal"><b>Cerrar</b></button>
                        <button class="" style="border:none; padding:7px; border-radius:10px; width:45%; background:#F9E79F;" id="codigo" onclick="obtenerId()" type="button" data-bs-dismiss="modal"><b>Seleccionar cliente</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function obtenerId() {
            const codigo = document.getElementById("codigo").value;

            data = new FormData();
            data.append("codigo", codigo);
            data.append("op", "mostrarClientes");
            fetch("./consultas.php", {
                method: "POST",
                body: data,
            })
            .then((response) => response.json())
            .then((data) => {
                data.forEach((element) => {
                    document.getElementById("cliente_nombre").value = element.cliente_nombre;
                    document.getElementById("cliente_apellido").value = element.cliente_apellido;
                    document.getElementById("cliente_sexo").value = element.cliente_sexo;
                    // console.log(sexo);
                    document.getElementById("cliente_correo").value = element.cliente_correo;
                    document.getElementById("cliente_telefono").value = element.cliente_telefono;
                    // setTimeout(()=>{
                    //     document.getElementById("campo").value = "";
                    // },1000)
                });
                document.getElementById("campo").value = "";
            })
            .catch((err) => console.log(err));
        }
        function idCliente(codigo) {
            document.getElementById("codigo").value = codigo;
        }

        getData();
        document.getElementById("campo").addEventListener('keyup', ()=>{
            getData();
        });

        function getData(){
            let campo = document.getElementById("campo").value;
            let content = document.getElementById("content");
            let url = './consultas.php';

            let formData = new FormData();
            formData.append('campo',campo);
            formData.append('op','busquedaClientes');

            fetch(url, {
                method: "POST",
                body: formData
            })
            .then((response)=> response.json())
            .then((data)=> {
                content.innerHTML = data;
            })
            .catch((error)=> console.log(error));
        }

    </script>
</body>

</html>