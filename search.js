/* Table model:
    <table>
    <tr>
        TH tags in here..
    </tr>
    <tr>
        <td><input type=text></td>
        <td><input type=text></td>
        <td><input type=text></td>
        ..
    </tr>
    </table>
*/
function search() {
    //get Table
    var myTable = document.getElementById("peralatan");    
    //get search value
    var filterVal = document.getElementById("searchbox").value;
    
    if (filterVal != ""){
        filterVal = filterVal.toUpperCase();
        var tr = myTable.getElementsByTagName("tr");    //Get tr in the table
        var noOfRows = myTable.getElementsByTagName("tr").length; //get rows after subtracting first row
        var targetCol = document.getElementById("pilih").value; //select which column to run the search
        if (targetCol == "KodAlat") {
            targetCol = 1;
        } else if (targetCol == "NamaAlat") {
            targetCol = 2;
        } else if (targetCol == "BilAlat") {
            targetCol = 3;
        } else if (targetCol == "JenisAlat") {
            targetCol = 4;
        } else if (targetCol == "Pendaftar") {
            targetCol = 5;
        } 
            for (var i=0;i<noOfRows;i++){ //while running through the rows
                //get first input of tr[1],tr[2]...
                var input = tr[i].getElementsByTagName("input")[targetCol];
                if (input) { 
                //get its value
                var inputVal = tr[i].getElementsByTagName("input")[targetCol].value;
                //if the value contains the search data
                    if (inputVal.toUpperCase().indexOf(filterVal) > -1) {
                        tr[i].style.display = ""; //show it                   
                    } else {
                        tr[i].style.display = "none"; //hide it
                    }
                }
            }
    } else if (filterVal.length == 0) {
        var noOfRows = myTable.getElementsByTagName("tr").length; //get rows after subtracting first row
        var tr = myTable.getElementsByTagName("tr");    //Get tr in the table
        for (var i=0;i<noOfRows;i++){
            tr[i].style.display = "";
        }
    }
}

function rsearch() {
    //get Table
    var myTable = document.getElementById("kerosakan");    
    //get search value
    var filterVal = document.getElementById("searchbox").value;
    
    if (filterVal != ""){
        filterVal = filterVal.toUpperCase();
        var tr = myTable.getElementsByTagName("tr");    //Get tr in the table
        var noOfRows = myTable.getElementsByTagName("tr").length; //get rows after subtracting first row
        var targetCol = document.getElementById("pilih").value; //select which column to run the search
        if (targetCol == "KodAlat") {
            targetCol = 1;
        } else if (targetCol == "NamaAlat") {
            targetCol = 2;
        } else if (targetCol == "BilAlat") {
            targetCol = 3;
        } else if (targetCol == "JenisAlat") {
            targetCol = 4;
        } else if (targetCol == "Pendaftar") {
            targetCol = 5;
        } 
            for (var i=0;i<noOfRows;i++){ //while running through the rows
                //get first input of tr[1],tr[2]...
                var input = tr[i].getElementsByTagName("input")[targetCol];
                if (input) { 
                //get its value
                var inputVal = tr[i].getElementsByTagName("input")[targetCol].value;
                //if the value contains the search data
                    if (inputVal.toUpperCase().indexOf(filterVal) > -1) {
                        tr[i].style.display = ""; //show it                   
                    } else {
                        tr[i].style.display = "none"; //hide it
                    }
                }
            }
    } else if (filterVal.length == 0) {
        var noOfRows = myTable.getElementsByTagName("tr").length; //get rows after subtracting first row
        var tr = myTable.getElementsByTagName("tr");    //Get tr in the table
        for (var i=0;i<noOfRows;i++){
            tr[i].style.display = "";
        }
    }
}
    
    
    
