<?php

if(!isset($_SESSION['login']))
	goto end_script;

$dataXML = file_get_contents("data/".$_SESSION['login'].".xml");
$xml = new SimpleXMLElement($dataXML);

if($xml->dead == 1)
	{
	?>
	<p>Twoja postać nieżyje.</p>
	<?php
	goto end_script;
	}

require("data/maps_data.php");

$str = "";
$_SESSION['end_fight'] = false;

if(isset($_GET['go']))
	{
	// x pion, y - poziom
	$go = false;
	
	switch($_GET['go'])
		{
		case "up":
			if(isset($maps[(int)$xml->maps->x - 1][(int)$xml->maps->y]))
				{
				$xml->maps->x -= 1;
				$go = true;
				}
		break;
		case "down":
			if(isset($maps[(int)$xml->maps->x + 1][(int)$xml->maps->y]))
				{
				$xml->maps->x += 1;
				$go = true;
				}
		break;
		case "left":
			if(isset($maps[(int)$xml->maps->x][(int)$xml->maps->y-1]))
				{
				$xml->maps->y -= 1;
				$go = true;
				}
		break;
		case "right":
			if(isset($maps[(int)$xml->maps->x][(int)$xml->maps->y+1]))
				{
				$xml->maps->y += 1;
				$go = true;
				}
		break;
		}
		
	if($go == true)
		{
		$field = $maps[(int)$xml->maps->x][(int)$xml->maps->y];
		if($field != 0)
			{
			require("data/monster/monster_list.php");
			$dataXML = file_get_contents("data/monster/".$monster_list[$field][1]);
			$monster = new SimpleXMLElement($dataXML);
		
			$character_def = (float)((int)$xml->stats->STR)/4 + (float)((int)$xml->stats->VIT)/3;
			$character_atk = (float)((int)$xml->stats->STR)/4 + (float)((int)$xml->stats->AGA)/3;
			$character_hp = (float)$xml->HP->now;
			
			$monster_def = (float)((int)$monster->stats->STR)/4 + (float)((int)$monster->stats->VIT)/3;
			$monster_atk = (float)((int)$monster->stats->STR)/4 + (float)((int)$monster->stats->AGA)/3;
			$monster_hp = (float)$monster->HP->now;
					
			do{
				$atak = (float)($character_atk - $monster_def);			
				($atak <= 0) ? $atak = 1 : "";				
				$monster_hp -= $atak;		
				$str .= "<p class='damage'>Zadałeś " . round($atak,2) . " obrażeń.</p>";
				//$str .= "<p>Monster zostało HP " . $monster_hp . " .</p>";
				
				if($monster_hp <= 0)
					{
					$xml->HP->now = (int)$character_hp;					
					require("data/exp_table.php");
					
					$xml->exp += $monster->exp;
					
					$str .= "<p>Potwór pokonany.</p>";
					if($xml->exp >= $exp_table[(int)$xml->lvl - 1])
						{
							
						$exp = (int)$xml->exp - $exp_table[(int)$xml->lvl-1];
						
						($exp < 0) ? $xml->exp = 0 : $xml->exp = $exp;
						$xml->lvl += 1;				
						$xml->stats->ADD += 5;
						$xml->HP->now = (int)$xml->HP->max;
						$str .= "<p>Awansowałeś na : " . $xml->lvl . " LVL.</p>";
						}
						
					$_SESSION['end_fight'] = true;
					
					goto dead_monster;
					}
				
				
				$atak = (float)($monster_atk - $character_def);
				($atak <= 0) ? $atak = 1 : "";			
				$character_hp -= $atak;
				$str .= "<p class='receive'>Otrzymałeś " . round($atak,2) . " obrażeń.</p>";
				//$str .= "<p>Postać zostało HP " . $character_hp . " .</p>";
				
				if($character_hp <= 0)
					{
					$xml->HP->now = 0;
					$xml->dead = 1;
					$str .= "<p>Zginałeś</p>";
					echo $str;
					file_put_contents("data/".$_SESSION['login'].".xml", $xml->asXML());
					goto end_script;
					}
			
				dead_monster:
				}while($_SESSION['end_fight'] == false);
			}
		
		file_put_contents("data/".$_SESSION['login'].".xml", $xml->asXML());
		}
	}


require("template/maps.tpl");

if($_SESSION['end_fight'] == true)
	{
	echo $str;
	}

end_script:
?>