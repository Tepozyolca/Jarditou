<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Atelier PHP N°4 - page de détail</title>
		<?php   
			require "Fonctions jarditou.php"; // Inclusion de notre bibliothèque de fonctions
			$db = connexionBase(); // Appel de la fonction de connexion	
			
			$pro_id = $_GET["pro_id"]; // Récupération de l'identifiant du produit
			
			$requete = "SELECT * FROM produits WHERE pro_id=".$pro_id; //Requète des infos du produit
			$result = $db->query($requete); // Récupération des infos du produit
			$produit = $result->fetch(PDO::FETCH_OBJ);
			
			$pro_cat_id = $produit->pro_cat_id;
			
			$requete2 = "SELECT cat_id, cat_nom FROM categories WHERE cat_id=".$pro_cat_id;
			$requete3 = "SELECT cat_id, cat_nom FROM categories";
			$result2 = $db->query($requete2);
			$result3 = $db->query($requete3);

			// Renvoi de l'enregistrement sous forme d'un objet
			$produit2 = $result2->fetch(PDO::FETCH_OBJ);
		?>

	</head>
	<body>  
			<form action="produits_modif_script.php" method="post">  
				<?php
					echo "<br>ID<br>";
					echo "<input type=\"text\" name=\"pro_id\" value=".$produit->pro_id." ReadOnly>";
					echo "<br>Référence <br>";
					echo "<input type=\"text\" name=\"pro_ref\" value=".$produit->pro_ref.">";
					echo "<br>Catégorie<br>";
				?>
				<select name="pro_cat_id">    
				<?php
					while ($value = $result3->fetch(PDO::FETCH_OBJ))
					{
						if($value->cat_nom == $produit2->cat_nom)
							echo "<option value=".$produit2->cat_id." selected>".$produit2->cat_nom."</option>";
						else
							echo "<option value=".$value->cat_id.">".$value->cat_nom."</option>";
					}
				?>
				</select>
				<?php	
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
					echo "<br>Produit bloqué <br>";
				?>
				<input type="radio" name="pro_bloque" value=1>Oui
				<input type="radio" name="pro_bloque" value=0 checked>Non
				<?php
					echo "<br>Date d'ajout : ".$produit->pro_d_ajout."<br>Date de modification : ".$produit->pro_d_modif."<br>";
					echo "<input type=\"text\" name=\"pro_d_modif\" value=".date("Y-m-d H\:i\:s", time())." hidden>";
				?>
				<input type="submit" value="Envoyer">
			</form>
			<form action="produits_suppr_script.php" method="post">
				<br><br>Supprimer l'article?<br>
				<input type="checkbox" name="SUPPRESSION" value=1>Oui (Cette opération est irréversible!)
				<?php
					echo "<input type=\"text\" name=\"pro_id\" value=".$pro_id." hidden>";
				?>
				<input type="submit" value="Supprimer">
			</form>				
	</body>
</html>