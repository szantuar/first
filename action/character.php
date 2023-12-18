<?php
function stats($stat_qty, $stat, $add_qty)
	{
	echo $stat_qty;
	if((int)$add_qty > 0)
		{	
		?>
		<a href="?stat=<?= $stat ?>">ADD</a>
		<?php
		}
	}

if(isset($_SESSION['login']))
	{
	if(!file_exists("data/".$_SESSION['login'].".xml"))
		{
		?>
		<p>Wystapił problem z kontem, proszę się skontakowac z administratorem</p>
		<?php
		goto end_script;
		}
	
	$dataXML = file_get_contents("data/".$_SESSION['login'].".xml");
	$xml = new SimpleXMLElement($dataXML);
	
	
	if(isset($_GET['heal']))
		{
		$xml->dead = 0;
		$xml->HP->now = $xml->HP->max;
		file_put_contents("data/".$_SESSION['login'].".xml", $xml->asXML());
		}
	
	if(isset($_GET['stat']))
		{
		if($xml->stats->ADD < 1)
			{
			?>
			<p> Brak wystarczajacej ilości wolnych punktów</p>
			<?php
			}
		else
			{
			//add statystyka
			require("action/add.php");
			}
		}
	
	require("data/exp_table.php");
	?>
	<h1>Informacje o postaci:</h1>
		<div>
			<p>Nazwa: <?= $xml->name; ?></p>
			<p>Level: <?= $xml->lvl; ?></p>
			<p>Experience: <?= $xml->exp . "/" . $exp_table[(int)$xml->lvl-1]; ?></p>
			<h4>Mapa: </h4>
			<p>X: <?= $xml->maps->x; ?>  Y: <?= $xml->maps->y; ?></p>
		</div>
		
	<h3>Statystyki:</h3>
		<div class="stat">
			<p>HP: <?= $xml->HP->now . "/" . $xml->HP->max; ?> 
				<?php
				if($xml->dead == 1)
					{
					?>
					<a href="?heal=true">HEAL</a>
					<?php
					}
				?>
			
			</p>
			<p>Mana: <?= $xml->mana->now . "/" . $xml->mana->max; ?></p>
			<p>Strength: <?php stats($xml->stats->STR, "STR", $xml->stats->ADD); ?></p>
			<p>Vitality: <?php stats($xml->stats->VIT, "VIT", $xml->stats->ADD); ?></p>
			<p>Agility: <?php stats($xml->stats->AGA, "AGA", $xml->stats->ADD); ?></p>
			<p>Inteligence: <?php stats($xml->stats->INT, "INT", $xml->stats->ADD);?></p>
			<p>Wolne punkty: <?= $xml->stats->ADD; ?></p>
		</div>
	
	<?php
	}

end_script:
?>
