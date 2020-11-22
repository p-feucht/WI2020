<!-- The search field -->
<script src="JavaScript/filter.js"></script>
<form class="search" onsubmit="filterOffers()">

<input type="text" id="free-text" placeholder="Was suchst du?">
<input id="autocomplete" class="controls" type="text" placeholder="Wo brauchst du es?" />
<div class="icon"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></div>
<input type="text" id="date-werkzeug" name="datefilter-werkzeug" value="" placeholder="Wann passt es dir am besten?" />
<script type="text/javascript" src="JavaScript/datepicker.js">
    datePickerWerkstatt();
    </script>
<script src="JavaScript/filter.js"></script>
<button type="submit" ><i class="fa fa-search"></i></button>

</form>