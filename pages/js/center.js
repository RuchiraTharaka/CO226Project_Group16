var ceid = document.getElementById("ceid");
var cename = document.getElementById("cename");
var ceaddr = document.getElementById("ceaddr");
var cetel = document.getElementById("cetel");
var cerep = document.getElementById("cerep");
var ce_edit = document.getElementById("ce-edit");
var ce_add_new = document.getElementById("ce-add-new");
var ce_dlt = document.getElementById("ce-dlt");
var ce_save = document.getElementById("ce-save");
var ce_add = document.getElementById("ce-add");
var ce_cfmdlt = document.getElementById("ce-cfmdlt");
var ce_cancel = document.getElementById("ce-cancel");
var error = document.getElementById("error");

var setVal = true;

var table = document.getElementsByTagName("table")[0];
var tbody = table.getElementsByTagName("tbody")[0];
tbody.onclick = function (e) {
    var data = [];
    if (setVal) {
        e = e || window.event;
        var target = e.srcElement || e.target;
        while (target && target.nodeName !== "TR") {
            target = target.parentNode;
        }
        if (target) {
            var cells = target.getElementsByTagName("td");
            for (var i = 0; i < cells.length; i++) {
                data.push(cells[i].innerHTML);
            }
        }
        ceid.value = data[0];
        cename.value = data[1];
        ceaddr.value = data[2];
        cetel.value = data[3];
        cerep.value = data[4];
        error.innerHTML = "";
        error.style.display = "none";
    }
};

function edit() {
    if (ceid.value != "") {
        setVal = false;
        set_ReadOnly(0);
        ce_edit.style.display = "none";
        ce_add_new.style.display = "none";
        ce_dlt.style.display = "none";
        ce_save.style.display = "inline";
        ce_cancel.style.display = "inline";
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
    ceid.value = "Center ID was added automatically";
    ce_edit.style.display = "none";
    ce_add_new.style.display = "none";
    ce_dlt.style.display = "none";
    ce_add.style.display = "inline";
    ce_cancel.style.display = "inline";
}

function dlt() {
    if (ceid.value != "") {
        setVal = false;
        ce_edit.style.display = "none";
        ce_add_new.style.display = "none";
        ce_dlt.style.display = "none";
        ce_cfmdlt.style.display = "inline";
        ce_cancel.style.display = "inline";
    }
    else {
        error.style.display = "inline";
        error.innerHTML = "Please select what you want to delete!";
    }
}

function cancel() {
    clearAll();
    ce_edit.style.display = "inline";
    ce_add_new.style.display = "inline";
    ce_dlt.style.display = "inline";
    ce_save.style.display = "none";
    ce_add.style.display = "none";
    ce_cfmdlt.style.display = "none";
    ce_cancel.style.display = "none";
}

function set_ReadOnly(x) {
    if (x == 1) {
        cename.setAttribute('readonly', true);
        ceaddr.setAttribute('readonly', true);
        cetel.setAttribute('readonly', true);
        cerep.setAttribute('readonly', true);
    }
    else {
        cename.removeAttribute('readonly');
        ceaddr.removeAttribute('readonly');
        cetel.removeAttribute('readonly');
        cerep.removeAttribute('readonly');
    }
}

function clearAll() {
    ceid.value = "";
    cename.value = "";
    ceaddr.value = "";
    cetel.value = "";
    cerep.value = "";
    setVal = true;
}