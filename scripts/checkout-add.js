var arrCheckout=[]; 

var numRows = 0;

var checkoutTotal = 0;

// add the summarised order to the checkout section 
// store summary in array
let addToCheckOut = function(orderId, nameChild, date, total, formID){
    let temp = [orderId,nameChild,date,total,formID];
    
    this.arrCheckout.push(temp);
    displayCheckout(false);
    grayer(formID,true);

};

// used to make order greyscale once added to checkout
function grayer(formId, yesNo) {
    var f = document.getElementById(formId), s, opacity;
    s = f.style;
    opacity = yesNo? '40' : '100';
    s.opacity = s.MozOpacity = s.KhtmlOpacity = opacity/100;
    s.filter = 'alpha(opacity='+opacity+')';
    for(var i=0; i<f.length; i++) f[i].disabled = yesNo;
}

let updateTotal = function(ttl){
    let dspTotal = document.querySelector("#checkout-total");
    dspTotal.innerHTML = "R "+ttl.toFixed(2);
};

// creating hidden input for form
let addInputField = function(name, value){
    let e = "<input type='hidden' name='"+name+"'";
    e += " value='"+value+"'>";
    return e;
};

let refreshCheckout = function(checkoutOrder){
    var table = document.querySelector("#table-summary");
    let count = 0;
    for (var i = 0, row; row = table.rows[i]; i++) { 
        row.cells[0].innerHTML = addInputField("size",count+1)
            +addInputField("id_"+count,checkoutOrder[0])
            +addInputField("name_"+count,checkoutOrder[1])+checkoutOrder[1];
        row.cells[1].innerHTML = addInputField('date_'+count,checkoutOrder[2])+displayDate(checkoutOrder[2]);
        row.cells[2].innerHTML = addInputField("subTotal_"+count,checkoutOrder[3])+"R "+checkoutOrder[3];
        
        count++;
    }
}

// display the summary of the orer once button has been clicked 
let displayCheckout = function(remove, rowId = -1, formID){
    checkoutTotal = 0;

    var tbl = document.querySelector("#table-summary");
    if(!remove){
        var row = tbl.insertRow(numRows++);
    
        var cellName = row.insertCell(0);
        var cellDate = row.insertCell(1);
        var celltotal = row.insertCell(2);
        var removeIcon = row.insertCell(3);
        
        // add to checkout summary
        let count = 0;
        this.arrCheckout.forEach(checkoutOrder => {
            cellName.innerHTML = addInputField("size",count+1)
                +addInputField("id_"+count,checkoutOrder[0])
                +addInputField("name_"+count,checkoutOrder[1])+checkoutOrder[1];
            // getting the correct way to display a date in the summary 
            cellDate.innerHTML = addInputField('date_'+count,checkoutOrder[2])
                +displayCheckout(checkoutOrder[2]);
            celltotal.innerHTML = addInputField("subTotal_"+count,checkoutOrder[3])+"R "
                +checkoutOrder[3];
            checkoutTotal +=  parseFloat(checkoutOrder[3]);
            count++;    
            let remvFunc = "removeItem('"+checkoutOrder[0]+"', '"+checkoutOrder[1]+"', '"
                +checkoutOrder[2]+"', '"+checkoutOrder[3]+"', '"+checkoutOrder[4]+"')";
            
            removeIcon.innerHTML = "<button class='checkout-remove-icon' "
                +"onclick=\""+remvFunc+"\""
                +"'><img src='./assets/img/icons8-trash-30.png'></button>";
        });

    }else if(remove){   
        // delete row from talbe
        numRows--;
        var row = tbl.deleteRow(rowId);
        $count = 0;
        this.arrCheckout.forEach(checkoutOrder => {
            checkoutTotal +=  parseFloat(checkoutOrder[3]);
            refreshCheckout(checkoutOrder);
        });
    }

    updateTotal(checkoutTotal);
};


// check that item is in 2d array
function isItemInArray(array, item) {
    for (var i = 0; i < array.length; i++) {
        // This if statement depends on the format of your array
        if (array[i][0] == item[0] && array[i][1] == item[1]
            && array[i][2] == item[2] && array[i][4] == item[4]
            && array[i][5] == item[5]) {
            return i;   // Found it
        }
    }
    return -1;   // Not found
}

// remove item from checkout
// make item non-greyscale and undisabled
let removeItem = function(orderId,nameChild,date,total,formID){
    
    var index = isItemInArray(arrCheckout,[orderId,nameChild,date,total,formID]);
    
    if (index > -1) {
        grayer(formID,false);
        
        this.arrCheckout.splice(index,1);
    }
    
    displayCheckout(true,index,formID);
};

//function to display the date in the correct form "l, d-M-Y"
let displayDate = function(d){
    dateReceived = new date(d);
    let dateDisplay = getLocalDay(dateReceived) + ", " 
        + getDay(dateReceived) + "-" + getMonth(dateReceived) + "-" + getYear(dateReceived);
    alert(dateDisplay);
    return dateDisplay;
}




