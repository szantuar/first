<?php

switch($_GET['stat'])
	{
	case "STR":
		$xml->stats->STR += 1;
		$xml->stats->ADD -= 1;
	break;
	case "VIT":
		$xml->stats->VIT += 1;
		$xml->stats->ADD -= 1;
		$xml->HP->now += 2;
		$xml->HP->max += 2;
	break;
	case "AGA":
		$xml->stats->AGA += 1;
		$xml->stats->ADD -= 1;
	break;
	case "INT":
		$xml->stats->INT += 1;
		$xml->stats->ADD -= 1;
		$xml->mana->now += 2;
		$xml->mana->max += 2;
	break;
	}

file_put_contents("data/".$_SESSION['login'].".xml", $xml->asXML());

?>