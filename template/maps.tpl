<?php

?>

<div class="map">
	<div class="buttons">
		<p><a href="?go=up">UP</a></p>
		<p><a href="?go=left">LEFT</a><a href="?go=right">RIGHT</a></p>
		<p><a href="?go=down">DOWN</a></p>
	</div>
<?php
	for($i=0; $i<=9; $i++)
		{
		?>
		<p>
		<?php
		for($j=0; $j<=9; $j++)
			{
			?>
			<span>
			<?php
			
			if($i == $xml->maps->x && $j == $xml->maps->y)
				{
				echo "<img src='img/char.png'>";
				}
			else
				{
				echo ($maps[$i][$j] == 1) ? "<img src='img/rat.png'>" : "";
				echo ($maps[$i][$j] == 2) ? "<img src='img/big_rat.png'>" : "";
				echo ($maps[$i][$j] == 3) ? "<img src='img/spider.png'>" : "";
				}
			
			?>
			</span>
			<?php
			}
		?>
		</p>
		<?php
		}
?>


</div>