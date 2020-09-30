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
		$pro_d_ajout = date('Y-m-d');
		$pro_bloque = $_POST['pro_bloque'];
		
		if ($pro_cat_id > 0 && is_numeric($pro_prix) && $pro_prix >= 0 && is_numeric($pro_stock) && $pro_stock >= 0)
		{		 
			$erreurform = "Location:produits_ajout.php?erreur=false";
			$erreur = 0;
			if (empty($_POST["pro_cat_id"]))
			{       
				$erreurform = str_split($erreurform);
				$seterreur[] = "&erreur2=true";
				$erreurform = array_merge($erreurform, $seterreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
			} 
			if (empty($_POST["pro_ref"])) 
			{       
				$erreurform = str_split($erreurform);
				$seterreur[] = "&erreur3=true";
				$erreurform = array_merge($erreurform, $seterreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
			}
			if (empty($_POST["pro_libelle"]))
			{       
				$erreurform = str_split($erreurform);
				$seterreur[] = "&erreur4=true";
				$erreurform = array_merge($erreurform, $seterreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
			} 
			if (empty($_POST["pro_prix"])) 
			{     
				$erreurform = str_split($erreurform);
				$seterreur[] = "&erreur5=true";
				$erreurform = array_merge($erreurform, $seterreur);
				$erreurform = implode ($erreurform);
				$erreur = 1;
			}
			if (empty($_POST["pro_stock"])) 
			{      
				if($_POST[pro_stock] != 0)
				{
					$erreurform = str_split($erreurform);
					$seterreur[] = "&erreur6=true";
					$erreurform = array_merge($erreurform, $seterreur);
					$erreurform = implode ($erreurform);
					$erreur = 1;
				}
			} 

			// On met les types autorisés dans un tableau (ici pour une image)
			$aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

			// On extrait le type du fichier via l'extension FILE_INFO 
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimetype = finfo_file($finfo, $_FILES["fichier"]["tmp_name"]);
			finfo_close($finfo);

			if (in_array($mimetype, $aMimeTypes))
			{
				/* Le type est parmi ceux autorisés, donc OK, on va pouvoir 
				déplacer et renommer le fichier */
				$pro_photo = substr(strrchr($_FILES["fichier"]["name"], "."), 1);;
			} 
			else 
			{
					// Le type n'est pas autorisé, donc ERREUR
					$erreurform = str_split($erreurform);
					$seterreur[] = "&erreur8=true";
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
			$requete = "SELECT pro_id FROM produits WHERE pro_cat_id =".$pro_cat_id." && pro_ref =\"".$pro_ref."\"";
			$result = $db->query($requete);
			$nomImage = $result->fetch(PDO::FETCH_OBJ);
			move_uploaded_file($_FILES["fichier"]["tmp_name"], "images/".$nomImage->pro_id.".".$pro_photo);
			header("Location:liste.php");
		}
		else
		{
			header("Location:produits_ajout.php?erreur9=true");
			exit;
		}
	?>
</body>
</html>