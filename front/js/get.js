
function getAll(){
    window.location.reload()
}

function getDataByCategory(userID, categoryID) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./request/getByCategory.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let data  = xhr.responseText;
            let tbody = document.getElementById('table-body')
            tbody.innerHTML = data
        }
    };


    xhr.send("userID=" + userID + "&categoryID=" + categoryID);
  } 
