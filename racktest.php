<?php

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Rack Diagram</title>
	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="rack.css" type="text/css">
<link rel="stylesheet" href="http://sitedbase/css/Flat-UI-master/css/flat-ui.css" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>


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
  items: '.ups, .switch, .blank, .server, .dpatch, .vpatch, .fpatch, .misc',
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
  items: '.ups, .switch, .blank, .server, .dpatch, .vpatch, .fpatch, .misc',
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

});

$(".save").click( function()
    {
      var rackdiagram = $('.gamma').html();
      var rackname = $('.rackname').html();
      alert(rackname);
      $.post("input_racksave.php", {rn: rackname, rd: rackdiagram});
  });

})



</script>
</head>	

<div id="dialog-confirm" title="Delete all?">
</div>

<div class="alpha rackdiv">
  <li class="heading">Network</li>
    <li class="oneru switch">Cisco 3750 24 port</li>
    <li class="oneru switch">Cisco 3750 48 port</li>
    <li class="oneru switch">Cisco 3750X 48 port</li>
    <li class="oneru switch">Cisco 1841</li>
    <li class="oneru switch">Cisco 2960</li>
    <li class="tworu switch">Cisco 2950</li>
    <li class="oneru switch">Cisco ASR 1000</li>
    <li class="oneru switch">Cisco Nexus 5000</li>
    <li class="threeru switch">Cisco 3925</li>
    <li class="threeru switch">Cisco 3925 48 port</li>
    <li class="oneru switch">Juniper SRX240</li>
  <li class="heading">Servers</li>
  <li class="tworu server">DL380 G7</li>
  <li class="heading">UPS</li>
  <li class="tworu ups">2KVA UPS</li>
  <li class="threeru ups">3KVA UPS</li>
  <li class="heading">Misc</li>
  <li class="oneru dpatch">Data Patch Panel</li>
  <li class="oneru vpatch">Voice  Patch Panel</li>
  <li class="oneru fpatch">Fibre Panel</li>
  <li class="oneru blank">Blank</li>
  <li class="oneru misc">cable management</li>
  <li class="oneru misc">tray</li>
</div>

<div class="gamma rackdiv">

  <div class="number">
  </div>
</div>

<div class="beta rackdiv">
    <h5>
      <span class="ui-widget">
      <select class="racksize">
        <option value="8">8</option>
        <option value="12" selected>12</option>
        <option value="38">38</option>
        <option value="42" >42</option>
        <option value="45">45</option>
      </select>
    </span>
  RU Rack</h5>
  <input type="text" placeholder="rack name" class="rackname">
  <span>
  <button class="save btn btn-block btn-lg btn-success" id="button">save</button>
  <button class="trim btn btn-block btn-lg btn-warning" title="Delete all items outside the designated rack space" id="button">trim</button>
  <button class="clear btn btn-block btn-lg btn-danger"  title="Delete all items and start again with a blank rack" id="button">clear</button>
</span>
<div></br></div>
<div class="btn btn-block btn-lg btn-inverse"></div>
<h5>Trash</h5>

</div>

</html>
