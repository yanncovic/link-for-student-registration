<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    header('Location: connexion.php');
    exit();
}

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['identifiant'])) {
    $identifiantConnecte = $_SESSION['identifiant'];
    // Enregistrez l'heure de connexion dans la session
    if (!isset($_SESSION['heure_connexion'])) {
        $_SESSION['heure_connexion'] = time();
    }

    // Connexion à la base de données
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=gestion_etudiants;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparez et exécutez la requête SQL pour récupérer l'email
        $stmt = $pdo->prepare("SELECT email FROM utilisateur WHERE identifiant = :identifiant");
        $stmt->bindParam(':identifiant', $identifiantConnecte);
        $stmt->execute();

        // Récupérez le résultat de la requête
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Assurez-vous que la requête a retourné des résultats
        if ($result) {
            $emailUtilisateur = $result['email'];
        } else {
            $emailUtilisateur = "Adresse email non disponible";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
        exit();
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <!-- Liens Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            color: #343a40;
            text-align: center;
        }

        .dashboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .dashboard-item {
            width: 200px;
            height: 150px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            line-height: 150px;
            font-size: 18px;
            margin: 10px;
            border-radius: 8px;
            text-decoration: none;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
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
    </style>
</head>
<body>
    <!-- Votre contenu HTML -->

    <!-- Affichage des informations de connexion -->
    <div style="text-align: right; padding: 10px;">
     <marquee>   Vous êtes connecté: <?= $identifiantConnecte; ?>. Votre email est:<?= $emailUtilisateur; ?>.</marquee>
        <br>
        <a href="deconnexion.php" class="btn-deconnexion">Se déconnecter</a> 
        <br>
    Temps écoulé depuis la connexion : <span id="compte-a-rebours"></span> minutes.
    </div>

    <div class="container">
        <h2>Bienvenue sur la page d'accueil</h2>

        <!-- Dashboard avec des liens vers les différentes fonctionnalités -->
        <div class="dashboard">
            <a href="admin.php" class="dashboard-item">Page administrateur</a>
            <a href="liste_etudiants.php" class="dashboard-item">Liste des étudiants</a>
            <a href="liste_filieres.php" class="dashboard-item">Liste des filières</a>
            <a href="ajout_etudiant.php" class="dashboard-item">Ajout d'un étudiant</a>
            <a href="ajout_filiere.php" class="dashboard-item">Ajout d'une filière</a>
            <a href="modification_etudiant.php" class="dashboard-item">Modif etudiant</a>
            <a href="modification_filiere.php" class="dashboard-item">Modification d'une filière</a>
        </div>

        <p><a href="deconnexion.php">Se déconnecter</a></p>
    </div>

    <!-- Pied de page -->
    <footer>
        <p>© 2023 Projet Gestion des Étudiants</p>
        <div style="float: right;">
            <a href="accueil.php">Accueil</a>
            <a href="admin.php">Admin</a>
            <a href="ajout_etudiant.php">Ajouter Étudiant</a>
            <a href="liste_etudiants.php">Liste Étudiants</a>
            <a href="ajout_filiere.php">Ajouter Filière</a>
            <a href="liste_filieres.php">Liste Filières</a>
            <a href="modification_etudiant.php">modification étudiant</a>
            <a href="modification_filiere.php">modification filiere</a>
           
            
    </div>
        </div>
    </footer>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'heure de connexion côté client
    var heureConnexion = <?= isset($_SESSION['heure_connexion']) ? $_SESSION['heure_connexion'] : 0; ?>;

    function mettreAJourCompteARebours() {
        // Calculer le temps écoulé depuis la connexion en minutes
        var tempsEcouléEnMinutes = Math.floor(((Date.now() / 1000) - heureConnexion) / 60);

        // Mettre à jour le contenu HTML avec le temps écoulé
        document.getElementById('compte-a-rebours').innerHTML = tempsEcouléEnMinutes;

        // Actualiser toutes les minutes
        setTimeout(mettreAJourCompteARebours, 60000);
    }

    // Démarrer le compte à rebours lors du chargement de la page
    mettreAJourCompteARebours();
});
</script>


</body>
</html>
