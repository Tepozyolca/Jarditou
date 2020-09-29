<html>
<body>
	<?php
		require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
		$db = connexionBase(); // Appel de la fonction de connexion
	?>
	
	<form action="produits_ajout_script.php" method="post">  
		<?php
			echo "<br>Catégorie ID<br>";
		?>
		<input type="text" name="pro_cat_id">    
		<?php
			echo "<br>Référence <br>";
		?>		
		<input type="text" maxlength=10 name="pro_ref">
		<?php
			echo "<br>Libellé <br>";
		?>
		<input type="text" maxlength=200 name="pro_libelle">
		<?php
			echo "<br>Description <br>";
		?>
		<input type="text" maxlength=1000 name="pro_description">
		<?php
			echo "<br>Prix <br>";
		?>
		<input type="text" name="pro_prix">
		<?php
			echo "<br>Stock <br>";
		?>
		<input type="text" maxlength=30 name="pro_stock">
		<?php
			echo "<br>Couleur <br>";
		?>
		<input type="text" maxlength=4 name="pro_couleur">
		<?php
			echo "<br>Extention photo <br>";
		?>
		<input type="text" name="pro_photo">
		<?php
			echo "<br>Disponible? <br>";
		?>
		<input type="checkbox" name="pro_bloque" value='1'>Non<br>
		<?php
			echo "<br>";
		?>
		<input type="submit" value="Envoyer">
	</form>
</body>
</html>