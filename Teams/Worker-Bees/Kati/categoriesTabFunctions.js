function openPage(pageName, elmnt) {
    // Hide all elements with class="tabcontent" by default */
    var i, tabcontent, tablinks;
    var color =  "#ffffff00";
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Remove the background color of all tablinks/buttons
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
      tablinks[i].style.color = "#FFFFFF";
      tablinks[i].style.fontWeight = "400";
      tablinks[i].style.textShadow = "none";
    }
  
    // Show the specific tab content
    document.getElementById(pageName).style.display = "block";
  
    // Add the specific color to the button used to open the tab content
    elmnt.style.backgroundColor = color;
    elmnt.style.color = "#feca57";
    elmnt.style.fontWeight = "800";
    elmnt.style.textShadow = "2px 2px #000000";
}

function openDefault() {
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
}

function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

// Close the full screen search box
function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
