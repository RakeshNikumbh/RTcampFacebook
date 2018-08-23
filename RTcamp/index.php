<?php
	session_start();

	if (!isset($_SESSION['access_token'])) {
		header('Location: login.php');
		exit();
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
			content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    	<title>User Profile</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" href="./lib/css/sub_main.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip-utils/0.0.2/jszip-utils.min.js"></script>
		
		<script src="./lib/js/responsiveslides.min.js"></script>
		<script src="./lib/js/main.js"></script>
		<script src="https://apis.google.com/js/platform.js" async defer></script>

</head>
<body>
	<div class="container" style="margin-top: 50px">
		<div class="row justify-content-center" id="alb1">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<img class="box" style="border-radius:50%;border:3px solid #ddd;" src="<?php echo $_SESSION['userData']['picture']['url'] ?>">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
				<table class="table table-hover table-bordered">
					<tbody>
						<tr>
							<td><b>ID</b></td>
							<td><?php echo $_SESSION['userData']['id'] ?></td>
						</tr>
						<tr>
							<td><b>First Name</b></td>
							<td><?php echo $_SESSION['userData']['first_name'] ?></td>
						</tr>
						<tr>
							<td><b>Last Name</b></td>
							<td><?php echo $_SESSION['userData']['last_name'] ?></td>
						</tr>
						<tr>
							<td><b>Email</b></td>
							<td><?php if($_SESSION['userData']['email']==""){echo "<span style='color:red;'>Not Provided</span>";}else{echo $_SESSION['userData']['email'];} ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row" style="background:#ddd;padding:10px;border-radius:10px;">
			<div style="" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
				<h4>Album</h4>
			</div>
			<div style="" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<span style="display:none;" class="btn btn-primary">Download Selected</span>
			</div>
			<div style="" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<span style="display:none;" id="dwall" class="btn btn-primary">Download All</span>
			</div>
		</div>
		<div class="row" id="alb2">
				<?php
					echo "<script>window.localStorage.setItem('albm',".$_SESSION['userData']['albums'].")</script>";
					foreach($_SESSION['userData']['albums'] as $data)
					{
						echo "<div class='card box' style='padding: 10px;width: 16rem;margin:14px;'>
						<img style='width: 100%;height: 130px;border-radius: 15px;border:1px solid #ddd' class='slide{$data['id']}_{$data['name']} card-img-top' src='https://graph.facebook.com/v3.1/{$data['cover_photo']['id']}/picture?access_token={$_SESSION['access_token']}' alt='Card image cap'>
						<div class='card-body'>
							<h5 class='slide{$data['id']}_{$data['name']} card-title'>{$data['name']}</h5>
							<p class='card-text'>Total {$data['count']}</p>
							<a class='slide{$data['id']}_{$data['name']} btn btn-primary'>Show Photos</a>
							<img style='width:30px;height:30px;' src='./lib/img/download_icn.png' class='dwnld{$data['id']}_{$data['name']} download' /><br><br>
						</div>
							</div>";
					}
					
				?>
		</div>
</div>
</body>
</html>