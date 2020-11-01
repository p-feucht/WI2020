var sidenav = true;
function rotate_menu_icon(x) {
    x.classList.toggle("change");
    if(sidenav==true){
    openNav();
    sidenav = false;
    }else{
    closeNav();
    sidenav = true;
    }
}

function openNav() {
    document.getElementById("left_sidenav").style.width = "250px";
}
  
function closeNav() {
    document.getElementById("left_sidenav").style.width = "0";
}