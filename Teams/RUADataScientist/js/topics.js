document.write("Test");

function openPop() {

    var pop = document.getElementsByClassName("bg-modal");
    pop.style.display = "flex";

}
var los = document.getElementById("open");
los.addEventListener("click", openPop());

function closePop() {
    document.getElementsByClassName("bg-modal").style.display = "none";
}