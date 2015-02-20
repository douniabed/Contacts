<?php
// Créer la base de donnée avec les champs
// id, nom, prenom, email, adress ville, cp, phone

// Créer une connexion à la base de données "contact"

include ('db.php');



// Contrôler les champs obligatoires "nom, prenom, email"

	$fields = array(
		'nom' => array(
			'type' => 'text',
			'name' => 'nom',
			'label' => 'Nom',
			'size' => '20',
			'required' => true
		),
		'prenom'  => array(
			'type' => 'text',
			'name' => 'prenom',
			'label' => 'Prenom',
			'size' => '20',
			'required' => true
		),
		'email'      => array(
			'type' => 'email',
			'label' => 'Email',
			'name' => 'email',
			'size' => '40',
			'required' => true
		),
		'adress' => array(
			'type' => 'text',
			'name' => "adresse",
			'label' => 'Adresse',
			'size' => '60',
			'required' => false
		),
		'ville' => array(
			'type' => 'text',
			'name' => "ville",
			'label' => 'Ville',
			'size' => '10',
			'required' => false
		),
		'cp' => array(
			'type' => 'text',
			'name' => "code postale",
			'label' => 'Code postal',
			'size' => '10',
			'required' => false
		),
		'phone' => array(
			'type' => 'text',
			'name' => "telephone",
			'label' => 'Telephone',
			'size' => '20',
			'required' => false
		),
	);


foreach($fields as $key => $value) {
	// On initialise le nom du champ à vide
	$$key = '';
}

if (!empty($_POST)) {
	// On initialise une variable en indiquant s'il y'a une error dans le formulaire
	$error = false;
	// On initialise le tableau d'errors
	$errors = array();

		foreach($fields as $key => $value) {
			// On initialise le nom du champ à vide
			$$key = '';
			if ($value['required'] && empty($_POST[$value['name']])) {
				$error =true;
				$errors[$key] ="Ce champ est obligatoire !" ;
			}
			else if(!empty($_POST[$value['name']])) {
				$$key =  strip_tags($_POST[$value['name']]);
			}
		}
		if ($error === false) {
			// Créer une requête d'insertion PDO avec les données du formulaire
			$query=$db-> prepare('INSERT INTO contact (nom, prenom, email, adress, ville, cp, phone) VALUES (:nom, :prenom, :email, :adress, :ville, :cp, :phone)');
			foreach ($fields as $key => $value) {
				$query->bindValue($key, $$key,PDO::PARAM_STR);
			}
			$query->execute();
			$new_contact = $db->lastInsertId();

		header ('location:contacts.php');
		exit();
		}
	}
?>


<!Doctype html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Formulaire de contact</title>
	</head>
	<body>

		<h1>Formulaire de contact</h1>
		<form action="form_contact.php" method="POST">
			<?php foreach ($fields as $key => $value) {
				echo $value['label']?> <span><?= $required = $value['required'] ? '*' : '' ?> </span> : <input type="<?=$value['label']?>" size="<?=$value['size']?>" name="<?=$value['name']?>" value = "<?= $$key?>"><br><br>
				<p><?= isset($errors[$key]) ? $errors[$key] : '';?> </p>
			<?php } ?>

			<p> * : Champ obligatoire.</p>

			<input type="submit" value="Envoyer">

		</form>

	</body>
</html>