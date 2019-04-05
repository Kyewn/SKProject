function checkErr(){
    var id = document.getElementById("userid").value;
    var pass = document.getElementById("password").value;
    if (id == ""){
        alert("Input kosong! Pastikan butiran anda diisi!");
        return false;
    }
    if (pass == ""){
        alert("Input kosong! Pastikan butiran anda diisi!");
        return false;
    }
}