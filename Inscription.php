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
			$nomErreur = $mailErreur = $motdepasseErreur = $robotErreur = $loginErreur = "";
			$nom = $prenom = $mail = $motdepasse = $confirmation = $loginUtilisateur = $robot = "";
			$verificationFormulaire = 1;
			

			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{	
				if (empty($_POST["loginUtilisateur"]))
				{
					$loginErreur = "Veuillez renseigner un nom d'utilisateur";
					$verificationFormulaire = 0;
				}
				else
				{
					$loginUtilisateur = test_input($_POST["loginUtilisateur"]);
					// Vérification du nom d'utilisateur
					if (!preg_match("/^[a-zA-Z0-9-' ]*$/",$loginUtilisateur))
						{
							$loginErreur = "Seul les lettres, chiffres et espaces sont autorisés";
							$verificationFormulaire = 0;
						}
				}
				
				if (empty($_POST["mail"])) 
				{
					$mailErreur = "L'adresse mail est requise";
					$verificationFormulaire = 0;
				} 
				else 
				{
					$mail = test_input($_POST["mail"]);
					// Vérification de l'adresse mail
					if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
					{
						$mailErreur = "Format d'adresse mail invalide";
						$verificationFormulaire = 0;
					}
				}
				
				if (empty($_POST["nom"]) || (empty($_POST["prenom"]))) 
				{
					$nomErreur = "Veuillez renseigner votre nom et prénom";
					$verificationFormulaire = 0;
				} 
				else 
				{
					$nom = test_input($_POST["nom"]);
					$prenom =  test_input($_POST["prenom"]);
					// Vérification du nom et prénom
					if (!preg_match("/^[a-zA-Z-' ]*$/",$nom)) 
					{
						if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom))
						{
							$nomErreur = "Seul les lettres et espaces sont autorisés";
							$verificationFormulaire = 0;
						}
					}
				}
				
				$robot = $_POST["robot"];
				if($robot == "1")
				{
					$robotErreur="Arrière, tas d'ferraille!";
					$verificationFormulaire = 0;
				}
				
				$motdepasse = $_POST["motdepasse"];
				$confirmation = $_POST["confirmation"];
				
				if($motdepasse == $confirmation)
				{
					$length = strlen($motdepasse);
					if($length >= 8)
					{	
						if($verificationFormulaire == 1)
						{
							$motdepasse_hash = password_hash($motdepasse, PASSWORD_DEFAULT);
							$db = connexionBase(); 
							$requete = $db->prepare ("INSERT INTO users (user_login, user_nom, user_prenom, user_mail, user_motdepasse, Dateinscription)
													  VALUES (:user_login, :user_nom, :user_prenom, :user_mail, :user_motdepasse, :Dateinscription)");
							$requete->bindValue(":user_login", $loginUtilisateur);
							$requete->bindValue(":user_nom", $nom);
							$requete->bindValue(":user_prenom", $prenom);
							$requete->bindValue(":user_mail", $mail);
							$requete->bindValue(":user_motdepasse", $motdepasse_hash);
							$dateInscription = date("y-m-d");
							$requete->bindValue(":Dateinscription", $dateInscription);
							$requete->execute();
							header("Location:Accueil jarditou.html");
						}
					}
					else
					{
						$motdepasseErreur="Mot de passe trop court!";
					}
				}
				else
				{
					$motdepasseErreur="Veuillez vérifier votre mot de passe";
				}
			}
		?>
		<h2>Formulaire d'inscription</h2>
		<p><span class="error">* Champ requis</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<?php
				echo "Veuillez renseigner vos identifiants pour vous inscrire.<br><br>"; 
				echo "Adresse mail:<br>";
			?>
			<input type="text" maxlength=50 name="mail" value="<?php echo $mail; ?>"> <span class="error">* <?php echo $mailErreur;?></span>
			<?php
				echo "<br>Nom d'utilisateur:<br>";
			?>
			<input type="text" maxlength=50 name="loginUtilisateur" value="<?php echo $loginUtilisateur; ?>"> <span class="error">* <?php echo $loginErreur;?></span>
			<?php
				echo "<br>Nom:<br>";
			?>
			<input type="text" maxlength=20 name="nom" value="<?php echo $nom; ?>"> <span class="error">* <?php echo $nomErreur;?></span>
			<?php
				echo "<br>Prenom:<br>";
			?>
			<input type="text" maxlength=20 name="prenom" value="<?php echo $prenom; ?>"> <span class="error">*</span>
			<?php
				echo "<br>Mot de passe:<br>";
			?>
			<input type="password" maxlength=20 name="motdepasse" value="<?php echo $motdepasse; ?>"> <span class="error">* <?php echo $motdepasseErreur;?></span>
			<?php
				echo "<br>Confirmer votre mot de passe:<br>";
			?>
			<input type="password" maxlength=20 name="confirmation" value="<?php echo $confirmation; ?>"> <span class="error">*</span>
			<?php
				echo "<br><br>Êtes vous un robot?<br>";
			?>
			<input type="radio" name="robot" value="1" checked>Oui
			<input type="radio" name="robot" value="0">Non <span class="error">* <?php echo $robotErreur;?></span><br>
			<br><br>

		<input type="submit" name="Envoyer">
		</form>
		

	</body>
</html>