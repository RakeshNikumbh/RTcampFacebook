<?php
	session_start();

	if (!isset($_SESSION['access_token'])) {
		header('Location: login.php');
		exit();
	}
?>
<?php
    // Get album id from url
    $album_id = isset($_GET['album_id'])?$_GET['album_id']:header("Location: index.php");
    $album_name = isset($_GET['album_name'])?$_GET['album_name']:header("Location: index.php");

    // Get access token from session
    $access_token = $_SESSION['access_token'];

    // Get photos of Facebook page album using Facebook Graph API
    $graphPhoLink = "https://graph.facebook.com/v2.9/{$album_id}/photos?fields=source,images,name&access_token={$access_token}";
    $jsonData = file_get_contents($graphPhoLink);
    $fbPhotoObj = json_decode($jsonData, true, 512, JSON_BIGINT_AS_STRING);

    // Facebook photos content
    $fbPhotoData = $fbPhotoObj['data'];
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
		
		<script src="./lib/js/main.js"></script>
</head>
<body>
	<div class="container" style="margin-top: 30px">
		<div class="row" style="border-radius:10px;">
			<div style="background:#ddd;padding:10px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<span id="back" class="btn btn-primary">Go Back</span>
			</div>
		</div>
		<div class="row" id="alb2">
				<?php 
					foreach($fbPhotoData as $data)
					{
                        $imageData = end($data['images']);
                        $imgSource = isset($imageData['source'])?$imageData['source']:'';
                        $name = isset($data['name'])?$data['name']:'no-name';
                        $pass=$imgSource."_".$name;

						echo "<div class='card box' style='padding: 10px;width: 16rem;margin:14px;'>
						<img style='width: 100%;height: 130px;border-radius: 15px;border:1px solid #ddd' class='card-img-top' src='{$imgSource}' alt='Card image cap'>
						<div class='card-body'>   
						</div>
                        </div>";
					}
				?>
		</div>
</div>
</body>
</html>