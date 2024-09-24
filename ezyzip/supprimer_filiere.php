<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une filière</title>
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

        .btn-danger {
            background-color: #dc3545;
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

        .btn-danger:hover {
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
        <h2>Supprimer une filière</h2>

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
                $id_filiere = $_POST['id_filiere'];

                // Supprime la filière de la base de données
                $sql = "DELETE FROM filiere WHERE id_filiere = :id_filiere";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':id_filiere' => $id_filiere]);

                echo 'Suppression réussie';
            }
        } catch(PDOException $e) {
            echo "Échec de la suppression: " . $e->getMessage();
        }
        ?>

        <form id="deleteForm" action="supprimer_filiere.php" method="post">
            <label for="id_filiere">Sélectionnez une filière à supprimer:</label><br>
            <!-- Afficher la liste des filières à partir de la base de données -->
            <select name="id_filiere" required>
                <?php
                $sql = "SELECT id_filiere, nom_filiere FROM filiere";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"" . $row['id_filiere'] . "\">" . $row['nom_filiere'] . "</option>";
                }
                ?>
            </select><br>

            <input type="button" class="btn-danger" value="Supprimer" onclick="confirmDelete()">
        </form>
    </div>

    <script>
        function confirmDelete() {
            if (confirm("Voulez-vous vraiment supprimer cette filière?")) {
                document.getElementById("deleteForm").submit();
            }
        }
    </script>

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
            <a href="supprimer_filiere.php">Supprimer Filière</a>
        </div>
    </footer>
</body>
</html>