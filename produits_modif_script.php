<html>
<body>
	<?php     

		require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
		$db = connexionBase(); // Appel de la fonction de connexion
		
		$pro_id = $_POST['pro_id'];
		$pro_ref = $_POST['pro_ref'];
		$pro_libelle = $_POST['pro_libelle'];
		$pro_description = $_POST['pro_description'];
		$pro_prix = $_POST['pro_prix'];
		$pro_stock = $_POST['pro_stock'];
		$pro_couleur = $_POST['pro_couleur'];
		$pro_d_ajout = date('Y-m-d');
		$pro_d_modif = $_POST['pro_d_modif'];
		$pro_bloque = $_POST['pro_bloque'];
		
		if (is_numeric($pro_prix) && $pro_prix >= 0 && is_numeric($pro_stock) && $pro_stock >= 0)
		{		 
			$erreurform = "Location:detail.php?pro_id=".$pro_id;
			$erreur = 0;
			if (empty($_POST["pro_ref"])) 
			{       
				$erreurform = str_split($erreurform);
				$seterreur[] = "?erreur3=true";
				$erreurform = array_merge($erreurform, $seterreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
			}
			if (empty($_POST["pro_libelle"]))
			{       
				$erreurform = str_split($erreurform);
				$seterreur[] = "?erreur4=true";
				$erreurform = array_merge($erreurform, $seterreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
			} 
			if (empty($_POST["pro_prix"])) 
			{     
				$erreurform = str_split($erreurform);
				$seterreur[] = "?erreur5=true";
				$erreurform = array_merge($erreurform, $seterreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
			}
			if (empty($_POST["pro_stock"])) 
			{      
				$erreurform = str_split($erreurform);
				$seterreur[] = "?erreur6=true";
				$erreurform = array_merge($erreurform, $seterreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
			} 
			if ($erreur == 1)
			{
				header($erreurform);
				exit;
			}
			$requete = $db->prepare("UPDATE produits SET pro_ref=:pro_ref, pro_libelle=:pro_libelle, pro_description=:pro_description, pro_prix=:pro_prix, pro_stock=:pro_stock, pro_couleur=:pro_couleur, pro_d_modif=:pro_d_modif, pro_bloque=:pro_bloque
									WHERE pro_id =:pro_id");
			
			$requete->bindValue(":pro_id", $pro_id);
			$requete->bindValue(":pro_ref", $pro_ref);
			$requete->bindValue(":pro_libelle", $pro_libelle);
			$requete->bindValue(":pro_description", $pro_description);
			$requete->bindValue(":pro_prix", $pro_prix);
			$requete->bindValue(":pro_stock", $pro_stock);
			$requete->bindValue(":pro_couleur", $pro_couleur);
			$requete->bindValue(":pro_d_modif", $pro_d_modif); 
			$requete->bindValue(":pro_bloque", $pro_bloque);
			$requete->execute();
			header("Location:liste.php");
		}
		else
		{
			header("Location:produits_ajout.php?erreur=10");
			exit;
		}
	?>
</body>
</html>