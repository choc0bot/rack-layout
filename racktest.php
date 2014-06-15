<?php

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Rack Diagram</title>
	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.2/jquery.mobile.min.js"></script>
<script src="jquery.ui.touch-punch.min.js"></script>
<!--<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />-->
<!--<link rel="stylesheet" href="http://sitedbase/css/Flat-UI-master/css/flat-ui.css" type="text/css">-->
<link rel="stylesheet" href="./css/jquery-mobile-flat-ui-theme/generated/jquery.mobile.flatui.min.css" type="text/css">
<link rel="stylesheet" href="rack.css" type="text/css">


<script>

$(function() {

$( document ).ready(function() {
  var value = $( ".racksize" ).val(); 
  //var value = $('.racksize :selected').text();
  //alert(value);
  $('.number').empty();
  $('.gamma li').remove();
  for (i=1;i<=value;i++){
    $('.number').append('<li class="numeral">'+ ((value - i) + 1) +'</li>');
    $('.gamma').append('<li class="oneru blank">Blank</li>');
  }

});

$( ".racksize" ).on('slidestop', function(){
  var value = $( ".racksize" ).val(); 
  //var value = $('.racksize :selected').text();
  //alert(value);
  $('.number').empty();
  //$('.gamma li').remove();
  for (i=1;i<=value;i++){
    $('.number').append('<li class="numeral">'+ ((value - i) + 1) +'</li>');
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
  items: '',
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

//end
});



function trimFunction() 
  {
  var rsize = parseInt($( ".racksize" ).val());  
  //var rsize = parseInt($('.racksize :selected').text());
  var value = rsize + $('.gamma .oneru').length + 2 * $('.gamma .tworu').length + 3 * $('.gamma .threeru').length; 
  //$('.count').append(value);
  while (value > (2 * rsize)){
    var lilength = $('.gamma li').length - 1;
    //$('.count').append('<li>'+ lilength +'</li>');
    $('.gamma li').slice(lilength).remove();
    var rsize = parseInt($( ".racksize" ).val()); 
    //var rsize = parseInt($('.racksize :selected').text());
    var value = rsize + $('.gamma .oneru').length + 2 * $('.gamma .tworu').length + 3 * $('.gamma .threeru').length; 
  }
  };

$(".trim").click(trimFunction);

$(".clear").click( function()
    {
    $( ".dialog-confirm" ).dialog({
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


$( document ).on( 'click', ".cleared", function()
  {
  var value = 12
  //var value = $('.racksize :selected').text();
  $('.gamma li').remove();
  $('.number').empty();
  for (i=1;i<=value;i++){
    $('.number').append('<li class="numeral">'+ i +'</li>');
    $('.gamma').append('<li class="oneru blank">Blank</li>');
    };
    history.back();
});


$(".save").click( function()
    {
      var rackdiagram = $('.gamma').html();
      var rackname = $('.rackname').val();
      alert('saved '+ rackname);
      $.post("input_racksave.php", {rn: rackname, rd: rackdiagram});
  });



$(function() {
   $( "#accordion" ).accordion({active: false, collapsible: true});
  });




})



</script>
</head>	

<div class="dialog-confirm" title="Delete all?"></div>

    <div data-role="header" >
      <a data-iconpos="notext" data-role="button" data-icon="home" title="Home">Home</a>
      <h1>Rack Layout</h1>
      <a data-iconpos="notext" href="#panel" data-role="button" data-icon="flat-menu"></a>
    </div>
<div data-role="content" role="main">
<div class="alpha rackdiv">
  <div data-role="collapsible-set" data-theme="b" data-content-theme="b">
    <div data-role="collapsible" data-collapsed-icon="flat-plus" data-expanded-icon="flat-cross" data-collapsed="false">
    <h5> Network</h5>
      <div >
        <li class="oneru switch">Cisco 3750 24 port</li>
        <li class="oneru switch">Cisco 3750 48 port</li>
        <li class="oneru switch">Cisco 3750X 48 port</li>
        <li class="oneru switch">Juniper SRX240</li>
        <li class="oneru switch">Cisco 1841</li>
        <li class="oneru switch">Cisco 2960</li>
        <li class="oneru switch">Cisco ASR 1000</li>
        <li class="oneru switch">Cisco Nexus 5000</li>
        <li class="tworu switch">Cisco 1941</li>
        <li class="tworu switch">Cisco 2950</li>
        <li class="threeru switch">Cisco 3925</li>
        <li class="threeru switch">Cisco 3925 48 port</li>
      </div>
    </div>
    <div data-role="collapsible" data-theme="f" data-collapsed-icon="flat-plus" data-expanded-icon="flat-cross">
    <h5> Servers</h5>
      <div>
        <li class="tworu server">HP DL380 G7</li>
      </div>
    </div>
    <div data-role="collapsible" data-theme="d" data-collapsed-icon="flat-plus" data-expanded-icon="flat-cross">
    <h5> UPS</h5>
      <div>
        <li class="tworu ups">APC 1KVA UPS</li>
        <li class="tworu ups">APC 2KVA UPS</li>
        <li class="threeru ups">APC 3KVA UPS</li>
      </div>
    </div>
    <div data-role="collapsible" data-theme="c" data-collapsed-icon="flat-plus" data-expanded-icon="flat-cross">
    <h5> Misc</h5>
      <div>
        <li class="oneru dpatch">Data Patch Panel</li>
        <li class="oneru vpatch">Voice  Patch Panel</li>
        <li class="oneru fpatch">Fibre Panel</li>
        <li class="oneru blank">Blank</li>
        <li class="oneru misc">cable management</li>
        <li class="oneru misc">tray</li>
      </div>
    </div>
  </div>
</div>

<div class="gamma rackdiv">
  <div class="number"></div>
</div>


  <div class="beta rackdiv">
    <div data-role="fieldcontain" >
        <input class="racksize" type="range" name="slider" value="12" min="6" max="48" data-highlight="true" >
    </div>
    <input type="text" placeholder="rack name" class="rackname"></imput>
    <span>
      <button class="save" data-theme="g" id="button">save</button>
      <button class="trim" data-theme="e" title="Delete all items outside the designated rack space" id="button">trim</button>
      <a href="dialog.html" data-role="button" data-theme="d" data-inline="true" data-rel="dialog" data-transition="slidedown">clear</a>
    </span>
    <h5>Trash</h5>
    <span class="trash" ><img src="./image/recyclebin.png" height="128" ></span>
  </div>


</div>

</html>
