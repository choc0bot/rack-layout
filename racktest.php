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


.rackdiv {
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
  background: #454544;
  display: block;
  border-style:solid;
  height: 12px;
  padding: 8px;
}

.tworu {
  text-align:center;
  background: #454544;
  display: block;
  border-style:solid;
  height: 46px;
  padding: 8px;
}

.threeru {
  text-align:center;
  background: #454544;
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
  color: #FD3F49;

}

.dpatch {
  color: #6949D7;
}
.vpatch {
  color: #C7C716;
}

.blank{
  color: #CCCCCC;
  background: gray;
}

.misc {
  color: gray;
}

button {
  float: right;
  display: inline-block;
  margin: 0 0px 0 0;
  font-size: 14px;
  font-family: "Bitter",serif;
  line-height: 1.8;
  appearance: none;
  box-shadow: none;
  border-radius: 0;
}
button:focus {
  outline: none
}
</style>

<script>

$(function() {

$( document ).ready(function() {
  var value = $('.racksize :selected').text();
  //alert(value);
  $('.number').empty();
  $('.gamma li').remove();
  for (i=1;i<=value;i++){
    $('.number').append('<li class="numeral">'+ i +'</li>');
    $('.gamma').append('<li class="oneru blank">Blank</li>');
  }

});

$( ".racksize" ).change(function() {
  var value = $('.racksize :selected').text();
  //alert(value);
  $('.number').empty();
  //$('.gamma li').remove();
  for (i=1;i<=value;i++){
    $('.number').append('<li class="numeral">'+ i +'</li>');
    $('.gamma').append('<li class="oneru blank">Blank</li>');
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
  items: '.ups, .switch, .blank, .server, .dpatch, .vpatch, .misc',
  connectWith: '.beta',
  receive: function (e, ui) {
        ui.sender.data('copied', true);
  }

});



$(".trim").click( function()
  {
  var rsize = parseInt($('.racksize :selected').text());
  var value = rsize + $('.gamma .oneru').length + 2 * $('.gamma .tworu').length + 3 * $('.gamma .threeru').length; 
  //$('.count').append(value);
  while (value > (2 * rsize)){
    var lilength = $('.gamma li').length - 1;
    //$('.count').append('<li>'+ lilength +'</li>');
    $('.gamma li').slice(lilength).remove();
    var rsize = parseInt($('.racksize :selected').text());
    var value = rsize + $('.gamma .oneru').length + 2 * $('.gamma .tworu').length + 3 * $('.gamma .threeru').length; 
  }
  });

$(".clear").click( function()
    {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:140,
      modal: true,
      buttons: {
        "Yes": function() {
              var value = $('.racksize :selected').text();
              $('.gamma li').remove();
              $('.number').empty();
                for (i=1;i<=value;i++){
              $('.number').append('<li class="numeral">'+ i +'</li>');
              $('.gamma').append('<li class="oneru blank">Blank</li>');
                                      }
              $( this ).dialog( "close" );
        },
        No: function() {
          $( this ).dialog( "close" );
        }
      }
    });

})
}); 


</script>
</head>	

<div id="dialog-confirm" title="Delete all?">
</div>

<div class="alpha rackdiv">
  <li class="heading">Network</li>
  <li class="oneru switch">Cisco 3750 24 port</li>
  <li class="oneru switch">Cisco 3750 48 port</li>
  <li class="oneru switch">Cisco 3750X 48 port</li>
  <li class="heading">Servers</li>
  <li class="tworu server">DL380 G7</li>
  <li class="heading">UPS</li>
  <li class="tworu ups">2KVA UPS</li>
  <li class="threeru ups">3KVA UPS</li>
  <li class="heading">Misc</li>
  <li class="oneru dpatch">Data Patch Panel</li>
  <li class="oneru vpatch">Voice  Patch Panel</li>
  <li class="oneru blank">Blank</li>
  <li class="oneru misc">cable management</li>
  <li class="oneru misc">tray</li>
</div>

<div class="gamma rackdiv">
  <h3>
      <span class="ui-widget">
      <select class="racksize">
        <option value="8">8</option>
        <option value="12" selected>12</option>
        <option value="38">38</option>
        <option value="42" >42</option>
        <option value="45">45</option>
      </select>
    </span>
  RU Rack
  <button class="trim" title="Delete all items outside the designated rack space" id="button">trim</button>
  <button class="clear"  title="Delete all items and start again with a blank rack" id="button">clear</button>
  <div class="count"></div>
</h3>

  <div class="number">
  </div>
</div>

<div class="beta rackdiv">
  <h4>Trash</h4>

</div>

</html>