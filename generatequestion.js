function showQuestion(str) {
    var xhttp;
    if (str == ""){
        document.getElementById("question").innerHTML = "";
        return;
    } else {
        xhttp = new XMLHttpRequest();
    }
    
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200){
            document.getElementById("question").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "forgotpass.php?q=" + str, true);
    xhttp.send();
}