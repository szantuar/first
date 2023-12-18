<?php

?>

<h1>Logowanie: </h1>
<form class="log_panel" method="GET" action="index.php">
	<div class="input">
		<label for="login">Login: </label>
		<input type="text" name="login" id="login" value="<?= ($_GET['login']) ?? ""; ?>"/>
	</div>
	<div class="input">
		<label for="pass">Password: </label>
		<input type="password" name="pass" id="pass" value=""/>
	</div>	
	<div>
		<input type="submit" value="Zaloguj"/>
	</div>
</form>