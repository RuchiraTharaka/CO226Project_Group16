var table = document.getElementsByTagName("table")[0];
var tbody = table.getElementsByTagName("tbody")[0];
tbody.onclick = function (e) {
    e = e || window.event;
    var target = e.srcElement || e.target;
    while (target && target.nodeName !== "TR") {
        target = target.parentNode;
    }
    if (target) {
        var cells = target.getElementsByTagName("td");
        for (var i = 0; i < cells.length; i++) {
            if (i == 2) {
                document.getElementById("email").value = cells[i].innerHTML;
            }
        }
    }
}; 