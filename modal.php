<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modal</title>
    <style>
        .modal__header{
            background:#A3E4D7;
        }
        .modal__body{
            display: flex; justify-content:space-around; width:100%; border-bottom:1px solid #cccc; margin-bottom:15px;
        }
        .modal__body input{
            width:20%;
        }
        .grupo__inputs{
            width: 95%;
            margin: auto;
        }
        .inputs__recibir-datos{

            display: none;
        }
        .eti__nombre-producto{
            display: flex; align-items:center; justify-content:space-between; margin-bottom:10px;
        }
        .btn__modal-footer{
            display: flex; justify-content:space-between; width:85%; margin:20px auto;
        }
        .btn__modal-footer{
            display: flex; justify-content:space-between; width:85%; margin:20px auto;
        }
        .btn__modal-footer .btn__cerrar{
            width:40%; background:#D98880; padding:4px; border:none; border-radius:5px;
        }
        .btn__modal-footer .btn__vender-producto{
            width:40%; background:#F9E79F; padding:4px; border:none; border-radius:5px;
        }
    </style>
</head>

<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal__header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>VENDER CANTIDAD DE PRODUCTOS</b></h5>
                    <button type="button" class="btn-close white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal__body">
                    <label for="restarPrecio"><b>Cantidad de productos a vender</b></label>
                    <input type="number" id="restarPrecio">
                </div>
                <div class="grupo__inputs">
                    <input class="inputs__recibir-datos" type="text" id="recibirCodigo">
                    <div class="eti__nombre-producto">
                        <label style="width:35%;" for="recibirNombre"><b>NOM. PRODUCTO: </b></label>
                        <input style="width:65%; font-weight:700;" disabled type="text" id="recibirNombre">
                    </div>
                    <div class="eti__nombre-producto">
                        <label for="recibirPrecio" style="width:35%;"><b>PRECIO: </b></label>
                        <input  type="text" style="width:65%; font-weight:700;" disabled id="recibirPrecio">
                    </div>
                    <input class="inputs__recibir-datos" type="text" id="recibirFecharegistro">
                    <input class="inputs__recibir-datos" type="text" id="recibirCategoria">
                    <input class="inputs__recibir-datos" type="text" id="recibirEstado">
                    <input class="inputs__recibir-datos" type="text" id="recibircliente">
                </div>
                <div class="modal-footer btn__modal-footer">
                    <button class="btn__cerrar" type="button" data-bs-dismiss="modal"><b>Cerrar</b></button>
                    <button class="btn__vender-producto" type="button" onclick="venderStock()"><b>Vender producto</b></button>
                </div>
                <div id="recibirID"></div>
            </div>
        </div>
    </div>
</body>
</html>