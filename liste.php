<!DOCTYPE html>
<html lang="fr">
	<head>
	<meta charset="UTF-8">
	<title>Atelier PHP N°4 - Affichage de la liste</title>
	<h1>Liste des produits</h1>
	</head>
<body> 
	<div class="container">
		<?php
			require "Fonctions jarditou.php"; // Inclusion de notre bibliothèque de fonctions
			$db = connexionBase(); // Appel de la fonction de connexion
			$requete = "SELECT pro_id, pro_cat_id, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_photo, pro_bloque FROM produits ORDER BY pro_d_ajout DESC";
			$result = $db->query($requete);

			if (!$result) 
			{
				$tableauErreurs = $db->errorInfo();
				echo $tableauErreur[2]; 
				die("Erreur dans la requête");
			}

			if ($result->rowCount() == 0) 
			{
				// Pas d'enregistrement
				die("La table est vide");
			}

			echo "<table>";
			echo "<th>";
			echo "<tr>";
			echo "<td></td> <td>ID</td> <td>Référence</td> <td>Libellé</td> <td>Prix</td> <td>Stock</td> <td>Couleur</td> <td>Ajout</td> <td>Modif</td> <td>Bloqué</td>";
			echo "</tr>";
			echo "</th>";
			
			while ($row = $result->fetch(PDO::FETCH_OBJ))
			{
				echo "<tr>";
				if(is_file("images/".$row->pro_id.".".$row->pro_photo))
					echo "<td><img src=\"images/".$row->pro_id.".".$row->pro_photo."\"";
				else
					echo "<td>".$row->pro_photo."</td>";
				echo "<td>".$row->pro_id."</td>";
				echo "<td>".$row->pro_ref."</td>";
				echo "<td><a href=detail.php?pro_id=".$row->pro_id.">".$row->pro_libelle."</a>";
				echo "<td>".$row->pro_prix."</td>";
				echo "<td>".$row->pro_stock."</td>";
				echo "<td>".$row->pro_couleur."</td>";
				echo "<td>".$row->pro_d_ajout."</td>";
				echo "<td>".$row->pro_d_modif."</td>";
				echo "<td>".$row->pro_bloque."</td>";
				echo "</tr>";
			}
			echo "</table>"; 
		?>
	</body>
</html> 