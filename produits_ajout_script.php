<html>
<body>
	<?php     

		require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
		$db = connexionBase(); // Appel de la fonction de connexion
		
		/*$pro_id = 0;
		
		$requete = $db->prepare("SELECT * FROM produits WHERE pro_id>:ID");
		$requete->bindValue(":ID", $pro_id);
		$requete->execute();

		$tableau = $requete->fetchAll();
		
		$pro_id = count($tableau);*/
		$pro_cat_id = $_POST['pro_cat_id'];
		$pro_ref = $_POST['pro_ref'];
		$pro_libelle = $_POST['pro_libelle'];
		$pro_description = $_POST['pro_description'];
		$pro_prix = $_POST['pro_prix'];
		$pro_stock = $_POST['pro_stock'];
		$pro_couleur = $_POST['pro_couleur'];
		$pro_photo = $_POST['pro_photo'];
		$pro_d_ajout = date('d m y');
		$pro_d_modif = date('d m y');
		$pro_bloque = $_POST['pro_bloque'];
		var_dump($pro_cat_id);
		var_dump($pro_ref);
		var_dump($pro_libelle);
		var_dump($pro_description);
		var_dump($pro_prix);
		var_dump($pro_stock);
		var_dump($pro_couleur);
		var_dump($pro_photo);
		var_dump($pro_d_ajout);
		var_dump($pro_d_modif);
		var_dump($pro_bloque);

		
		if (is_numeric($pro_cat_id) && $pro_cat_id >= 0 && is_numeric($pro_prix) && $pro_prix >= 0 && is_numeric($pro_stock) && $pro_stock >= 0)
		{		 
			$erreurform = "Location:produits_ajout.php";
			$erreur = 0;
			if (empty($_POST["pro_cat_id"]))
			{       
				$erreurform = str_split($erreurform);
				$seterreur = array ("?erreur2=true");
				$erreurform = array_merge($erreurform, $erreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
				//header("Location:produits_ajout.php?erreur=2");
				//exit;
			} 
			if (empty($_POST["pro_ref"])) 
			{       
				$erreurform = str_split($erreurform);
				$erreur = array ("?erreur3=true");
				$erreurform = array_merge($erreurform, $erreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
				//header("Location:produits_ajout.php?erreur=3");
				//exit;
			}
			if (empty($_POST["pro_libelle"]))
			{       
				$erreurform = str_split($erreurform);
				$erreur = array ("?erreur4=true");
				$erreurform = array_merge($erreurform, $erreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
				//header("Location:produits_ajout.php?erreur=4");
				//exit;
			} 
			if (empty($_POST["pro_prix"])) 
			{     
				$erreurform = str_split($erreurform);
				$erreur = array ("?erreur5=true");
				$erreurform = array_merge($erreurform, $erreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
				//header("Location:produits_ajout.php?erreur=5");
				//exit;
			}
			if (empty($_POST["pro_stock"])) 
			{      
				$erreurform = str_split($erreurform);
				$erreur = array ("?erreur6=true");
				$erreurform = array_merge($erreurform, $erreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
				//header("Location:produits_ajout.php?erreur=6");
				//exit;
			} 
			if (empty($_POST["pro_photo"]))
			{       
				$erreurform = str_split($erreurform);
				$erreur = array ("?erreur7=true");
				$erreurform = array_merge($erreurform, $erreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
				//header("Location:produits_ajout.php?erreur=7");
				//exit;
			} 	
			
			if ($erreur == 1)
			{
				header($erreurform);
				exit;
			}
			$requete = $db->prepare("INSERT INTO produits (pro_cat_id, pro_ref,pro_libelle, pro_description, pro_prix, pro_stock, pro_couleur, pro_photo, pro_d_ajout, pro_d_modif, pro_bloque) 
						VALUES(pro_cat_id>:Catégorie, pro_ref>:référence, pro_libelle>:libellé, pro_description>:description, pro_prix>:prix, pro_stock>:stock, pro_couleur>:couleur, pro_photo>:photo, pro_d_ajout>:date, pro_d_modif>:Date_modifié, pro_bloque>:bloque)");
			
			//$requete->bindValue(":ID", $pro_id);
			$requete->bindParam(":Catégorie", $pro_cat_id);
			$requete->bindParam(":référence", $pro_ref);
			$requete->bindParam(":libellé", $pro_libelle);
			$requete->bindParam(":description", $pro_description);
			$requete->bindParam(":prix", $pro_prix);
			$requete->bindParam(":stock", $pro_stock);
			$requete->bindParam(":couleur", $pro_couleur);
			$requete->bindParam(":photo", $pro_photo);
			$requete->bindParam(":date", $pro_d_ajout); 
			$requete->bindParam(":Date_modifié", $pro_d_modif);
			$requete->bindParam(":bloque", $pro_bloque);
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