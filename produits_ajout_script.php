<html>
<body>
	<?php     

		require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
		$db = connexionBase(); // Appel de la fonction de connexion
		
		$pro_cat_id = $_POST['pro_cat_id'];
		$pro_ref = $_POST['pro_ref'];
		$pro_libelle = $_POST['pro_libelle'];
		$pro_description = $_POST['pro_description'];
		$pro_prix = $_POST['pro_prix'];
		$pro_stock = $_POST['pro_stock'];
		$pro_couleur = $_POST['pro_couleur'];
		$pro_photo = $_POST['pro_photo'];
		$pro_d_ajout = date('Y-m-d');
		$pro_bloque = $_POST['pro_bloque'];
		
		if (is_numeric($pro_cat_id) && $pro_cat_id >= 0 && is_numeric($pro_prix) && $pro_prix >= 0 && is_numeric($pro_stock) && $pro_stock >= 0)
		{		 
			$erreurform = "Location:produits_ajout.php";
			$erreur = 0;
			if (empty($_POST["pro_cat_id"]))
			{       
				$erreurform = str_split($erreurform);
				$seterreur[] = "?erreur2=true";
				$erreurform = array_merge($erreurform, $seterreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
			} 
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
			if (empty($_POST["pro_photo"]))
			{       
				$erreurform = str_split($erreurform);
				$seterreur[] = "?erreur7=true";
				$erreurform = array_merge($erreurform, $seterreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
			} 	
			if ($erreur == 1)
			{
				header($erreurform);
				exit;
			}
			$requete = $db->prepare("INSERT INTO produits (pro_cat_id, pro_ref, pro_libelle, pro_description, pro_prix, pro_stock, pro_couleur, pro_photo, pro_d_ajout, pro_bloque) 
									VALUES(:pro_cat_id, :pro_ref, :pro_libelle, :pro_description, :pro_prix, :pro_stock, :pro_couleur, :pro_photo, :pro_d_ajout, :pro_bloque)");
			
			$requete->bindValue(":pro_cat_id", $pro_cat_id);
			$requete->bindValue(":pro_ref", $pro_ref);
			$requete->bindValue(":pro_libelle", $pro_libelle);
			$requete->bindValue(":pro_description", $pro_description);
			$requete->bindValue(":pro_prix", $pro_prix);
			$requete->bindValue(":pro_stock", $pro_stock);
			$requete->bindValue(":pro_couleur", $pro_couleur);
			$requete->bindValue(":pro_photo", $pro_photo);
			$requete->bindValue(":pro_d_ajout", $pro_d_ajout); 
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