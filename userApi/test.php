<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
  $("button").click(function(){
    $("div").animate({
      left: 'toggle'
    });
  });

  $('#feedback-pass').load('checkpassword.php').show();
  $('#input-password').keyup(function(){
        
        $.post('checkpassword.php', {check: form.check.value },
               
               function(result) {
                  
                  $('#feedback-pass').html(result).show();
               });


	 });
});
</script> 
</head>
<body>

<button>Start Animation</button>

<p>By default, all HTML elements have a static position, and cannot be moved. To manipulate the position, remember to first set the CSS position property of the element to relative, fixed, or absolute!</p>

<div style="background:#98bf21;height:100px;width:100px;position:absolute;"></div>

<form name="form">
	<input id="input-password" type="password" name="check" style="position: absolute;top: 50%; left: 50%">
</form>
<div id="feedback-pass" style="position: absolute;top: 60%; left: 50%">></div>

</body>
</html>