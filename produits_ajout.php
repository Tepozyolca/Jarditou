<!DOCTYPE HTML>  
<html>
<body>
	<?php
		require "Fonctions jarditou.php"; // Inclusion de notre bibliothèque de fonctions
		$db = connexionBase(); // Appel de la fonction de connexion
		$requete = "SELECT cat_id, cat_nom FROM categories";
		$result = $db->query($requete);
	?>
	
	<form action="produits_ajout_script.php" method="post" enctype="multipart/form-data">  
		<?php
			echo "<br>Type de produit<br>";
		?>
		<select name="pro_cat_id">    
		<?php
			$cat_id = 0;
			while ($value = $result->fetch(PDO::FETCH_OBJ))
			{
				$cat_id++;
				if($cat_id == 1)
					echo "<option value=\"$value->cat_id\" selected>".$value->cat_nom."</option>";
				else
					echo "<option value=\"$value->cat_id\">".$value->cat_nom."</option>";
			}
		?>
		</select>
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
			echo "<br>Photo?<br>";
		?>
		<input type="file" name="fichier">
		<?php
			echo "<br>Disponible? <br>";
		?>
		<input type="radio" name="pro_bloque" value='1' checked>Oui<br>
		<input type="radio" name="pro_bloque" value='0'>Non<br>
		<?php
			echo "<br>";
		?>
		<input type="submit" value="Envoyer">
	</form>
</body>
</html>