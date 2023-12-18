<?php

if(isset($_SESSION['login']))
	{
	unset($_SESSION['login']);
	?>
	
	<p>Pomyślnie wylogowano</p>
	
	<a href="?action=login">Przejdz to startu</a>
	
	<?php
	}

?>