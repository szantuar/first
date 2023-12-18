<?php

?>

<h1>Rejestracja: </h1>
<form class="log_panel" method="GET" action="index.php">
	<div class="input">
		<label for="rlogin">Login: </label>
		<input type="text" name="rlogin" id="rlogin" value="<?= ($_GET['rlogin']) ?? ""; ?>"/>
	</div>
	<div class="input">
		<label for="pass1">Password: </label>
		<input type="password" name="pass1" id="pass1" value="<?= ($_GET['pass1']) ?? ""; ?>"/>
	</div>
	<div class="input">
		<label for="pass2">Re:Password: </label>
		<input type="password" name="pass2" id="pass2" value="<?= ($_GET['pass2']) ?? ""; ?>"/>
	</div>
	<div>
		<input type="submit" value="Rejestruj"/>
	</div>
</form>