<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagenes/red-mundial.ico">
    <link rel="stylesheet" href="./css/venta_producto.css">
    <title>Tecnologia</title>
    <script src="https://kit.fontawesome.com/2356e8f8d0.js" crossorigin="anonymous"></script>
</head>

<body style="background:#F2F5F2;">
    <?php 
        include "./conex/conexion.php";
        $cn = Conectarse(); 
        include "navbar.php"; 
        include "./modal_ventaProducto.php";
    ?>
    <div class="contenedor">
        <div style="display: flex; justify-content:space-between; align-items:center;">
            <div class="reloj-general">
                <div class="wiget">
                    <div class="fecha">
                        <p id="diaSemana" class="diaSemana">Juevez</p>
                        <p id="dia" class="dia">29</p>
                        <p>de </p>
                        <p id="mes" class="mes">Octubre</p>
                        <p>del </p>
                        <p id="year" class="year">2023</p>
                    </div>
                    <div class="reloj">
                        <p id="horas" class="horas">11</p>
                        <p>:</p>
                        <p id="minutos" class="minutos">39</p>
                        <p>:</p>
                        <p id="segundos" class="segundos">34</p>
                        <p id="ampm" class="ampm">AM</p>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin: 0px 25px 25px 30px; display:flex; justify-content:space-around; align-items:center;">
            <div style="width:60%; padding-top:20px; padding-bottom: 25px; background:#F9F6F3;">
                <h4><b>Registro de clientes</b></h4><br>
                <div style="display: flex; justify-content:space-between; width:90%; margin:auto;">
                    <div>
                        <label for="">NOMBRE*</label><br>
                        <input type="text" name="cliente_nombre" id="cliente_nombre" style="width: 220px;">
                    </div>
                    <div>
                        <label for="">APELLIDOS*</label><br>
                        <input type="text" name="cliente_apellido" name="cliente_apellido" style="width: 220px;">
                    </div>
                    <div>
                        <label for="">SEXO DEL CLIENTE</label><br>
                        <select name="cliente_sexo" id="cliente_sexo" style="width: 220px; padding:3px;">
                            <option value="">MASCULINO</option>
                            <option value="">FEMENINO</option>
                        </select>
                    </div>
                </div>
                <div style="width:77%; margin:auto; display:flex; justify-content:space-between;">
                    <div>
                        <label for="">CORREO*</label><br>
                        <input type="text" style="width: 300px;">
                    </div>
                    <div>
                        <label for="">TELEFONO*</label><br>
                        <input type="text" style="width: 220px;">
                    </div>
                    <div style="display:flex; align-items:end;">
                        <!-- <button title="BUSCAR CLIENTE" type="button" class="btn__buscar-cliente" data-bs-toggle="modal-dialog modal-dialog-centered" data-bs-target="#staticBackdrop">....</button> -->
                        <button title="BUSCAR CLIENTE" type="button" class="btn__buscar-cliente" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            ....
                        </button>
                    </div>
                </div><br>
                <div style="margin: auto; width: 60%; display:flex; justify-content:space-between;">
                    <button class="btn__guardar-cliente"><b>GUARDAR CLIENTE</b></button>
                    <button class="btn__buscar-pedido"><b>BUSCAR PEDIDO</b></button>
                </div>
            </div>
            <div style="width: 40%;">
                <div style="width:50%; margin:auto;" id="caja">
                    <!-- <img style="width:100%;" src="./imagenes/imagen-izquierda.png" alt=""> -->
                </div>
            </div>
        </div>
        <div style="width: 98%; margin:auto;">
            <h5><b>CARRITO DE COMPRAS</b></h5>
            <table class="table table-borderless table-hover tabla1" style="z-index: 10;">
                <thead>
                    <tr style="text-align:center;">
                        <th scope="col" style="border: 1px solid #467A9D;">#CODIGO</th>
                        <th scope="col" style="border: 1px solid #467A9D;">NOMBRE</th>
                        <th scope="col" style="border: 1px solid #467A9D;">CANTIDAD</th>
                        <th scope="col" style="border: 1px solid #467A9D;">CATEGORIA</th>
                        <th scope="col" style="border: 1px solid #467A9D;">PRECIO UNITARIO</th>
                        <th scope="col" style="border: 1px solid #467A9D;">FECHA REGISTRO</th>
                        <th scope="col" style="border: 1px solid #467A9D;">PRECIO CANTIDAD</th>
                    </tr>
                </thead>
                <tbody id="mostrarVentaProducto" class="tablabody">
                    <?php
                        $sql = "SELECT * FROM listar_productos";
                        $result = mysqli_query($cn, $sql);
                        while($lista = mysqli_fetch_assoc($result)){
                        ?>
                    <tr>
                        <td style="text-align: center;"><b id="texto"><?php echo "CR00" .$lista["listar_id"] ?></b></td>
                        <td>
                            <button style="border: none; margin:0px 10px 0px 10px"
                                onclick="reponerStock('<?php echo $lista['listar_id']; ?>')"><i
                                    class="fa-sharp fa-solid fa-xmark"></i></button>
                            <?php echo $lista["listar_nombre"];?>
                        </td>
                        <td><input id="mandarLista" style="width:50px; text-align:center;" type="number"
                                value="<?php echo $lista["listar_cantidad"]; ?>"></td>
                        <td><?php echo $lista["listar_categoria"]; ?></td>
                        <td><?php echo "S/. " . $lista["listar_precio"]; ?></td>
                        <td><?php echo $lista["fecha_registro"] ?></td>
                        <td><?php echo "S/. " .  $lista["listar_cantidad"] * $lista["listar_precio"]; ?></td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
            <div style="display: flex; width:100%; justify-content:space-between;">
                <div>
                    <div style="width: 90%; margin:auto;">
                        <label for="" style="font-size: 20px;"><b>COMENTARIOS*</b></label>
                        <textarea style="resize:none;" name="" id="" cols="70" rows="3"></textarea><br>
                        <button
                            style="border:none; padding:8px; color:white; border-radius:5px; background:#3498DB;"><b>Enviar
                                comentario</b></button>
                    </div>
                    <div style="width:25%; margin:20px auto;">
                        <button onclick='guardarVenta()' style="border:none; padding:20px; border-radius:10px;"
                            title="IMPRIMIR DOCUMENTO DE PAGO"><img style="width:100%;" src="./imagenes/imprimir.png"
                                alt=""></button>
                    </div>
                </div>
                <div style="width: 50%; float:right; background: #F9FAF2; margin:10px;">
                    <div style="font-size:18px; font-weight:bold; padding:20px; margin:10px;">
                        <div style="display: flex; justify-content:space-between; margin:10px; align-items:center;">
                            <label for="">TIPO DE DOCUMENTO:</label>
                            <select name="" id="" style="width: 190px; font-size:16px">
                                <option value="">BOLETA</option>
                                <option value="">FACTURA</option>
                                <option value="">RC</option>
                            </select>
                        </div>
                        <div style="display: flex; justify-content:space-between; margin:10px; align-items:center;">
                            <label for="">TIPO DE PAGO:</label>
                            <select name="" id="" style="width: 190px; font-size:16px">
                                <option value="">EFECTIVO</option>
                                <option value="">TARJETA</option>
                                <option value="">YAPE</option>
                                <option value="">IZIPAY</option>
                            </select>
                        </div>
                        <div style="display: flex; justify-content:space-between; margin:15px; align-items:center;">
                            <label for="">SUBTOTAL: </label>
                            <?php 
                            $sql = "SELECT SUM(ROUND(listar_precio*listar_cantidad,2)) AS 'PRECIO' FROM listar_productos;";
                            $exec = mysqli_query($cn,$sql);
                            while($lista = mysqli_fetch_assoc($exec)){
                                echo "S/. " . $lista["PRECIO"]; 
                            } ?>
                        </div>
                        <div style="display: flex; justify-content:space-between; margin:15px;">
                            <label>DESCUENTO:</label>
                            <label>S/. 0.00</label>
                        </div>
                        <div style="display: flex; justify-content:space-between; margin:15px;">
                            <label style="color:#C0392B;">IMPUESTO:</label>
                            <?php 
                            $sql = "SELECT SUM(ROUND(listar_precio*listar_cantidad*0.18,2)) AS 'IMPUESTO' FROM listar_productos;";
                            $exec = mysqli_query($cn,$sql); 
                            while($lista = mysqli_fetch_assoc($exec)){
                                echo "S/. " . $lista["IMPUESTO"]; 
                            } 
                        ?>
                        </div>
                        <div
                            style="display: flex; justify-content:space-between; float:right; margin:15px; width:93%; align-items:center;">
                            <button
                                style="border:none; font-size:15px; color:white; font-weight:bold; background:#27AE60; padding:5px"
                                onclick="mostrarToPagar()">VERTOTAL A PAGAR</button>
                            <label>TOTAL A PAGAR: </label>
                            <?php 
                            $sql = "SELECT SUM(ROUND((listar_precio * listar_cantidad) + (listar_precio * listar_cantidad) * 0.18,2)) AS 'SUMA_PRECIO' FROM listar_productos;";
                            $exec = mysqli_query($cn,$sql);
                            while($lista = mysqli_fetch_assoc($exec)){
                                ?>
                            <input type="text"
                                style="font-weight:500; width:160px; font-style:italic; text-align:right;"
                                id="montoTotal" value="<?php echo $lista["SUMA_PRECIO"]; ?>" />

                            <input type="text" style="display:none;" id="pagoCliente"
                                value="<?php echo $lista["SUMA_PRECIO"]; ?>">
                            <?php
                         } 
                        ?>
                        </div>
                        <div>
                            <div
                                style="display: flex; justify-content:space-between; margin:15px; width:95%; align-items:center;">
                                <div style="width:43%;"></div>
                                <label style="color:#27AE60;">VUELTO: </label>
                                <input type="text" id="clienteVuelto" disabled value="S./ 00.00"
                                    style="font-weight: 500; width:180px; font-style:italic; text-align:right;">
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    const caja = document.getElementById("caja");
    const camibioColor = document.getElementById("camibioColor");

    const imagenes = ["imglogo1", "imglogo2", "imglogo3", "imglogo4"];

    setInterval(() => {
        let indice = parseInt(Math.random() * imagenes.length);
        caja.innerHTML = `<img style='width:100%;' src='./imagenes/${imagenes[indice]}.png'>`;
    }, 800)

    /// CALCULAR EL VUELTO DEL CLIENTE
    const montoTotal = document.getElementById("montoTotal");
    montoTotal.addEventListener("keyup", () => {
        const montoTotal = document.getElementById("montoTotal").value;
        const pagoCliente = document.getElementById("pagoCliente").value;

        if (pagoCliente <= 0 || montoTotal <= 0) {
            document.getElementById("clienteVuelto").value = "S./ 00.00";
        } else {
            vueltoTotal = montoTotal - pagoCliente;
            document.getElementById("clienteVuelto").value = "S/. " + vueltoTotal.toFixed(2);
        }
    });

    //// RECARGAR EL TOTAL A PAGAR
    function mostrarToPagar() {
        const montoTotal = document.getElementById("montoTotal").value;
        location.reload(montoTotal);
    }

    //// REPOSICION DE STOCK
    function reponerStock(codigo) {
        data = new FormData();
        data.append("codigo", codigo);
        data.append("op", "reponerStock");
        fetch("./consultas.php", {
                method: "POST",
                body: data
            })
            .then((response) => response.json())
            .then((datos) => {
                alert("La reposición se realizó correctamente");
                location.reload();
            })
            .catch((error) => console.log(error))
    };
    //LOGICA DE RELOJ
    const actualizarHora = () => {
        let fecha = new Date();
        let horas = fecha.getHours();
        let ampm;
        let minutos = fecha.getMinutes();
        let segundos = fecha.getSeconds();
        let diaSemana = fecha.getDay();
        let dia = fecha.getDate();
        let mes = fecha.getMonth();
        let year = fecha.getFullYear();

        let pHoras = document.getElementById("horas");
        let pAMPM = document.getElementById("ampm");
        let pMinutos = document.getElementById("minutos");
        let pSegundos = document.getElementById("segundos");
        let pDiaSemana = document.getElementById("diaSemana");
        let pDia = document.getElementById("dia");
        let pMes = document.getElementById("mes");
        let pYear = document.getElementById("year");

        let semana = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Vieres", "Sabado"];
        pDiaSemana.innerHTML = semana[diaSemana];
        pDia.innerHTML = dia;
        let meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
            "Octubre", "Noviembre", "Diciembre"
        ];
        pMes.innerHTML = meses[mes];
        pYear.innerHTML = year;
        if (horas >= 12) {
            horas = horas - 12;
            ampm = "PM";
        } else {
            ampm = "AM";
        }
        if (horas == 0) {
            horas = 12;
        }
        if (horas < 10) {
            horas = "0" + horas;
        }
        pHoras.innerHTML = horas;
        pAMPM.innerHTML = ampm;
        if (minutos < 10) {
            minutos = "0" + minutos;
        }
        pMinutos.innerHTML = minutos;
        if (segundos < 10) {
            segundos = "0" + segundos;
        }
        pSegundos.innerHTML = segundos;
    }

    setInterval(actualizarHora, () => {
        actualizarHora();
    }, 1000);

    function guardarVenta() {
        // const datos = {
        //     nombre: xd.nombre,
        // }
        let codigo = document.getElementById("codigo").value;
        console.log(codigo);
    }
    </script>
</body>

</html>