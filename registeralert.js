function checkErr(){
    var namapengguna = document.getElementById("namapengguna").value;
    var password = document.getElementById("password").value;
    var confirmpass = document.getElementById("confirmpass").value;
    var question = document.getElementById("question").value;
    var answer = document.getElementById("answer").value;

    if (namapengguna == ""){
        alert("Pastikan semua input diisi!");
        return false;
    }
    if (password == ""){
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
    if (question == ""){
        alert("Pastikan semua input diisi!");
        return false;
    }
}