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
    tablinks[i].style.color = "black";
    tablinks[i].style.fontWeight = "400";
    tablinks[i].style.textShadow = "none";
    tablinks[i].style.backgroundColor = "none";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
  elmnt.style.color = "black";
  elmnt.style.fontWeight = "800";

  // change hash
  location.hash = "#" + elmnt.id;
}

function openTab() {
// Get the element with id="defaultOpen" and click on it
var hash = window.location.hash.substring(1);
if (hash == 'Werkzeug-Ang') {
var elmnt = document.getElementById(hash);
openPage('Werkzeug',elmnt);
}
else if (hash == 'Werkstatt-Ang') {
var elmnt = document.getElementById(hash);
openPage('Werkstatt',elmnt);
}
else if (hash == 'Dienst-Ang') {
var elmnt = document.getElementById(hash);
openPage('Dienst',elmnt);
}

}

function openSearch() {
document.getElementById("myOverlay").style.display = "block";
}

// Close the full screen search box
function closeSearch() {
document.getElementById("myOverlay").style.display = "none";
}


function datePicker() {

  $('input[name="datefilter"]').daterangepicker({
      autoApply: true,
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  })
}
