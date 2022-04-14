var coid = document.getElementById("coid");
var cotopic = document.getElementById("cotopic");
var codesc = document.getElementById("codesc");
var colink1 = document.getElementById("colink1");
var colink2 = document.getElementById("colink2");
var co_edit = document.getElementById("co-edit");
var co_add_new = document.getElementById("co-add-new");
var co_dlt = document.getElementById("co-dlt");
var co_save = document.getElementById("co-save");
var co_add = document.getElementById("co-add");
var co_cfmdlt = document.getElementById("co-cfmdlt");
var co_cancel = document.getElementById("co-cancel");
var error = document.getElementById("error");

var setVal = true;

var table = document.getElementsByTagName("table")[1];
var tbody = table.getElementsByTagName("tbody")[0];
tbody.onclick = function (e) {
    var data = [];
    if (setVal) {
        e = e || window.event;
        var target = e.srcolement || e.target;
        while (target && target.nodeName !== "TR") {
            target = target.parentNode;
        }
        if (target) {
            var colls = target.getElementsByTagName("td");
            for (var i = 0; i < colls.length; i++) {
                data.push(colls[i].innerHTML);
            }
        }
        coid.value = data[0];
        cotopic.value = data[1];
        codesc.value = data[2];
        colink1.value = data[3];
        colink2.value = data[4];
        error.innerHTML = "";
        error.style.display = "none";
    }
};

function edit() {
    if (coid.value != "") {
        setVal = false;
        set_ReadOnly(0);
        co_edit.style.display = "none";
        co_add_new.style.display = "none";
        co_dlt.style.display = "none";
        co_save.style.display = "inline";
        co_cancel.style.display = "inline";
    }
    else {
        error.style.display = "inline";
        error.innerHTML = "Please select what you want to edit!";
    }
}

function add_new() {
    clearAll();
    setVal = false;
    set_ReadOnly(0);
    coid.value = "conter ID was added automatically";
    co_edit.style.display = "none";
    co_add_new.style.display = "none";
    co_dlt.style.display = "none";
    co_add.style.display = "inline";
    co_cancel.style.display = "inline";
}

function dlt() {
    if (coid.value != "") {
        setVal = false;
        co_edit.style.display = "none";
        co_add_new.style.display = "none";
        co_dlt.style.display = "none";
        co_cfmdlt.style.display = "inline";
        co_cancel.style.display = "inline";
    }
    else {
        error.style.display = "inline";
        error.innerHTML = "Please select what you want to delete!";
    }
}

function cancel() {
    clearAll();
    set_ReadOnly(1);
    co_edit.style.display = "inline";
    co_add_new.style.display = "inline";
    co_dlt.style.display = "inline";
    co_save.style.display = "none";
    co_add.style.display = "none";
    co_cfmdlt.style.display = "none";
    co_cancel.style.display = "none";
}

function set_ReadOnly(x) {
    if (x == 1) {
        cotopic.setAttribute('readonly', true);
        codesc.setAttribute('readonly', true);
        colink1.setAttribute('readonly', true);
        colink2.setAttribute('readonly', true);
    }
    else {
        cotopic.removeAttribute('readonly');
        codesc.removeAttribute('readonly');
        colink1.removeAttribute('readonly');
        colink2.removeAttribute('readonly');
    }
}

function clearAll() {
    coid.value = "";
    cotopic.value = "";
    codesc.value = "";
    colink1.value = "";
    colink2.value = "";
    setVal = true;
}