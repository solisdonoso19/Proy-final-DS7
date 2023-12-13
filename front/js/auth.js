function auth() {
    let email = document.getElementById("email").value;
    let pass = document.getElementById("pass").value;
    let form = document.getElementById('auth')
    if (email === '' || pass === '') {
      alert("Por favor, llene todos los campos");
      return;
    }
  
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./request/auth.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        let data = JSON.parse(xhr.responseText);
        if (data.message) {
            window.location.assign("/semestral/front/home.php");
        }else{
            alert('El email o la contraseña son incorrectos, intente nuevamente')
        }
    }
    };
  
    form.addEventListener("submit", function (event) {
        event.preventDefault();
    });

    xhr.send("email=" + email + "&pass=" + pass);
  } 