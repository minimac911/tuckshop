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

var tabSign = document.getElementById('tabSign');
if(tabSign)
    tabSign.addEventListener("click", switchVisible('l'));

var tabLog = document.getElementById('tabLog');
if(tabLog)
    tabLog.addEventListener("click", function(){
        switchVisible('l');
        console.log(tabLog);
    });


