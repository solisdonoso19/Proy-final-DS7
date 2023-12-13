function deleteGasto(id){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./request/delete.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            window.location.assign("/semestral/front/home.php");
        }
    };

    xhr.send("GastoID=" + id);
}