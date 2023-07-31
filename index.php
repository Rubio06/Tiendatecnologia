<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2356e8f8d0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="imagenes/red-mundial.ico">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Tecnología</title>
</head>

<body class="bg-dark">
    <section>
        <div class="row g-0">
            <div class="col-lg-7 d-none d-lg-block" style="width: 66%;">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" style="opacity: 0.5;">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./imagenes/carrusel1.jpg" class="d-block w-100" alt="..." style="height:100vh;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>First slide label</h5>
                                <p>Some representative placeholder content for the first slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./imagenes/carrusel2.jpg" class="d-block w-100" alt="..." style="height:100vh;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Second slide label</h5>
                                <p>Some representative placeholder content for the second slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./imagenes/carrusel3.jpg" class="d-block w-100" alt="..." style="height:100vh;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Third slide label</h5>
                                <p>Some representative placeholder content for the third slide.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-lg-5 d-flex flex-column align-items-end min-vh-100" style="width: 34%;">
                <div class="px-lg-5 pt-lg-4 pd-lg-3 p-4 w-100">
                    <!-- <img src="./imagenes/dell-1.svg" alt="" style="height:30px;"> -->
                </div>
                <div>
                    <div class="px-lg-5 py-lg-4 p4 w-100 align-self-center login-cont">
                        <h1 class="mb-4" style="font-weight: bold;">Bienvenido de Vuelta</h1>
                        <div class="mb-5" id="miFormulario">
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label black font-weight-bold">Usuario</label>
                                <input type="text" class="form-control black border-0" id="usuario"
                                    aria-describedby="emailHelp" pattern="/^[a-zA-Z0-9_-]{3,16}$/" placeholder="Ingresa tu usuario">
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label font-weight-bold">Contraseña</label>
                                <input type="password" class="form-control black border-0 mb-2" id="contrasena"
                                    placeholder="Ingresa tu contraseña" pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/">
                                <a href="#" id="emailHelp" class="form-text text-muted text-decoration-none">¿Has olvidado
                                    tu contraseña?</a>
                            </div>
                            <button class="btn btn-primary w-100" onclick="logearse()">Iniciar sessión</button>
                        </div>
                        <p style="font-weight: bold;" class="text-center">O inicia sessión con</p>
    
                        <div style="display: flex; width:100%; justify-content:space-between">
                            <div style="width: 48%;">
                                <button style="width: 100%;" class="btn btn-outline-light"><i
                                        class="fa-brands fa-google lead mr-2 "></i> google</button>
                            </div>
                            <div style="width: 48%;">
                                <button style="width: 100%;" class="btn btn-outline-light"><i
                                        class="fa-brands fa-facebook-f lead mr-2"></i> facebook</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center px-lg-5 pt-lg-3 pb-lg-4 p4 w-100 mt-auto pie">
                        <p class="d-inline-block mb-0">¿Todavia no tienes una cuenta?</p> <a href="registrarme.php"
                            class="text-light font-weight-bold text-decoration-none">Crea una ahora</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="cont-letrero">
        <div id="letrero" class="desaparecer">
            <div id="content"></div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script src="js/main_login.js"></script>
</body>

</html>