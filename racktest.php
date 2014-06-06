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



.racksize {
    width: 60px;
}

.number {
  float: left;
  width: 50px;
  padding: 0px;
  margin: 0px;
}

.numeral{
  height: 12px;
  padding: 8px;
  list-style-type:none;
  border-style:solid;
}

.oneru {
  text-align:center;
  background: #333;
  display: block;
  border-style:solid;
  height: 12px;
  padding: 8px;
}

.tworu {
  text-align:center;
  background: #333;
  display: block;
  border-style:solid;
  height: 46px;
  padding: 8px;
}

.threeru {
  text-align:center;
  background: #333;
  display: block;
  border-style:solid;
  height: 80px;
  padding: 8px;
}

.switch {
  color: #32851B;

}

.server {
  color: #003399;
}

.ups {
  color: #800000;

}

.dpatch {
  color: white;
}
.vpatch {
  color: #C7C716;
}

.blank {
  color: gray;
}

</style>

<script>

$(function() {
$( ".racksize" ).change(function() {
  var value = $('.racksize :selected').text();
  //alert(value);
  $('.number').empty();
  for (i=1;i<=value;i++){
    $('.number').append('<li class="numeral">'+ i +'</li>');
  }
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
  items: '.ups, .switch, .blank, .server, .dpatch, .vpatch',
  connectWith: '.beta',
  receive: function (e, ui) {
        ui.sender.data('copied', true);
    }
});

});
</script>
</head>	


<div class="alpha">
  <li class="oneru switch">Cisco 3750 24 port</li>
  <li class="oneru switch">Cisco 3750 48 port</li>
  <li class="oneru switch">Cisco 3750X 48 port</li>
  <li class="tworu server">DL380 G7</li>
  <li class="tworu ups">2KVA UPS</li>
  <li class="threeru ups">3KVA UPS</li>
  <li class="oneru dpatch">Data Patch Panel</li>
  <li class="oneru vpatch">Voice  Patch Panel</li>
  <li class="oneru blank">Blank</li>
  <li class="oneru blank">cable management</li>
  <li class="oneru blank">tray</li>
</div>

<div class="gamma">
  <h3>
      <span class="ui-widget">
      <select class="racksize">
        <option value="">Select one...</option>
        <option value="8">8</option>
        <option value="12">12</option>
        <option value="12">38</option>
        <option value="12">42</option>
        <option value="12">45</option>
      </select>
    </span>
  RU Rack</h3>
  <div class="number">
  </div>
  
</div>

<div class="beta">
  <h4>Trash</h4>

</div>

</html>