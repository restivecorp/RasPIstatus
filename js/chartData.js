function refreshCombo(){
    var url = window.location.href.split("?")[0];
    var mx = document.getElementById("max").value;

    url = url + "?max=" + mx;

    window.location.href = url;
}
