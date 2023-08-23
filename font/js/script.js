var ignore=document.querySelectorAll(".ignore");
var printbt=document.getElementById("print");

printbt.addEventListener("click",function () {
    window.print();
})

window.onbeforeprint=function() {
    for (const elem in ignore) {
        ignore[elem].style.opacity="0";
    }
}

window.onafterprint=function() {
    for (const elem in ignore) {
        ignore[elem].style.opacity="1";
    }
}