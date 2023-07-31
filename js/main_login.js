// function para logearse
function logearse() {
 
    let usuario = document.getElementById('usuario').value;
    let contrasena = document.getElementById('contrasena').value;

    if (usuario === "" || contrasena === "") {
        toogleDes()
        content.innerHTML = "<h1 class='blanco'>Debe de completar los espacios en blanco</h1>"
    } else {

        data = new FormData();
        data.append('usuario', usuario)
        data.append('contrasena', contrasena)
        data.append('op', 'logearse')
        fetch('./consultas.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data === 1) {
                toogleDes()
                content.innerHTML =
                    "<h1 class='ingreso'>Ingreso correctamente, Bienvenido</h1>"
                setTimeout(() => {
                    location.href = 'productos.php'
                }, 6000)
            } else {
                toogleDes()
                content.innerHTML =
                    "<h1 class='invalido'>Error !! Usuario o contraseña invalida</h1>"
            }
        }).catch(err => console.log(err))
    
    }
}
// LETRERO VALIDACION
function toogleDes() {
    let letrero = document.getElementById('letrero')
    letrero.classList.add('aparecer')
    letrero.style.animation = 'aparecer 2s forwards'
    setTimeout(() => {
        letrero.classList.remove('aparecer')
        letrero.style.animation = 'desaparecer 2s forwards'
        letrero.classList.add('desaparecer')
    }, 3700)
}

    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()
//REGISTRAME 

var formulario = document.getElementById('formulario')
formulario.addEventListener('submit', function(event) {
    event.preventDefault(event);

    const usernameRegex = /^[a-zA-Z0-9_-]{3,10}$/;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    const apellidoRegex = /^[a-zA-Z\s]+$/;
    const nombreRegex = /^[a-zA-Z\s]+$/;
    const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const fechaRegex = /^\d{4}-\d{2}-\d{2}$/;
    const imagenRegex = /\.(jpg|jpeg|png|gif)$/i;

    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let correo = document.getElementById("correo").value;
    let usuario = document.getElementById("usuario").value;
    let contrasena = document.getElementById("contrasena").value;
    let conficontrasena = document.getElementById("conficontrasena").value;
    let fecha = document.getElementById("fecha").value;
    let imagen = document.getElementById("imagen").files[0];

    
    if (!nombreRegex.test(nombre)) {
        document.querySelector(".formato").innerHTML = "Formato incorrecto de nombre";
        setTimeout(() => {
            document.querySelector(".formato").innerHTML = "";
        }, 2000);
        return false;
    }
    if (!apellidoRegex.test(apellido)) {
        document.querySelector(".formato1").innerHTML = "Formato incorrecto de apellido";
        setTimeout(() => {
            document.querySelector(".formato1").innerHTML = "";
        }, 2000);
        return false;
    }
    if (!correoRegex.test(correo)) {
        document.querySelector(".formato2").innerHTML = "Formato incorrecto para correo";
        setTimeout(() => {
            document.querySelector(".formato2").innerHTML = "";
        }, 2000);
        return false;
    }
    if (!usernameRegex.test(usuario)) {

        document.querySelector(".formato3").innerHTML = "El nombre de usuario no es válido. Debe contener entre 3 y 10 caracteres y solo puede contener letras, números, guiones bajos (_) y guiones (-).";
        setTimeout(() => {
            document.querySelector(".formato3").innerHTML = "";
        }, 2000);
        return false;
    }
    // Validar la contraseña
    if (!passwordRegex.test(contrasena)) {
        document.querySelector(".formato4").innerHTML = "La contraseña no es válida. Debe contener al menos 8 caracteres, incluyendo al menos una letra minúscula, una letra mayúscula, un número y un carácter especial (@, $, !, %, *, ?, &).";
        setTimeout(() => {
            document.querySelector(".formato4").innerHTML = "";
        }, 2000);
        return false;
    }
    if (!fechaRegex.test(fecha)) {
        document.querySelector(".formato5").innerHTML = "Formato incorrecto para fecha";
        setTimeout(() => {
            document.querySelector(".formato5").innerHTML = "";
        }, 2000);
        return false;
    }
    if (imagenRegex.test(imagen)) {
        document.querySelector(".formato6").innerHTML = "Formato incorrecto para imagen";
        setTimeout(() => {
            document.querySelector(".formato6").innerHTML = "";
        }, 2000);
        return false;

    }else{
        data = new FormData();
        data.append("nombre",nombre);
        data.append("apellido",apellido);
        data.append("correo",correo);
        data.append("usuario",usuario);
        data.append("contrasena",contrasena);
        data.append("conficontrasena",conficontrasena);
        data.append("fecha",fecha);
        data.append("imagen",imagen);
        data.append("op","registrarme");
    
        fetch("./consultas.php",{
            method: "POST",
            body: data
        })
        .then(response => response.json())
        .then(data=>{
            if (data > 0) {
                location.href = "index.php";
            } else {
                alert(data);                
            }
        }).catch(erro => console.log(erro));
    }
});

function previewImage(event, querySelector){
	//Recuperamos el input que desencadeno la acción
	const input = event.target;
    console.log(input);
	//Recuperamos la etiqueta img donde cargaremos la imagen
	$imgPreview = document.querySelector(querySelector);
	// Verificamos si existe una imagen seleccionada
	if(!input.files.length) return
	//Recuperamos el archivo subido
	file = input.files[0];
	//Creamos la url
	objectURL = URL.createObjectURL(file);
	//Modificamos el atributo src de la etiqueta img
	$imgPreview.src = objectURL;     
}
//VALID
// function registrameOn() {
    
// }