<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>.: Inmobiliaria :.</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/signin.css">
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div class="container">

      <form action="validarUser.php" method="POST" name="form_login" id="form_login" class="form-signin" role="form">
        <h2 class="form-signin-heading">Login</h2>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        <input class="btn btn-lg btn-primary btn-block" name="login_submit" id="login_submit" type="submit" value="Acceder">
        <div id="result"></div>
      </form>
      

    </div> <!-- /container -->
</body>
</html>
<script src="js/jquery-1.10.2.js"></script>
<script>
	$(function() {
		$("#login_submit").on('click', function(e) {
			e.preventDefault();
			//$("input").css("border", "transparent");
			/* Act on the event */
			if ($("#email").val() == '') {
				$("input[name=email]").css("border", "1px solid red");
				$("#result").html("<div class='alert alert-danger'>Hay un campo Vacio que es Obligatorio!</div>");
			}
			else if ($("#password").val() == '') {
				$("input[name=password]").css("border", "1px solid red");
				$("#result").html("<div class='alert alert-danger'>Hay un campo Vacio que es Obligatorio!</div>");
			}else{ 

				var datos = $("#form_login").serialize();

				$.ajax({
					url: 'validarUser.php',
					type: 'POST',
					dataType: 'json',
					data: datos,
					success: function (data) {
						if(data.auth == true) {
							window.location.href="inicio.php";
							//$("#result").html("<div class='alert alert-success'>Logeado!</div>");
						}else{
							$("#result").html("<div class='alert alert-danger'>Usuario o Password Incorrectos!</div>");
						}
					},
		          	beforeSend: function(){
		            	$("#result").html("<div class='alert-info form-control'><img src='img/ajax-loader.gif' /> Loading...</div>");
		          	}
				})
				.done(function() {
					console.log("success");
				})
				.fail(function() {
					$("#result").html("<div class='alert alert-danger'>Error!!</div>");
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}
		});
	});
</script>