var sclid = document.getElementById("sclid");
var sclname = document.getElementById("sclname");
var scltel = document.getElementById("scltel");
var scl_cename = document.getElementById("scl-cename");
var scl_edit = document.getElementById("scl-edit");
var scl_add_new = document.getElementById("scl-add-new");
var scl_dlt = document.getElementById("scl-dlt");
var scl_save = document.getElementById("scl-save");
var scl_add = document.getElementById("scl-add");
var scl_cfmdlt = document.getElementById("scl-cfmdlt");
var scl_cancel = document.getElementById("scl-cancel");
var error = document.getElementById("error");

var setVal = true;

var table = document.getElementsByTagName("table")[1];
var tbody = table.getElementsByTagName("tbody")[0];
tbody.onclick = function (e) {
    var data = [];
    if (setVal) {
        e = e || window.event;
        var target = e.srscllement || e.target;
        while (target && target.nodeName !== "TR") {
            target = target.parentNode;
        }
        if (target) {
            var scllls = target.getElementsByTagName("td");
            for (var i = 0; i < scllls.length; i++) {
                data.push(scllls[i].innerHTML);
            }
        }
        sclid.value = data[0];
        sclname.value = data[1];
        scltel.value = data[2];
        scl_cename.value = data[3];
        error.innerHTML = "";
        error.style.display = "none";
    }
};

function edit() {
    if (sclid.value != "") {
        setVal = false;
        set_ReadOnly(0);
        scl_edit.style.display = "none";
        scl_add_new.style.display = "none";
        scl_dlt.style.display = "none";
        scl_save.style.display = "inline";
        scl_cancel.style.display = "inline";
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
    sclid.value = "sclnter ID was added automatically";
    scl_edit.style.display = "none";
    scl_add_new.style.display = "none";
    scl_dlt.style.display = "none";
    scl_add.style.display = "inline";
    scl_cancel.style.display = "inline";
    error.innerHTML = "";
    error.style.display = "none";
}

function dlt() {
    if (sclid.value != "") {
        setVal = false;
        scl_edit.style.display = "none";
        scl_add_new.style.display = "none";
        scl_dlt.style.display = "none";
        scl_cfmdlt.style.display = "inline";
        scl_cancel.style.display = "inline";
    }
    else {
        error.style.display = "inline";
        error.innerHTML = "Please select what you want to delete!";
    }
}

function cancel() {
    clearAll();
    set_ReadOnly(1);
    scl_edit.style.display = "inline";
    scl_add_new.style.display = "inline";
    scl_dlt.style.display = "inline";
    scl_save.style.display = "none";
    scl_add.style.display = "none";
    scl_cfmdlt.style.display = "none";
    scl_cancel.style.display = "none";
}

function set_ReadOnly(x) {
    if (x == 1) {
        sclname.setAttribute('readonly', true);
        scltel.setAttribute('readonly', true);
        scl_cename.setAttribute('readonly', true);
    }
    else {
        sclname.removeAttribute('readonly');
        scltel.removeAttribute('readonly');
        scl_cename.removeAttribute('readonly');
    }
}

function clearAll() {
    sclid.value = "";
    sclname.value = "";
    scltel.value = "";
    scl_cename.value = "";
    setVal = true;
}