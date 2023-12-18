<?php

require_once("template/login.tpl");

if(!isset($_GET['login']))
	goto end_script;

$error = true;
$account = "";
(file_exists("data/account.txt")) ? $account = file_get_contents("data/account.txt") : '';
if($account == "")
	goto account_empty;


$list_acccount = explode(';', $account);
foreach($list_acccount as $list_acccount)
	{
	$name = explode('-', $list_acccount);
	if(!isset($name[0]) || !isset($name[1]))
		{
		goto account_empty;
		}

	if($name[0] == $_GET['login'] && $name[1] == $_GET['pass'])
		{
		$error = false;
		goto account_empty;		
		}
	}

	
account_empty:
if($error == true)
	{
	?>
	<p>Złe dane przy logowaniu</p>
	<?php
	goto end_script;
	}

$_SESSION['login'] = $_GET['login'];

?>

<p>Zalogowano pomyślnie</p>
<a href="?action=game">Przejdz do Gry</a>
<?php

end_script:
?>