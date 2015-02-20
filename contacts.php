<?php

// Créer une connexion à la base de données "contact"
include ('db.php');

$query=$db->query('SELECT nom, prenom, email, adress,cp,  ville, phone  FROM contact');
$contacts = $query->fetchAll();

?>

<!Doctype html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Tableau des contacts</title>
	</head>
	<body>
		<h1>Les contacts</h1>
		<table border="1" cellpadding="10">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Email</th>
					<th>Adresse</th>
					<th>CP</th>
					<th>Ville</th>
					<th>Phone</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($contacts as $contact){?>
					<tr>
						<?php foreach($contact as $value){
							echo "<td> $value </td>";
						} ?>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<a href ="form_contact.php"> Retour au formulaire de contact</a>
	</body>
</html>
