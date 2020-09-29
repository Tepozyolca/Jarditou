<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Atelier PHP N°4 - page de détail</title>
		<?php   
			require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions

			$db = connexionBase(); // Appel de la fonction de connexion	
			$pro_id = $_GET["pro_id"];
			$requete = "SELECT * FROM produits WHERE pro_id=".$pro_id;

			$result = $db->query($requete);

			// Renvoi de l'enregistrement sous forme d'un objet
			$produit = $result->fetch(PDO::FETCH_OBJ);
		?>

	</head>
	<body>  
			<form action="produits_modif_script.php" method="post">  
				<?php
					echo "<br>ID<br>";
					echo "<input type=\"text\" name=\"pro_id\" value=".$produit->pro_id." ReadOnly>";
					echo "<br>Référence <br>";
					echo "<input type=\"text\" name=\"pro_ref\" value=".$produit->pro_ref.">";
					echo "<br>Libellé <br>";
					echo "<input type=\"text\" name=\"pro_libelle\" value=".$produit->pro_libelle.">";
					echo "<br>Description <br>";
					echo "<input type=\"text\" name=\"pro_description\" value=".$produit->pro_description.">";
					echo "<br>Prix <br>";
					echo "<input type=\"text\" name=\"pro_prix\" value=".$produit->pro_prix.">";
					echo "<br>Stock <br>";
					echo "<input type=\"text\" name=\"pro_stock\" value=".$produit->pro_stock.">";
					echo "<br>Couleur <br>";
					echo "<input type=\"text\" name=\"pro_couleur\" value=".$produit->pro_couleur.">";
					echo "<br>Produit bloqué <br>"
				?>
			<input type="radio" name="pro_bloque" value=1>Oui
			<input type="radio" name="pro_bloque" value=0 checked>Non
				<?php
					echo "<br>Date d'ajout : ".$produit->pro_d_ajout."<br>Date de modification : ".$produit->pro_d_modif."<br>";
					echo "<input type=\"text\" name=\"pro_d_modif\" value=".date("Y-m-d H\:i\:s", time())." hidden>";
				?>
			<input type="submit" value="Envoyer">
	</body>
</html>