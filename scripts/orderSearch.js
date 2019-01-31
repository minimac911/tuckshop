let hideHeading = function(){
    let thead = document.querySelectorAll("#tblOrderForm thead.thItem");
    console.log(thead[1].nextElementSibling.children.length);
    let tbody = thead[1].nextElementSibling.children;
    console.log(tbody);
    console.log(tbody[0].classList.value);
    for (var i = 0; i < thead.length; i++) {
        let tbody = thead[i].nextElementSibling.children;
        let count = 0;
        let amntHide = 0;
        while(tbody[count]!=undefined){
            console.log(tbody[count].classList.value);
            if(tbody[count].classList.value == "product-item hide")
                amntHide++
            if(amntHide==tbody.length){
                thead[i].style.display = "none";
            }else{
                thead[i].style.display = "";
            }
            count++;
        }
    }
}

function searchItem() {
    var input, filter, th, tr, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    th = document.getElementsByClassName("product-title");
    tr = document.getElementsByClassName("product-item");

    // let thead = document.querySelectorAll("#tblOrderForm thead.thItem");
    // console.log(thead[1].nextElementSibling.children.length);
    // let tbody = thead[1].nextElementSibling.children;
    // console.log(tbody);
    // console.log(tbody[0].classList.value)
    
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

