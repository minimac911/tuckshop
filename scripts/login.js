function switchVisible(logOrSign) {
    if (logOrSign === 's') {
        document.getElementById('signup').style.display = 'block';
        document.getElementById('tabSign').classList.add("active");
        document.getElementById('login').style.display = 'none';
        document.getElementById('tabLog').classList.remove("active");
    } else if (logOrSign === 'l') {
        document.getElementById('signup').style.display = 'none';
        document.getElementById('tabSign').classList.remove("active");
        document.getElementById('login').style.display = 'block';
        document.getElementById('tabLog').classList.add("active");
    }
}

var select = document.getElementById('drop-down-grade');

function changeOptions(inputGr, inputCl) {
    var optionsGrade = ["Hedgehogs", "Squirrel"];
    var grade = document.getElementById("drop-down-grade").value;
    if (inputGr !== undefined) {
        grade = inputGr+'';
    }

    switch (grade) {
        case 'RR'://hedge hogs and squirels
            optionsGrade = ["Hedgehogs", "Squirrel"];
            break;
        case 'R'://red blue yellow green
            optionsGrade = ["Red", "Blue", "Yellow", "Green"];
            break;
        case '1'://j c r s 
        case '2':
            optionsGrade = ["J", "C", "R", "S"];
            break;
        case '3'://j c r 
        case '4':
        case '5':
        case '6':
            optionsGrade = ["J", "C", "R"];
            break;
    }
    // get reference to select element
    var sel = document.getElementById('drop-down-class');

    for (let i = sel.options.length - 1; i >= 1; i--) { 
        sel.remove(i);
    }

    for (let i = 0; i < optionsGrade.length; i++) {
        // create new option element
        var opt = document.createElement('option');

        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(optionsGrade[i]));

        // set value property of opt
        opt.value = optionsGrade[i];

        if (inputCl !== undefined && inputCl == optionsGrade[i]) {
            opt.selected = true;
        }

        // add opt to end of select box (sel)
        sel.appendChild(opt);
    }
}




