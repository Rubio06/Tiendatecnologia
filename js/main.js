let tabla = document.getElementById('mostrarData')
data = new FormData()
data.append('op', 'mostrarDatos')

fetch('./consultas.php', {
    method: 'POST',
    body: data
})
    .then(response => response.json())
    .then(data => {
        data.forEach(element => {
            tabla.innerHTML += `
        <tr id="codigo" ondblclick="darClick('${element.codigo}')">
            <td scope="row" style='background:#B9F3B3; font-weight: bold;'>${element.codpro}${element.codigo}</td>
            <td>${element.nombre}</td>
            <td style='text-align:center;'>${element.cantidad}</td>
            <td style='text-align:center;'>S/. ${element.precio}</td>
            <td style='text-align:center;'>${element.fecharegistro}</td>
            <td style='text-align:center;'>${element.CATEGORIA}</td>
            <td style='text-align:center;'>${element.ESTADO}</td>
            <td style='text-align:center;'><button onclick='ingresarProducto("${element.codigo}")' style='border:none; padding:10px 11px 10px 11px; font-size: 20px; border-radius: 5px; background:#4ad967;'><i class="fa-solid fa-cart-shopping" style="color: #ffff; text-align:center;"></i></button></td>
            <td style='text-align:center;'><button style='border:none; padding:8px 13px 8px 13px; border-radius: 5px; font-size:20px; background: rgba(214, 55, 55, 0.925);'><i class="fa-solid fa-trash" style="color: #ffff;"></i></button></td>
        </tr>
        `
            document.getElementById(
                'botonActualizar'
            ).innerHTML = `<button class="btn btn-info" style="width:100%; font-weight:bold;" onclick="actualizar('${element.codigo}')">ACTUALIZAR</buttonstyle=>`
            document.getElementById(
                'botonEliminar'
            ).innerHTML = `<button class="btn btn-danger" style="width:100%; font-weight:bold;" onclick="eliminar('${element.codigo}')">ELIMINAR</button>`
        })
    })
    .catch(err => console.log(err))

//INPUT PARA BUSCAR EN TIEMPO REAL
document.getElementById('busqueda').addEventListener('keyup', () => {
    let busqueda = document.getElementById('busqueda').value

    data = new FormData()
    data.append('busqueda', busqueda)
    data.append('op', 'buscar')

    fetch('./consultas.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById('mostrarData').innerHTML = data
        })
        .catch(err => console.log(err))
})
//BUSCAR FECHA DESDE HASTA
function buscarFecha() {
    let desde = document.getElementById('desde').value
    let hasta = document.getElementById('hasta').value

    data = new FormData()
    data.append('desde', desde)
    data.append('hasta', hasta)
    data.append('op', 'buscarFecha')

    fetch('./consultas.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById('mostrarData').innerHTML = data
        })
        .catch(err => console.log(err))
}
//MOSTRAR CATEGORIA EN EL SELECT
function listarCategoria() {
    let categoria = document.getElementById('cod_categoria').value

    data = new FormData()
    data.append('categoria', categoria)
    data.append('op', 'buscarCategoria')

    fetch('./consultas.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById('mostrarData').innerHTML = data
        })
        .catch(err => console.log(err))
}
//INSERTAR DATOS
function insertarDatos() {
    let codpro = document.getElementById('codpro').value
    let nombre = document.getElementById('nombre').value
    let cantidad = document.getElementById('cantidad').value
    let precio = document.getElementById('precio').value
    let fecharegistro = document.getElementById('fecharegistro').value
    let codcategoria = document.getElementById('codcategoria').value
    let codestado = document.getElementById('codestado').value

    data = new FormData()
    data.append('codpro', codpro)
    data.append('nombre', nombre)
    data.append('cantidad', cantidad)
    data.append('precio', precio)
    data.append('fecharegistro', fecharegistro)
    data.append('codcategoria', codcategoria)
    data.append('codestado', codestado)
    data.append('op', 'insertarDatos')

    fetch('./consultas.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById('mostrarData').innerHTML = data
            location.reload()
        })
        .catch(err => console.log(err))
}
//ENVIAR DATOS A LOS INPUTS DE LA TABLA
function darClick(codigo) {
    data = new FormData()
    data.append('codigo', codigo)
    data.append('op', 'mostrarInput')
    fetch('./consultas.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            data.forEach(element => {
                document.getElementById('codpro').value =
                    element.codpro + element.codigo
                document.getElementById('nombre').value = element.nombre
                document.getElementById('cantidad').value = element.cantidad
                document.getElementById('precio').value = element.precio
                document.getElementById('fecharegistro').value = element.fecharegistro
                document.getElementById('codcategoria').value = element.codcategoria
                document.getElementById('codestado').value = element.codestado
            })
        })
        .catch(err => console.log(err))
}
//ACTUALIZAR
function actualizar(codigo) {
    let nombre = document.getElementById('nombre').value
    let cantidad = document.getElementById('cantidad').value
    let precio = document.getElementById('precio').value
    let fecharegistro = document.getElementById('fecharegistro').value
    let codcategoria = document.getElementById('codcategoria').value
    let codestado = document.getElementById('codestado').value

    data = new FormData()
    data.append('codigo', codigo)
    data.append('nombre', nombre)
    data.append('cantidad', cantidad)
    data.append('precio', precio)
    data.append('fecharegistro', fecharegistro)
    data.append('codcategoria', codcategoria)
    data.append('codestado', codestado)
    data.append('op', 'actualizarDatos')

    fetch('./consultas.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            if (
                confirm(
                    '¿Desea actualizar el registro numero? ' +
                    document.getElementById('codpro').value
                )
            ) {
                location.reload()
            }
        })
        .catch(err => console.log(err))
}
//ELIMINAR
function eliminar(codigo) {
    data = new FormData()
    data.append('codigo', codigo)

    data.append('op', 'eliminarDatos')

    fetch('./consultas.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            if (
                confirm(
                    '¿Desea eliminar el registro numero? ' +
                    document.getElementById('codpro').value
                )
            ) {
                location.reload()
            }
        })
        .catch(err => console.log(err))
}
//LIMPIAR CAMPOS
function limpiardatos() {
    document.getElementById('nombre').value = ''
    document.getElementById('cantidad').value = ''
    document.getElementById('precio').value = ''
    document.getElementById('fecharegistro').value = ''
    document.getElementById('codcategoria').value = ''
    document.getElementById('codestado').value = ''
}

function ingresarProducto(id) {
        console.log(id);
}
