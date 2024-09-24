<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connexion à la base de données (ajustez les informations de connexion selon votre configuration)
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=gestion_etudiants;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Erreur de connexion à la base de données : ' . $e->getMessage());
    }

    // Récupérer les données du formulaire
    $identifiant = isset($_POST['identifiant']) ? $_POST['identifiant'] : '';
    $motdepasse = isset($_POST['motdepasse']) ? $_POST['motdepasse'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : ''; // Nouveau champ d'email

    // Vérifier que tous les champs obligatoires sont remplis
    if (empty($identifiant) || empty($motdepasse) || empty($email)) {
        $erreur = 'Veuillez remplir tous les champs.';
    } else {
        // Préparer la requête d'insertion
        $stmt = $pdo->prepare("INSERT INTO utilisateur (identifiant, motdepasse, email, profil) VALUES (:identifiant, :motdepasse, :email, :profil)");

        // Générer le mot de passe haché
        $motdepasse_hashed = password_hash($motdepasse, PASSWORD_DEFAULT);

        // Définir le profil par défaut
        $profil = 'invite';

        // Liaison des paramètres
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->bindParam(':motdepasse', $motdepasse_hashed);
        $stmt->bindParam(':email', $email); // Nouveau champ d'email
        $stmt->bindParam(':profil', $profil);

        // Exécution de la requête
        try {
            $stmt->execute();
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            $erreur = 'Erreur lors de l\'inscription : ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (restez inchangé) ... -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>

        <!-- Afficher les erreurs éventuelles -->
        <?php if (isset($erreur)) : ?>
            <p class="erreur"><?= $erreur; ?></p>
        <?php endif; ?>

        <!-- Formulaire d'inscription -->
        <form action="" method="post">
            <label for="identifiant">Identifiant:</label>
            <input type="text" name="identifiant" required>

            <label for="email">Email:</label> <!-- Nouveau champ d'email -->
            <input type="email" name="email" required> <!-- Nouveau champ d'email -->

            <label for="motdepasse">Mot de passe:</label>
            <input type="password" name="motdepasse" required>

            <input type="submit" value="S'inscrire">
        </form>

        <p>Déjà un compte? <a href="index.php">Connectez-vous ici</a></p>
    </div>
</body>
</html>
