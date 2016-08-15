<!DOCTYPE html>
<?php
	if(!isset($_body)) {
		$_body = "[WARN] Body not overridden!";
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FakeBook</title>
		<link rel="stylesheet" href="./bin/style.css">
	</head>
	<body>
		<header><h2>FakeBook</h2></header>
		<main>
			<?php echo $_body; ?>
		</main>
		<footer><h4>Team Better Than Awesome Sauce and Team Z, &copy;</h4></footer>
	</body>
</html>
