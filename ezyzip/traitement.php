<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    header('Location: connexion.php');
    exit();
}

// Connexion à la base de données (ajustez les paramètres selon votre configuration)
$pdo = new PDO('mysql:host=localhost;dbname=gestion_etudiants', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Traitement du formulaire d'ajout d'étudiant
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous de valider et d'ajouter les informations de l'étudiant dans votre base de données
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $annee_etude = $_POST['annee_etude'];
    $parcours = $_POST['parcours'];
    $id_filiere = $_POST['id_filiere']; // Ajoutez le champ du formulaire correspondant à la filière

    // Insérez l'étudiant avec la filière associée
    $stmt = $pdo->prepare("INSERT INTO etudiant (nom, prenom, sexe, date_naissance, lieu_naissance, adresse, ville, pays, telephone, email, annee_etude, parcours, id_filiere) VALUES (:nom, :prenom, :sexe, :date_naissance, :lieu_naissance, :adresse, :ville, :pays, :telephone, :email, :annee_etude, :parcours, :id_filiere)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':lieu_naissance', $lieu_naissance);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':pays', $pays);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':annee_etude', $annee_etude);
    $stmt->bindParam(':parcours', $parcours);
    $stmt->bindParam(':id_filiere', $id_filiere);
    
    $stmt->execute();

    // Rediriger après l'ajout
    header('Location: liste_etudiants.php');
    exit();
}
?>
