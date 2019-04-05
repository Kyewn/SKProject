function checkErr(){
    var id = document.getElementById("userid").value;
    var pass = document.getElementById("pass").value;
    var confirmpass = document.getElementById("confirmpass").value;
    var answer = document.getElementById("answer").value;

    if (id == ""){
        alert("Pastikan semua input diisi!");
        return false;
    }
    if (pass == ""){
        alert("Pastikan semua input diisi!");
        return false;
    }
    if (confirmpass == ""){
        alert("Pastikan semua input diisi!");
        return false;
    }
    if (answer == ""){
        alert("Pastikan semua input diisi!");
        return false;
    }
}