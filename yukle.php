<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="stil.css">
	<title>Yükle ve Önizle</title>
</head>
<body>
	<div class="container">
		<h1>Yükle ve Önizle</h1>
		<form action="yukle.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="photo" id="photo">
			<button type="submit" name="submit">Önizle</button>
		</form>
	</div>
</body>
</html>

<?php

$upload_dir = "fotograflar/";

if(isset($_POST['submit'])) {
	$photo = $_FILES['photo']['name'];
	$tmp_photo = $_FILES['photo']['tmp_name'];
	$photo_ext = pathinfo($photo, PATHINFO_EXTENSION);

	if($photo_ext != "jpg" && $photo_ext != "jpeg" && $photo_ext != "png") {
		echo "Lütfen sadece jpg, jpeg ve png dosyaları yükleyin!";
	} else {
		$photo_path = $upload_dir . $photo;
		move_uploaded_file($tmp_photo, $photo_path);

    $img_url = $upload_dir . $photo;

    echo '<img src="' . $img_url . '" />';
	}
}

$photos = scandir($upload_dir);

echo "<h2>Yüklenenler</h2>";
echo "<div class='photos'>";
	
	foreach($photos as $photo) {
		if(!is_dir($photo)) {
			$photo_path = $upload_dir . $photo;
			echo "<img src='" . $photo_path . "' alt='" . $photo . "'>";
		}
	}
echo "</div>";

?>

