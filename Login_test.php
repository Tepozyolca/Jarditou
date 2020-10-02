<!DOCTYPE HTML>  
<html>
	<head>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	
	<body>  
		<?php
			require "Fonctions jarditou.php"; // Inclusion de notre bibliothèque de fonctions
			$loginUtilisateur = $motdepasse = "";
			$loginErreur = "";
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{	
				if (empty($_POST["loginUtilisateur"]))
				{
					$loginErreur = "Veuillez renseigner un nom d'utilisateur";
				}
				else
				{
					$loginUtilisateur=$_POST["loginUtilisateur"];
					$db = connexionBase();
					$requete = "SELECT user_login, user_motdepasse FROM users WHERE user_login = ".$loginUtilisateur;
					$result = $db->query($requete);
					if ($result->rowCount() == 0) 
					{	
						// L'utilisateur n'existe pas dans la base de donnée
						$loginErreur="L'utilisateur n'existe pas";
					}
					else
						$data = $result->fetch(PDO::FETCH_OBJ);
						$motdepasse_hash= $data->user_motdepasse;
						$motdepasse=$_POST["motdepasse"];
						if(password_verify($motdepasse, $motdepasse_hash))
							echo "Connexion!";
						else
							$loginErreur="Nom d'utilisateur ou mot de passe erroné";
				}
			}
		?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<?php
				echo "<br>Nom d'utilisateur:<br>";
			?>
			<input type="text" maxlength=50 name="loginUtilisateur" value="<?php echo $loginUtilisateur; ?>"> <span class="error">* <?php echo $loginErreur;?></span>
			<?php
				echo "<br>Mot de passe:<br>";
			?>
			<input type="text" maxlength=20 name="motdepasse" value="<?php echo $motdepasse; ?>"> <br><br>
			<input type="submit" name="Envoyer">

	</body>
</html>