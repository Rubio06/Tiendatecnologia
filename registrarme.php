<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
    <link rel="stylesheet" href="css/registrarme.css">
</head>

<body>
    <div style="width:70%; margin:auto;"><br>
        <h2 style="text-align:center;">Ingrese sus datos aqui</h2><br>
        <form class="row g-3 needs-validation" novalidate id="formulario">
            <div class="col-md-4">
                <label for="validationDefault01" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" required>
                <div class="valid-feedback">
                    Dato ingresado
                </div>
                <div class="invalid-feedback">
                    Espacio vacio, complete con datos
                </div>
                <div class="formato">

                </div>

            </div>
            <div class="col-md-4">
                <label for="validationDefault02" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" placeholder="Ingrese sus apellidos completos"
                    required>
                <div class="valid-feedback">
                    Dato ingresado
                </div>
                <div class="invalid-feedback">
                    Espacio vacio, complete con datos
                </div>
                <div class="formato1">

                </div>
            </div>
            <div class="col-md-4">
                <label for="validationDefaultUsername" class="form-label">Correo</label>
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                    <input type="text" class="form-control" id="correo" aria-describedby="inputGroupPrepend2"
                        placeholder="Ingrese su correo" required>
                    <div class="valid-feedback">
                        Dato ingresado
                    </div>
                    <div class="invalid-feedback">
                        Espacio vacio, complete con datos
                    </div>
                    <div class="formato2">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="validationDefault03" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" placeholder="Ingrese su usuario" required>
                <div class="valid-feedback">
                    Dato ingresado
                </div>
                <div class="invalid-feedback">
                    Espacio vacio, complete con datos
                </div>

                <div class="formato3">

                </div>
            </div>

            <div class="col-md-4">
                <label for="validationDefault03" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" placeholder="Ingrese su contraseña"
                    required>
                <div class="valid-feedback">
                    Dato ingresado
                </div>
                <div class="invalid-feedback">
                    Espacio vacio, complete con datos
                </div>
                <div class="formato4">

                </div>
            </div>
            <div class="col-md-4">
                <label for="validationDefault05" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" id="conficontrasena" placeholder="Repita su contraseña"
                    required>
                <div class="valid-feedback">
                    Dato ingresado
                </div>
                <div class="invalid-feedback">
                    Espacio vacio, complete con datos
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationDefault03" class="form-label">Imagen de persona</label>
                <input type="file" class="form-control" id="imagen" accept="img/" required
                    onchange="previewImage(event, '#imgPreview')"><br>
                <div style="border:2px solid black;height:200px;">
                    <div style="width:30%; margin:5px auto;">
                        <img style="width:100%; border-radius:10px;" id="imgPreview" width="140" style="padding: 10px;">
                    </div>
                </div>
                <div class="valid-feedback">
                    Dato ingresado
                </div>
                <div class="invalid-feedback">
                    Espacio vacio, complete con datos
                </div>
                <div  class="formato6">

                </div>
                <div  class="formato5">

                </div>
            </div>
            <div class="col-md-6">
                <label for="validationDefault03" class="form-label">Fecha de registro</label>
                <input type="date" class="form-control" id="fecha" required>
                <div class="valid-feedback">
                    Dato ingresado
                </div>
                <div class="invalid-feedback">
                    Espacio vacio, complete con datos
                </div>
                <div  class="formato5">

                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Registrarme</button>
            </div>
        </form>

    </div>
    <script src="js/main_login.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>