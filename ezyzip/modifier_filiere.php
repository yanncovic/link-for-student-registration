<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une filière</title>
    <style>
        /* Ajoutez ce code dans votre fichier CSS ou dans la balise <style> de votre page HTML */

body {
    background-color: #f8f9fa; /* Couleur de fond */
}

.container {
    margin-top: 50px;
}

.form-container {
    background-color: #fff; /* Couleur de fond du formulaire */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: bold;
}

.btn-update {
    background-color: #007bff; /* Couleur de fond du bouton */
    color: #fff; /* Couleur du texte du bouton */
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-update:hover {
    background-color: #0056b3; /* Couleur de fond du bouton au survol */
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
    <h2>Modifier une filière</h2>

    <?php
    $servername = "localhost";
    $dbname = "gestion_etudiants";
    $dbusername = "root";
    $dbpassword = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifie si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ancien_nom = $_POST['ancien_nom'];
            $nouveau_nom = $_POST['nouveau_nom'];

            // Met à jour le nom de la filière dans votre base de données
            $sql = "UPDATE filiere SET nom_filiere = :nouveau_nom WHERE nom_filiere = :ancien_nom";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':nouveau_nom' => $nouveau_nom, ':ancien_nom' => $ancien_nom]);

            echo 'Modification réussie';

            // Ajoutez un délai avant la redirection (par exemple, 2 secondes)
            echo '<meta http-equiv="refresh" content="2;url=liste_filieres.php">';
        }
    } catch(PDOException $e) {
        echo "Échec de la modification: " . $e->getMessage();
    }
    ?>

    <form action="modifier_filiere.php" method="post">
        <label for="ancien_nom">Ancien nom de la filière:</label><br>
        <!-- Afficher le nom de la filière à partir de la liste des filières -->
        <select name="ancien_nom" required>
            <?php
            $sql = "SELECT nom_filiere FROM filiere";
            $stmt = $conn->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=\"" . $row['nom_filiere'] . "\">" . $row['nom_filiere'] . "</option>";
            }
            ?>
        </select><br>

        <label for="nouveau_nom">Nouveau nom de la filière:</label><br>
        <input type="text" id="nouveau_nom" name="nouveau_nom" required><br>
        <input type="submit" value="Modifier">
    </form>
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


    </footer>

</body>
</html>
