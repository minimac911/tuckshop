let hideHeading = function(){
    let thead = document.querySelectorAll("#tblOrderForm thead.thItem");
    console.log(thead);
    
    //used to see if there are any items visble
    let amountVisible = thead.length;

    for (var i = 0; i < thead.length; i++) {
        let tbody = thead[i].nextElementSibling.children;
        let count = 0;
        let amntHide = 0;
        let didHide = false;
        while(tbody[count]!=undefined){
            if(tbody[count].classList.value == "product-item hide")
                amntHide++
            if(amntHide==tbody.length){
                thead[i].style.display = "none";
                didHide = true;
            }else{
                thead[i].style.display = "";
            }
            count++;
        }
        if(didHide){
            amountVisible--;
        }
    }
    let row = document.getElementsByClassName("no-results");
    // if there are no items visible then display this message
    if(amountVisible==0){
        console.log("Nothing visible");
        row[0].style.display = "";
    }else{
        row[0].style.display = "none";
    }
}

function searchItem() {
    var input, filter, th, tr, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    th = document.getElementsByClassName("product-title");
    tr = document.getElementsByClassName("product-item");

    //loop through all rows in table and only show ones that agree to filter
    //hide the rows that are filtered out
    for (i = 0; i < th.length; i++) {
        a = th[i];
        txtValue = a.textContent;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
            tr[i].classList.remove("hide");
        } else {
            tr[i].style.display = "none";
            tr[i].classList.add("hide");
        }
    }
    hideHeading();
}

