<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un étudiant</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            padding-bottom: 100px; /* Ajout de marge en bas pour éviter le chevauchement avec le pied de page */
        }

        .container {
            margin-top: 20px;
            margin-bottom: 20px; /* Ajustement de la marge en bas pour éviter le chevauchement avec le pied de page */
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        h2 {
            color: #343a40;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            color: #007bff;
        }

        select,
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            appearance: none;
        }

        .btn-primary {
            background-color: #dc3545; /* Utilisation d'une couleur rouge pour le bouton de suppression */
            border-color: #dc3545;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        footer {
            background-color: #343a40;
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
    <div class="container">
        <h2>Supprimer un étudiant</h2>

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
                if (isset($_POST['confirm_suppression']) && $_POST['confirm_suppression'] === 'oui') {
                    // Supprime l'étudiant de la base de données après confirmation
                    $id_etudiant = $_POST['id_etudiant'];
                    $sql = "DELETE FROM etudiant WHERE id_etudiant = :id_etudiant";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([':id_etudiant' => $id_etudiant]);

                    echo 'Suppression réussie';

                    // Ajoutez un délai avant la redirection (par exemple, 2 secondes)
                    echo '<meta http-equiv="refresh" content="2;url=liste_etudiants.php">';
                } else {
                    // Affiche la confirmation
                    $id_etudiant = $_POST['id_etudiant'];
                    echo "<p>Voulez-vous vraiment supprimer cet étudiant?</p>";
                    echo "<form action=\"supprimer_etudiant.php\" method=\"post\">";
                    echo "<input type=\"hidden\" name=\"id_etudiant\" value=\"$id_etudiant\">";
                    echo "<input type=\"hidden\" name=\"confirm_suppression\" value=\"oui\">";
                    echo "<button type=\"submit\" class=\"btn-primary\">Oui, Supprimer</button>";
                    echo "</form>";
                    echo "<a href=\"liste_etudiants.php\">Annuler</a>";
                }
            } else {
                // Affiche le formulaire pour choisir l'étudiant à supprimer
                echo "<form action=\"supprimer_etudiant.php\" method=\"post\">";
                echo "<label for=\"id_etudiant\">Sélectionnez un étudiant à supprimer:</label><br>";
                echo "<select name=\"id_etudiant\" required>";
                $sql = "SELECT id_etudiant, nom, prenom FROM etudiant";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"" . $row['id_etudiant'] . "\">" . $row['nom'] . " " . $row['prenom'] . "</option>";
                }
                echo "</select><br>";
                echo "<input type=\"submit\" class=\"btn-primary\" value=\"Supprimer\">";
                echo "</form>";
            }
        } catch(PDOException $e) {
            echo "Échec de la suppression: " . $e->getMessage();
        }
        ?>
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
            <a href="modification_etudiant.php">modification étudiant</a>
            <a href="modification_filiere.php">modification filiere</a>
        </div>
    </footer>
</body>
</html>
