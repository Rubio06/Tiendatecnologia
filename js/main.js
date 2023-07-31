let tabla = document.getElementById("mostrarData");

data = new FormData();
data.append("op", "mostrarDatos");

fetch("./consultas.php", {
    method: "POST",
    body: data,
})
.then((response) => response.json())
.then((data) => {
    data.forEach((element) => {
        tabla.innerHTML += `
    <tr onclick="deleteActualizar('${element.codigo}')" ondblclick="darClick('${element.codigo}')">
        <td scope="row" style='background:#B9F3B3; font-weight: bold;'>${element.codpro}${element.codigo}</td>
        <td>${element.nombre}</td>
        <td style='text-align:center;'>${element.cantidad}</td>
        <td style='text-align:center;'>S/. ${element.precio}</td>
        <td style='text-align:center;'>${element.fecha_registro}</td>
        <td style='text-align:center;'>${element.CATEGORIA}</td>
        <td style='text-align:center;'>${element.ESTADO}</td>
        <td style='text-align:center;'><button onclick="mandarId('${element.codigo}','${element.nombre}','${element.precio}','${element.CATEGORIA}','${element.ESTADO}','${element.CODCLIENTE}')" style='border:none; font-size:25px;' data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-cart-shopping"></i></button></td>
    </tr>
        `;
    });
})
.catch((err) => console.log(err));

//INPUT PARA BUSCAR EN TIEMPO REAL
document.getElementById("busqueda").addEventListener("keyup", () => {
    let busqueda = document.getElementById("busqueda").value;

    data = new FormData();
    data.append("busqueda", busqueda);
    data.append("op", "buscar");

    fetch("./consultas.php", {
        method: "POST",
        body: data,
    })
    .then((response) => response.json())
    .then((data) => {
        document.getElementById("mostrarData").innerHTML = data;
        document.getElementById("busqueda").style.background = "#71F69B";
        setTimeout(()=>{
            document.getElementById("busqueda").style.background = "";

        },3000);

    })
    .catch((err) => console.log(err));
});

//RESULTADO TABLA

//BUSCAR FECHA DESDE HASTA
function buscarFecha() {
    let desde = document.getElementById("desde").value;
    let hasta = document.getElementById("hasta").value;

    data = new FormData();
    data.append("desde", desde);
    data.append("hasta", hasta);
    data.append("op", "buscarFecha");

    fetch("./consultas.php", {
        method: "POST",
        body: data,
    })
    .then((response) => response.json())
    .then((data) => {
        document.getElementById("mostrarData").innerHTML = data;
    })
    .catch((err) => console.log(err));
}
//MOSTRAR CATEGORIA EN EL SELECT
function listarCategoria() {
    let categoria = document.getElementById("cod_categoria").value;

    data = new FormData();
    data.append("categoria", categoria);
    data.append("op", "buscarCategoria");

    fetch("./consultas.php", {
        method: "POST",
        body: data,
    })
    .then((response) => response.json())
    .then((data) => {
        document.getElementById("mostrarData").innerHTML = data;
    })
    .catch((err) => console.log(err));
}
//INSERTAR DATOS
function insertarDatos() {
    const ingresarDatos = document.getElementById("contenedor_ingresarDatos");
    datos = {
        codpro: ingresarDatos.codpro,
        nombre: ingresarDatos.nombre,
        cantidad: ingresarDatos.cantidad,
        precio: ingresarDatos.precio,
        codcategoria: ingresarDatos.codcategoria,
        codestado: ingresarDatos.codestado,
        // fk_cliente: ingresarDatos.fk_cliente
    }
    // console.log(fk_cliente.value)
    const fk_cliente = document.getElementById("fk_cliente").value;
    data = new FormData();
    data.append("codpro", codpro.value);
    data.append("nombre", nombre.value);
    data.append("cantidad", cantidad.value);
    data.append("precio", precio.value);
    data.append("codcategoria", codcategoria.value);
    data.append("codestado", codestado.value);
    data.append("fk_cliente", fk_cliente);
    data.append("op", "insertarDatos");

    fetch("./consultas.php", {
        method: "POST",
        body: data,
    })
    .then((response) => response.json())
    .then((data) => {
        // ingresarDatos.nombre.style.background = "green";
        document.getElementById("codpro").style.background = "#71F69B";
        document.getElementById("nombre").style.background = "#71F69B";
        document.getElementById("cantidad").style.background = "#71F69B";
        document.getElementById("precio").style.background = "#71F69B";
        document.getElementById("codcategoria").style.background = "#71F69B";
        document.getElementById("codestado").style.background = "#71F69B";

        setTimeout(()=>{
            document.getElementById("codpro").style.background = "";
            document.getElementById("nombre").style.background = "";
            document.getElementById("cantidad").style.background = "";
            document.getElementById("precio").style.background = "";
            document.getElementById("codcategoria").style.background = "";
            document.getElementById("codestado").style.background = "";
        },4000)

        document.getElementById("mostrarData").innerHTML = data;
        location.reload();
    })
    .catch((err) => console.log(err));
}
//ENVIAR DATOS A LOS INPUTS DE LA TABLA
function darClick(codigo) {
    data = new FormData();
    data.append("codigo", codigo);
    data.append("op", "mostrarInput");
    fetch("./consultas.php", {
        method: "POST",
        body: data,
    })
    .then((response) => response.json())
    .then((data) => {
        data.forEach((element) => {
            document.getElementById("codpro").value =element.codpro + element.codigo;
            document.getElementById("nombre").value = element.nombre;
            document.getElementById("cantidad").value = element.cantidad;
            document.getElementById("precio").value = element.precio;
            document.getElementById("codcategoria").value = element.codcategoria;
            document.getElementById("codestado").value = element.codestado;
        });
    })
    .catch((err) => console.log(err));
}

//LIMPIAR CAMPOS
function limpiardatos() {
    document.getElementById("nombre").value = "";
    document.getElementById("cantidad").value = "";
    document.getElementById("precio").value = "";
    document.getElementById("codcategoria").value = "";
    document.getElementById("codestado").value = "";

    var boton = document.getElementById("btn-actualizar");
    boton.disabled = true;

    var boton = document.getElementById("btn-eliminar");
    boton.disabled = true;
}
//LISTAR PRODUCTO 
let mostrarVentaProducto = document.getElementById("mostrarVentaProducto");

function listarProducto(id,nombre,precio,codcategoria,codestado) {
    data = new FormData();
    const restarPrecio = document.getElementById("restarPrecio").value;
    
    data.append("id", id);
    data.append("nombre", nombre);
    data.append("restarPrecio", restarPrecio);
    data.append("precio", precio);
    data.append("codcategoria", codcategoria);
    data.append("codestado", codestado);

    data.append("op", "ingresarProducto");

    fetch ("./consultas.php",{
        method: "POST",
        body: data
    })
    .then((response)=>  response.json())
    .then((data)=>{

        console.log(data.ESTADO);

    }).catch((err) => console.log(err));
}

//DESABILITTAR INPUT VENTA PRODUCTO
function desaInput() {
    const inputDesab = document.getElementById("input-desab");
    inputDesab.disabled = "true";
}

//MODAL
function enviarModal() {
    let modal = document.getElementById('miModal');
    let flex = document.getElementById('flex');
    let abrir = document.getElementById('abrir');
    let cerrar = document.getElementById('close');
    
    abrir.addEventListener('click', function () {
        modal.style.display = 'block';
    });
    
    cerrar.addEventListener('click', function () {
        modal.style.display = 'none';
    });
    window.addEventListener('click', function (e) {
        console.log(e.target);
        if (e.target == flex) {
            modal.style.display = 'none';
        }
    });
}

//RESTAR PRODUCTO
function mandarId(codigo,nombre,precio,CATEGORIA,ESTADO,CODCLIENTE){
    document.getElementById("recibirCodigo").value = codigo;
    document.getElementById("recibirNombre").value = nombre;
    document.getElementById("recibirPrecio").value = precio;
    document.getElementById("recibirCategoria").value = CATEGORIA;
    document.getElementById("recibirEstado").value = ESTADO;
    document.getElementById("recibircliente").value = CODCLIENTE;
}

//VENDER STOCK
function venderStock(){
    // const codcliente = document.getElementById("codcliente").value;
    // console.log(codcliente);
    const recibirCodigo = document.getElementById("recibirCodigo").value;
    const recibirNombre = document.getElementById("recibirNombre").value;
    //INPUT DE CANTIDAD
    const restarPrecio = document.getElementById("restarPrecio").value;
    //////////
    const recibirPrecio = document.getElementById("recibirPrecio").value;
    // const recibir = document.getElementById("recibir").value;
    // console.log(recibir);
    const recibirCategoria = document.getElementById("recibirCategoria").value;
    const recibirEstado = document.getElementById("recibirEstado").value;
    const recibircliente = document.getElementById("recibircliente").value;

    data = new FormData();

    if (restarPrecio === "" || restarPrecio <= 0) {
        alert("No pude vender 0 productos o enviar espacios en blanco, ingrese un valor valido");
    } else {
        // data.append("codcliente",codcliente);

        data.append("recibirCodigo",recibirCodigo);
        data.append("recibirNombre",recibirNombre);
        data.append("restarPrecio",restarPrecio);
        data.append("recibirPrecio",recibirPrecio);
        // data.append("recibir",recibir);
        data.append("recibirCategoria",recibirCategoria);
        data.append("recibirEstado",recibirEstado);
        data.append("recibircliente",recibircliente);

        data.append("op","realizarVenta");
    
        fetch("./consultas.php",{
            method: "POST",
            body: data
        })
        .then((response) => response.json())
        .then((datos)=>{
            alert(datos);  
            location.reload();

        })
        .catch((error)=> console.log(error))
        
    }
}

function deleteActualizar(codigo){
    document.getElementById("obtenerCodigo").value = codigo;

    var boton = document.getElementById("btn-actualizar");
    boton.disabled = false;

    var boton1 = document.getElementById("btn-eliminar");
    boton1.disabled = false;

}

//ACTUALIZAR
document.getElementById("btn-actualizar").addEventListener("click",()=>{
    let codigo = document.getElementById("obtenerCodigo").value;
    let nombre = document.getElementById("nombre").value;
    let cantidad = document.getElementById("cantidad").value;
    let precio = document.getElementById("precio").value;
    let codcategoria = document.getElementById("codcategoria").value;
    let codestado = document.getElementById("codestado").value;

    data = new FormData();
    data.append("codigo", codigo);
    data.append("nombre", nombre);
    data.append("cantidad", cantidad);
    data.append("precio", precio);
    data.append("codcategoria", codcategoria);
    data.append("codestado", codestado);
    data.append("op", "actualizarDatos");

    fetch("./consultas.php", {
        method: "POST",
        body: data,
    })
    .then((response) => response.json())
    .then((data) => {
        if (confirm("¿Desea actualizar el registro numero? " + document.getElementById("codpro").value)) {
            location.reload();
        }
    })
    .catch((err) => console.log(err));
})

//ELIMINAR
document.getElementById("btn-eliminar").addEventListener("click",()=>{

    let codigo = document.getElementById("obtenerCodigo").value;
    data = new FormData();
    data.append("codigo", codigo);
    data.append("op", "eliminarDatos");

    fetch("./consultas.php", {
        method: "POST",
        body: data,
    })
    .then((response) => response.json())
    .then((data) => {
        if (confirm("¿Desea eliminar el registro numero? " + document.getElementById("codpro").value)) {
            location.reload();
        }
    })
    .catch((err) => console.log(err));
})
//LOGICA DE RELOJ


