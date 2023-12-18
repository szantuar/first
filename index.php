<?php

(session_id() == '') ? session_start() : '';

if(!isset($_SESSION['login']))
	{
	//not login
	$menu_link = "template/menu1.tpl";
	$panel_link = "action/login.php";
	}
else
	{
	// login
	$menu_link = "template/menu2.tpl";
	$panel_link = "action/game.php";
	}

(isset($_GET['rlogin'])) ? $panel_link = "action/register.php" : '';
(isset($_GET['stat'])) ? $_GET['action'] = "character" : "";
(isset($_GET['heal'])) ? $_GET['action'] = "character" : "";
(isset($_GET['go'])) ? $_GET['action'] = "maps" : "";



if(isset($_GET['action']))
	{
	($_GET['action'] == "login") ? $panel_link = "action/login.php" : '';
	($_GET['action'] == "register") ? $panel_link = "action/register.php" : '';
	($_GET['action'] == "game") ? $panel_link = "action/game.php" : '';
	($_GET['action'] == "logout") ? $panel_link = "action/logout.php" : '';
	($_GET['action'] == "character") ? $panel_link = "action/character.php" : '';
	($_GET['action'] == "maps") ? $panel_link = "action/maps.php" : '';
	}


?>

<html>
	<head>
		<title>Game</title>
		<meta charset="utf8"/>
		<link href="css/game.css" rel="stylesheet" />
	</head>
	<body>
		<div class="menu">
		<?php require($menu_link); ?>
		</div>
		<div class="content">
			<?php require($panel_link); ?>		
		</div>
		<footer class="stopka">
					&copy; Game
		</footer>
	</body>
</html>