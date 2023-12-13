function showInsert(){
     const dialog = document.getElementById('insert')
     dialog.showModal()
}

function closeForm(){
    const dialog = document.getElementById('insert')
    dialog.close()
    const dialogP = document.getElementById('putForm')
    dialogP.close()
}

function logout(){
    let form = document.getElementById('logout')

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./request/logout.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let data  = xhr.responseText;
            if (data) {
                window.location.assign("/semestral/front/index.php");
            }
        }
    };

    form.addEventListener("submit", function (event) {
        event.preventDefault();
    });

    xhr.send();
}

function register(){
    window.location.assign("/semestral/front/singin.php");
}

function login(){
    window.location.assign("/semestral/front/index.php");
}