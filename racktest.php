<?php

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Rack Diagram</title>
	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<style>

html {
  height: 100%;
}

body {
  font-family: sans-serif;
  min-height: 100%;
}


div {
  background-color: #ccc;
  margin: 10px;
  padding: 10px;
  float: left;
  width: 30%;

}


.number {
  float: left;
  width: 50px;
  padding: 0px;
  margin: 0px;
}

.numeral{
  font-size: 24px;
  margin: 0 0px 0 0;
  padding: 7px;
  list-style-type:none;
  border-style:solid;
}

.switch {
  background: #333;
  color: green;
  display: block;
  border-style:solid;
  font-size: 18px;
  margin: 0 5px 0 0;
  padding: 10px;
}

.server {
  background: #333;
  color: blue;
  display: block;
  border-style:solid;
  font-size: 61px;
  margin: 0 5px 0 0;
  padding: 10px;
}

.ups {
  background: #333;
  color: red;
  display: block;
  border-style:solid;
  font-size: 61px;
  margin: 0 5px 0 0;
  padding: 10px;
}

.blank {
  background: #333;
  color: gray;
  display: block;
  height: 28px;
  font-size: 16px;
  margin: 0 5px 0 0;
  padding: 10px;
}

</style>

<script>

$(function() {
$( ".racksize" ).change(function() {
  var value = $('.racksize :selected').text();
  alert(value);
 //$('.number')
 // for (i=1;i<=value;i++){
  //  $('<li class="numeral">'i'</li>');
//}
});
$('.alpha').sortable({
  connectWith: '.gamma',

  helper: function (e, li) {
        this.copyHelper = li.clone().insertAfter(li);

        $(this).data('copied', false);

        return li.clone();
    },
    stop: function () {

        var copied = $(this).data('copied');

        if (!copied) {
            this.copyHelper.remove();
        }

        this.copyHelper = null;
    }
});

$('.beta').sortable({
  connectWith: '.gamma',
  receive: function (event, ui) {
     console.log(event, ui.item);
    ui.item.remove(); // remove original item
  }
});

$('.gamma').sortable({
  appendTo: document.body,
  items: '.ups, .switch, .blank, .server',
  connectWith: '.beta',
  receive: function (e, ui) {
        ui.sender.data('copied', true);
    }
});

});
</script>
</head>	
    <span class="ui-widget">
      <label>Rack Size in RU: </label>
      <select class="racksize">
        <option value="">Select one...</option>
        <option value="8">8</option>
        <option value="12">12</option>
        <option value="12">38</option>
        <option value="12">42</option>
        <option value="12">45</option>
      </select>
    </span>

<div class="alpha">
  <li class="switch">Cisco 3750 24 port</li>
  <li class="switch">Cisco 3750 48 port</li>
  <li class="switch">Cisco 3750X 48 port</li>
  <li class="server">DL380 G7</li>
  <li class="ups">UPS</li>
  <li class="blank">Blank</li>
  <li class="blank">cable management</li>
  <li class="blank">tray</li>
</div>

<div class="gamma">
  <h3>12 RU Rack</h3>
  <div class="number">
    <li class="numeral">1</li>
    <li class="numeral">2</li>
    <li class="numeral">3</li>
    <li class="numeral">4</li>
    <li class="numeral">5</li>
    <li class="numeral">6</li>
    <li class="numeral">7</li>
    <li class="numeral">8</li>
    <li class="numeral">9</li>
    <li class="numeral">10</li>
    <li class="numeral">11</li>
    <li class="numeral">12</li>
  </div>
  
</div>

<div class="beta">
  <h4>Trash</h4>

</div>

</html>