<html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/login.css" rel="stylesheet">
	<style type="text/css">
		.center1 {
			text-align: center;
			margin: auto;
		  	width: 60%;
			margin-top: 80px;
			margin-bottom: 40px;
			padding: 60px 80px;
			color:#5c5c5c; 
			border: 3px solid lightgrey;
		}
		.center1 h1{
			padding: 0;
			margin: 0;
		}
		.center1 h2{
			font-weight: normal;
			padding: 0;
			margin: 0;
			margin-top: 5px;
		}
		.center1 h3{
		  	font-weight: normal;
		  	padding: 0;
		  	margin: 0;
		  	margin-top: 5px;
		}
		.center1 img{
			height: 100px;
			width: 100px;
		}
		.btn{
			float: center;
		  	margin: 20px;
		  	height: 45px;
		  	width: 80px;
		  	background: #44DBFA;
		  	font-size: medium;
		  	border: 2px solid white;
		  	border-radius: 8px;
		}
		.btn:hover{
		  	float: center;
		  	margin: 20px;
		  	height: 45;
		  	width: 80px;
		  	background: white;
		  	color: #44DBFA;
		  	font-size: medium;
		  	border: 2px solid #44DBFA;
		  	border-radius: 8px;
		  	box-shadow: 0px 0px 25px #44DBFA;
		}
	</style>
</head>
<body>
<?php include('config.php');?>
	<div class="center1"><img src="icons/check.png"><br><br>
		<h1 style="text-align:center;">Payment Successfull!!</h1><br>
		<div class="input-group">
  			<button class="btn" name="okay" onclick="okay()">Okay</button>
		</div>
	</div>
	<?php include('footer.php');?>
<script type="text/javascript">
	function okay() 
	{
		window.location.href = "index.php";
	}
</script>
</body>
</html>
