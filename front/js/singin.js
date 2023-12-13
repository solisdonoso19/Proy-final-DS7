function singin() {
    let email = document.getElementById("email").value;
    let pass = document.getElementById("pass").value;
    let name = document.getElementById("name").value;
    let prep = document.getElementById("prep").value;
    let form = document.getElementById('singin')
    if (email === '' || pass === '' || name === '' || prep === '') {
      alert("Por favor, llene todos los campos");
      return;
    }
  
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./request/singin.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        let data = JSON.parse(xhr.responseText);
        if (data.message) {
            alert('Usuario creado con exito, inicie sesión')
            window.location.assign("/semestral/front/index.php");
        }else{
            alert('Ah habido un error, intente nuevamente')
        }
    }
    };
  
    form.addEventListener("submit", function (event) {
        event.preventDefault();
    });

    xhr.send("email=" + email + "&pass=" + pass + "&prep=" + prep + "&name=" + pass);
  } 