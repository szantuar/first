<?php

require_once("template/register.tpl");

if(!isset($_GET['rlogin']))
	goto end_script;

$error = false;
if($_GET['rlogin'] == null || preg_match('/[^0-9A-Za-z]/',$_GET['rlogin']) == true || (strlen($_GET['rlogin']) < 4 || strlen($_GET['rlogin']) > 12))
	{
	?>
	<p>Proszę użyć w nazwie jedynie znaki a-z oraz 0-9, login powinien miec od 4 do 11 znaków</p>
	<?php
	$error = true;
	}

if($_GET['pass1'] == null || preg_match('/[^0-9A-Za-z]/',$_GET['pass1']) == true || (strlen($_GET['pass1']) < 4 || strlen($_GET['pass1']) > 9))
	{
	?>
	<p>Proszę użyć w haśle jedynie znaki a-z oraz 0-9, login powinien miec od 5 do 8 znaków</p>
	<?php
	$error = true;
	}	

if($_GET['pass2'] != $_GET['pass1'])
	{
	?>
	<p>Hasła nie sa takie same</p>
	<?php
	$error = true;
	}

if($error == false)
	{
	$account = "";
	(file_exists("data/account.txt")) ? $account = file_get_contents("data/account.txt") : '';
	if($account == "")
		goto account_empty;
	
	$list_acccount = explode(';', $account);
	foreach($list_acccount as $list_acccount)
		{
		$name = explode('-', $list_acccount);
		if($name[0] == $_GET['rlogin'])
			{
			?>
			<p>Nazwa użytkownika już zajeta</p>
			<?php
			goto end_script;
			}
		}
	
	account_empty:
	$account .= $_GET['rlogin'] . '-' . $_GET['pass1'] . ';';
	if(file_put_contents("data/account.txt",$account))
		{
		$dataXML = file_get_contents("data/account.xml");
		$xml = new SimpleXMLElement($dataXML);
	
		$xml->name[0] = $_GET['rlogin'];
		file_put_contents("data/".$_GET['rlogin'].".xml", $xml->asXML());
		
		?>
		<p>Konto zostało utworzone pomyślnie</p>
		<p><a href="?action=login">Logowanie</a></p>
		<?php		
		}
	
	}
	
end_script:
?>