<?php
// deconnexion.php

// Vérifier si l'utilisateur a confirmé la déconnexion
if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
    // Effectuer la déconnexion ici (par exemple, supprimer les données de session)
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php'); // Rediriger vers la page de connexion après la déconnexion
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #007bff;
        }

        p {
            color: #333;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        button:hover, a:hover {
            background-color: #0056b3;
        }
    </style>
    
    <script>
        // Fonction pour afficher la boîte de dialogue de confirmation
        function confirmerDeconnexion() {
            var confirmation = confirm("Voulez-vous vraiment vous déconnecter ?");
            if (confirmation) {
                window.location.href = 'deconnexion.php?confirm=true';
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Déconnexion</h2>

    <!-- Afficher le message de confirmation -->
    <p>Voulez-vous vraiment vous déconnecter ?</p>

    <!-- Bouton pour confirmer la déconnexion -->
    <button onclick="confirmerDeconnexion()">Oui, déconnectez-moi</button>

    <!-- Bouton pour annuler la déconnexion -->
    <a href="accueil.php">Annuler</a>
</div>
</body>
</html>

