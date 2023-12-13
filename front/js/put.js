let gastoID;
let userID
function put(GastoID,
    UsuarioID,
    Fecha,
    Cantidad,
    Descripcion,
    CategoriaID) {
   
        const dialog = document.getElementById('putForm')
        dialog.showModal()
        gastoID = GastoID
        userID = UsuarioID
        document.getElementById('fechaP').value = Fecha
        document.getElementById('descripcionP').value = Descripcion
        document.getElementById('cantidadP').value = Cantidad
        document.getElementById('categoriaP').value = CategoriaID
}

function sendPut(){
    let date = document.getElementById('fechaP').value
    let quantity =  document.getElementById('cantidadP').value
    let description =  document.getElementById('descripcionP').value
    let category =  document.getElementById('categoriaP').value
    let form = document.getElementById('putForm')

    if (date === '' || quantity === '' || description === '' || category === '') {
        alert("Por favor, llene todos los campos");
        return;
      }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./request/putGasto.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            window.location.assign("/semestral/front/home.php");
        }
    };

    form.addEventListener("submit", function (event) {
        event.preventDefault();
    });

    xhr.send("GastoID=" + gastoID + "&UsuarioID=" + userID + "&CategoriaID=" + category + "&Fecha=" + date + "&Cantidad=" + quantity + "&Descripcion=" + description);
}