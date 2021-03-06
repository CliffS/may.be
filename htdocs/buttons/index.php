<!DOCTYPE HTML>
<html>
<head>

<title>Radio Buttons</title>

<?php include"/nfs/c10/h03/mnt/142304/domains/inserthtml.com/html/demos/layout/head.php"; ?>


<link href="styles.css" rel="stylesheet" />

<!--[if lte IE 8]>
<link href="ie8.css" rel="stylesheet" />
<![endif]-->
<script src="modernizr.js"></script>
<script type="text/javascript">

window.onload = function() {

	var Modernizr = window.Modernizr;
	
	if(Modernizr.csstransforms3d) { 
		
		var head = document.querySelector('head');
		
		head.innerHTML = head.innerHTML + '<link rel="stylesheet" href="inserthtml.com.radios.css" />';
		
	}
	
	else {
		
		document.querySelector('.container').innerHTML = '<h1>Hey! Your browser doesn\'t support many of these custom checkboxes.</h1>'+
														 '<p>So here is a type your browser does support:</p>'+ 
														 '<div class="holder">'+
															'<div class="center" style="width: 186px;">'+
																'<input type="checkbox" id="checkbox-1-1" /><label for="checkbox-1-1"></label>'+
																'<input type="checkbox" id="checkbox-1-2" checked /><label for="checkbox-1-2"></label>'+
																'<input type="checkbox" id="checkbox-1-3" /><label for="checkbox-1-3"></label>'+
															'</div>'+
														'</div>';
	}
}

</script>

</head>
<body>

<?php
	$url = 'http://www.inserthtml.com/2013/08/custom-checkbox-set/ ';
	$prev = 'http://inserthtml.com/demos/javascript/flip-book/';
?>
<?php include"/nfs/c10/h03/mnt/142304/domains/inserthtml.com/html/demos/layout/header.php"; ?>

<div class="container">
	<div class="top-content">
		<h1>Custom Radio Button Styles</h1>
		<p>Using Just CSS!</p>
	</div>
	<div class="holder">
		<div class="center" style="width: 186px;">
			<input type="checkbox" id="checkbox-1-1" /><label for="checkbox-1-1"></label>
			<input type="checkbox" id="checkbox-1-2" checked /><label for="checkbox-1-2"></label>
			<input type="checkbox" id="checkbox-1-3" /><label for="checkbox-1-3"></label>
		</div>
	</div>
	
	<div class="holder" style="background: #473C33;">
		<div class="center" style="width: 269px;">
			<input type="checkbox" id="checkbox-2-1" /><label for="checkbox-2-1">I AGREE</label>
		</div>
	</div>
	
	<div class="holder" style="background: #fff;">
		<div class="center" style="width: 186px;">
			<input type="checkbox" id="checkbox-3-1" /><label for="checkbox-3-1"></label>
			<input type="checkbox" id="checkbox-3-2" checked /><label for="checkbox-3-2"></label>
			<input type="checkbox" id="checkbox-3-3" /><label for="checkbox-3-3"></label>
		</div>
	</div>
	
	<div class="holder" style="background: #FFAE94;">
		<div class="center" style="width: 193px;">
			<input type="checkbox" id="checkbox-4-1" /><label for="checkbox-4-1"></label>
			<input type="checkbox" id="checkbox-4-2" /><label for="checkbox-4-2"></label>
			<input type="checkbox" id="checkbox-4-3" checked /><label for="checkbox-4-3"></label>
		</div>
	</div>
	
	<div class="holder" style="background: #5FA6D6;">
		<div class="center" style="width: 180px;">
			<input type="checkbox" id="checkbox-5-1" checked /><label for="checkbox-5-1"></label>
			<input type="checkbox" id="checkbox-5-2" /><label for="checkbox-5-2"></label>
			<input type="checkbox" id="checkbox-5-3" /><label for="checkbox-5-3"></label>
		</div>
	</div>
	
	<div class="holder" style="background: #AECFE5;">
		<div class="center" style="width: 265px;">
			<input type="checkbox" id="checkbox-6-1" /><label for="checkbox-6-1"></label>
			<input type="checkbox" id="checkbox-6-2" /><label for="checkbox-6-2"></label>
			<input type="checkbox" id="checkbox-6-3" /><label for="checkbox-6-3"></label>
			<input type="checkbox" id="checkbox-6-4" checked /><label for="checkbox-6-4"></label>
		</div>
	</div>
	
	<div class="holder" style="background: #33444E;">
		<div class="center" style="width: 467px;">
			<input type="checkbox" id="checkbox-7-1" /><label for="checkbox-7-1"><span>AGREE</span></label>
			<input type="checkbox" id="checkbox-7-2" /><label for="checkbox-7-2"><span>BUY</span></label>
			<input type="checkbox" id="checkbox-7-3" checked /><label for="checkbox-7-3"><span>SELL</span></label>
			<input type="checkbox" id="checkbox-7-4" /><label for="checkbox-7-4"><span>OKAY</span></label>
		</div>
	</div>
	
	<div class="holder" style="background: #EDFFFB;">
		<div class="center" style="width: 361px;">
			<input type="checkbox" id="checkbox-8-1" /><label for="checkbox-8-1"></label>
			<input type="checkbox" id="checkbox-8-2" checked /><label for="checkbox-8-2"></label>
			<input type="checkbox" id="checkbox-8-3" /><label for="checkbox-8-3"></label>
			<input type="checkbox" id="checkbox-8-4" /><label for="checkbox-8-4"></label>
		</div>
	</div>
	
	<div class="holder" style="background: #A0DAB0;">
		<div class="center" style="width: 383px;">
			<input type="checkbox" id="checkbox-9-1" /><label for="checkbox-9-1"></label>
			<input type="checkbox" id="checkbox-9-2" checked /><label for="checkbox-9-2"></label>
			<input type="checkbox" id="checkbox-9-3" /><label for="checkbox-9-3"></label>
			<input type="checkbox" id="checkbox-9-4" /><label for="checkbox-9-4"></label>
		</div>
	</div>
	
	<div class="holder" style="background: white;">
		<div class="center" style="width: 180px;">
			<input type="checkbox" id="checkbox-10-1" /><label for="checkbox-10-1"></label>
			<input type="checkbox" id="checkbox-10-2" checked /><label for="checkbox-10-2"></label>
		</div>
	</div>
	
	<div class="holder" style="background: #E8EDF0;">
		<div class="center" style="width: 211px;">
			<input type="checkbox" id="checkbox-11-1" /><label for="checkbox-11-1"></label>
			<input type="checkbox" id="checkbox-11-2" checked /><label for="checkbox-11-2"></label>
		</div>
	</div>
</div>

</body>
</html>
