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

// Récupérer la liste des étudiants depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM etudiant");
$stmt->execute();
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <style>
        
        body {
        background-color: #f0f5f9; /* Nouvelle couleur de fond */
    }

    .container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 50px;
    }

    h2 {
        color: #2c3e50; /* Nouvelle couleur du titre */
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #dcdde1; /* Nouvelle couleur de la bordure */
    }

    th {
        background-color: #3498db; /* Nouvelle couleur de fond de l'en-tête */
        color: #ffffff;
    }

    tr:hover {
        background-color: #ecf0f1; /* Nouvelle couleur au survol des lignes */
    }

    footer {
        background-color: #2c3e50;
        color: white;
        text-align: center;
        padding: 1em;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    footer a {
        color: white;
        text-decoration: none;
        margin: 0 10px;
        padding: 5px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    footer a:hover {
        background-color: #34495e; /* Nouvelle couleur au survol des liens dans le pied de page */
    }

    footer div {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Liste des étudiants</h2>

        <!-- Afficher la liste des étudiants -->
        <table border="1">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <!-- Ajoutez d'autres colonnes selon vos besoins -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($etudiants as $etudiant): ?>
                    <tr>
                        <td><?php echo $etudiant['nom']; ?></td>
                        <td><?php echo $etudiant['prenom']; ?></td>
                        <td><?php echo $etudiant['sexe']; ?></td>
                        <!-- Ajoutez d'autres colonnes selon vos besoins -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <footer>
    <p>© 2023 Projet Gestion des Étudiants</p>
    <div>
        <a href="accueil.php">Accueil</a>
        <a href="admin.php">Admin</a>
        <a href="ajout_etudiant.php">Ajouter Étudiant</a>
        <a href="liste_etudiants.php">Liste Étudiants</a>
        <a href="ajout_filiere.php">Ajouter Filière</a>
        <a href="liste_filieres.php">Liste Filières</a>
        <a href="modification_etudiant.php">Modification Étudiant</a>
        <a href="modification_filiere.php">Modification Filière</a>
    </div>
</footer>
</body>
</html>
