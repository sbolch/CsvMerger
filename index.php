<!doctype html>

<?php require('./config.php'); ?>

<html>
	<head>
		<meta charset="utf-8">
		<meta author="CC-Szabolcs">
		<title>Awesome CSV Merger <?=$config['version']?></title>
		<link href="assets/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<div class="container">
			<h1>Awesome CSV Merger <?=$config['version']?></h1>

			<p>
				<strong>A bemeneti fájlok helye az input mappában van, a kimeneti fájlok pedig az output mappába kerülnek.</strong>
			</p>

			<?php
				if(isset($_SESSION['msg'])) {
					echo '<p class="msg">'.$_SESSION['msg'].'</p>';
					unset($_SESSION['msg']);
				}

				if(isset($_SESSION['unsure'])) {
					echo '<div class="unsure">';
					foreach($_SESSION['unsure'] as $line) {
						echo '<p>'.$line.'</p>';
					}
					echo '</div>';
					unset($_SESSION['unsure']);
				}
			?>

			<form id="merge-form" method="post" action='./work.php'>
				<label for="main-input-file">1. Válaszd ki a fő fájlt <small>(erre fognak vonatkozni az ellenőrzések)</small>:</label>
				<select name="main-input-file">
					<?php
						$files = scandir($config['inputDir']);

						foreach($files as $file) {
							if($file != '.' && strpos($file, '.csv')) {
								echo '<option value="'.$file.'">'.$file.'</option>';
							}
						}
					?>
				</select>

				<label for="second-input-file">2. Válaszd ki a második fájlt <small>(ezek az elemek lesznek ellenőrizve)</small>:</label>
				<select name="second-input-file">
					<?php
						$files = scandir($config['inputDir']);

						foreach($files as $file) {
							if($file != '.' && strpos($file, '.csv')) {
								echo '<option value="'.$file.'">'.$file.'</option>';
							}
						}
					?>
				</select>

				<label for="mode">3. Válaszd ki a fésülési módot <small>(ez a lista bővülhet)</small>:</label>
				<input name="mode" type="radio" value="del" checked="checked"> Elemek törlése <small>(a második fájl megtalált elemei törlésre kerülnek a fő fájlból)</small>

				<input name="send" type="submit" value="Let's do this">
			</form>
		</div>
	</body>
</html>