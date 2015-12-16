<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="Postcode Finder" content="Postcode Finder">
    <meta name="Jaandlu" content="Postcode Finder">
    

    <title>Postcode Finder</title>

    <!-- Bootstrap core CSS -->
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">



<style>

html, body {

	height:100%;
}

.container {
	background-image:url("http://jaandlu.com/php/images/postcode.jpg");
	width:100%;
	height:100%;
	background-size:cover;
	background-position:center;
	padding-top:100px;
}

.white {
	background-color:#F3F3F3;
	border-radius:25px;
	padding: 25px;
}

p {
	padding-top:15px;
	padding-bottom:5px;
}

button {
	margin-top:20px;
	margin-bottom:20px;
}

.alert 	{
	margin-top:20px;
	display:none;
}


</style>

</head>
<body>

  

 <div class="container">

      <div class="row">
        
  		<div class="col-md-6 col-md-offset-3 white">
  		
  			<h1 class="text-center">Postcode Finder</h1>
  			<p class="lead text-center">Enter any address to find the postcode.<p>
  		
 			<form>
 		
 				<div class="form-group text-center">
 					
 					<input type="text" class="form-control" name="address" id="address" placeholder="Eg: 42 Douglas St, Adamsville"></input>
 					
 				</div>
 				
 				<div class="form-group text-center">
 					
 					<button id="findPostcode" type="submit" class="btn btn-success btn-lg">Find Postcode</button>
 			
 				</div>
 		
 			</form>
 		
 			<div id="success"  class="alert alert-success"></div>
 			<div id="fail" class="alert alert-danger"> Could not find that address. Please try again. </div>
			
			<div id="fail2" class="alert alert-danger"> Ooops! Something went horribly wrong. We could not process your request! We are working on it and things will be back up and running again soon. Have some pie.</div>
			
 		</div> 	
 		
		
    </div>

     

 </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   <script src="//getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  
  	<script>
	
	$("#findPostcode").click(function(event) {
	
		var result=0;
		
		$(".alert").hide();
	
		event.preventDefault();
		
		$.ajax({
			type: "GET",
url:"https://maps.googleapis.com/maps/api/geocode/xml?address="+encodeURIComponent($('#address').val())+"&key=AIzaSyBm0bCw9xZKqm7JBdIU45wcPG5VQvBh-LQ",
			dataType: "xml",
			success: processXML,
			error:error
			
		});
		
		function error() {
			$("#fail2").fadeIn();
		}
		
		
		function processXML(xml) {
			
			$(xml).find("address_component").each(function() {
			
				if ($(this).find("type").text()=="postal_code") {
				
					$("#success").html("The postcode you need is "+$(this).find('long_name').text()).fadeIn();
				
				result=1;
				
				}
			
			});
			
			if (result==0) {
				$("#fail").fadeIn();
			
			}
			
			
		}
		
	});

	</script>
	 
  </body>
</html>