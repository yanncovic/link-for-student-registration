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

// Filieres à ajouter
$nouvellesFilieres = [
    'Optique lunetterie',
    'Réseau informatique et Télécommunication',
    'Génie civil : option bâtiment',
    'Mines-géologie-Pétrole',
    'Cosmétologie',
    'Génie énergétique et Environnement',
    'Maintenance, des systèmes électroniques et informatiques',
    'Electrotechnique',
    'Industries Agro-alimentaires et Chimiques : option production',
    'Industries Agro-alimentaires et chimiques : option contrôle',
    'Maintenance des systèmes de production',
    'Informatique : Développeur d’Application',
    'Art, Aménagement et cadre de vie',
    'Finance-Assurance',
    'Tourisme-Hôtellerie',
    'Logistique',
    'Gestion commerciale',
    'Ressources Humaines et Communication',
    'Assistanat de Direction',
    'Communication visuelle',
    'Finance comptabilité et gestion d’Entreprises',
    'Agriculture tropicale : option production animale',
    'Gestion des collectivités territoriales',
    'Gestion de l’Environnement et des Ressources Naturelles',
    'Agriculture tropicale : option production végétale',
];

// Ajouter les nouvelles filières s'il y a des différences
foreach ($nouvellesFilieres as $filiere) {
    $stmt = $pdo->prepare("INSERT INTO filiere (nom_filiere) VALUES (:nom_filiere)");
    $stmt->bindParam(':nom_filiere', $filiere);
    $stmt->execute();
}

// Récupérer la liste des filières depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM filiere");
$stmt->execute();
$filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des filières</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .btn {
            margin-top: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
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
            background-color: #555;
        }

        footer div {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liste des filières</h2>

        <!-- Afficher la liste des filières -->
        <table border="1">
            <thead>
                <tr>
                    <th>Nom de la filière</th>
                    <!-- Ajoutez d'autres colonnes selon vos besoins -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filieres as $filiere): ?>
                    <tr>
                        <td><?php echo $filiere['nom_filiere']; ?></td>
                        <!-- Ajoutez d'autres colonnes selon vos besoins -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>© 2023 Projet Gestion des Étudiants</p>
        <div style="float: right;">
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
