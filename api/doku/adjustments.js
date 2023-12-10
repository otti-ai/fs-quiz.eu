function selectVersion() {
    var v = document.getElementById("version").value;
    if(v<2){
        document.getElementById("v1").style.display = "block";
        document.getElementById("v2").style.display = "none";
    }else{
        document.getElementById("v2").style.display = "block";
        document.getElementById("v1").style.display = "none";
    }
}