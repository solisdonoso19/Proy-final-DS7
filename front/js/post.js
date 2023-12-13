function postGasto(userID){
    let date = document.getElementById('fecha').value
    let quantity =  document.getElementById('cantidad').value
    let description =  document.getElementById('descripcion').value
    let category =  document.getElementById('categoria').value
    let form = document.getElementById('postGasto')

    if (date === '' || quantity === '' || description === '' || category === '') {
        alert("Por favor, llene todos los campos");
        return;
      }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./request/postGasto.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let data  = xhr.responseText;
            window.location.assign("/semestral/front/home.php");
        }
    };

    form.addEventListener("submit", function (event) {
        event.preventDefault();
    });

    xhr.send("UsuarioID=" + userID + "&CategoriaID=" + category + "&Fecha=" + date + "&Cantidad=" + quantity + "&Descripcion=" + description);
}