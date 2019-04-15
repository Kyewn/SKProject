function checkErr(){
    var nama = document.getElementById("namaalat").value;
    var bil = document.getElementById("bilalat").value;
    var jenis = document.getElementById("jenisalat").value;

    if (nama == ""){
        alert("Pastikan semua input diisi!");
        return false;
    }
    if (bil == ""){
        alert("Pastikan semua input diisi!");
        return false;
    }
}