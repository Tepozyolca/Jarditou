<!DOCTYPE HTML>  
<html>
<body>
	<?php     

		require "Fonctions jarditou.php"; // Inclusion de notre bibliothèque de fonctions
		$db = connexionBase(); // Appel de la fonction de connexion
		
		$pro_id = $_POST['pro_id'];
		$suppression = $_POST['SUPPRESSION'];
		
		if($suppression == 1)
		{
			$requete = $db->prepare("DELETE FROM produits WHERE pro_id=:pro_id");
			$requete->bindValue(":pro_id", $pro_id);
			$requete->execute();
			header("Location:liste.php");
		}
		else
			header("Location:detail.php?pro_id=".$pro_id);	
	?>
</body>
</html>