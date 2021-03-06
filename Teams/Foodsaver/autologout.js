//wird im Hintergrund ausgeführt
//User wird bei inakivität automatisch abgemeldet
$(function () {
  function timeChecker() {
    setInterval(function () {
      var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");
      timeCompare(storedTimeStamp);
    }, 3000);
  }

  function timeCompare(timeString) {
    var maxMinutes = 15; //GREATER THEN 1 MIN.
    var currentTime = new Date();
    var pastTime = new Date(timeString);
    var timeDiff = currentTime - pastTime;
    var minPast = Math.floor(timeDiff / 60000);

    if (minPast >= maxMinutes) {
      sessionStorage.removeItem("lastTimeStamp");
      window.location = "../autologout.php";
    } else {
      //JUST ADDED AS A VISUAL CONFIRMATION
      //console.log(currentTime + " - " + pastTime + " - " + minPast + " min past");
    }
  }

  if (typeof Storage !== "undefined") {
    $(document).mousemove(function () {
      var timeStamp = new Date();
      sessionStorage.setItem("lastTimeStamp", timeStamp);
    });

    timeChecker();
  }
}); //END JQUERY
