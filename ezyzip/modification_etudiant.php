<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un étudiant</title>
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
            background-color: #007bff;
            border-color: #007bff;
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
            background-color: #0056b3;
            border-color: #0056b3;
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
        <h2>Modifier un étudiant</h2>

        
        <?php
        $servername = "localhost";
        $dbname = "gestion_etudiants";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Récupération des informations de l'étudiant sélectionné
            $selectedId = isset($_POST['id_etudiant']) ? $_POST['id_etudiant'] : '';
            $selectedInfo = array(); // Tableau pour stocker les informations de l'étudiant sélectionné
            if (!empty($selectedId)) {
                $sql = "SELECT * FROM etudiant WHERE id_etudiant = :id_etudiant";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':id_etudiant' => $selectedId]);
                $selectedInfo = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            // Vérifie si le formulaire est soumis
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // ... (votre code de mise à jour existant)
            }
        } catch(PDOException $e) {
            echo "Échec de la modification: " . $e->getMessage();
        }
        ?>

        <form action="modification_etudiant.php" method="post">
            <label for="id_etudiant">Sélectionnez un étudiant à modifier:</label><br>
            <!-- Afficher la liste des étudiants à partir de la base de données -->
            <select name="id_etudiant" required>
                <?php
                $sql = "SELECT id_etudiant, nom, prenom FROM etudiant";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($row['id_etudiant'] == $selectedId) ? 'selected' : '';
                    echo "<option value=\"" . $row['id_etudiant'] . "\" $selected>" . $row['nom'] . " " . $row['prenom'] . "</option>";
                }
                ?>
            
            $selectedId = isset($_POST['id_etudiant']) ? $_POST['id_etudiant'] : '';
$selectedInfo = array(); // Tableau pour stocker les informations de l'étudiant sélectionné
if (!empty($selectedId)) {
    $sql = "SELECT * FROM etudiant WHERE id_etudiant = :id_etudiant";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id_etudiant' => $selectedId]);
    $selectedInfo = $stmt->fetch(PDO::FETCH_ASSOC);
}
</select><br>
            <label for="nouveau_nom">Nouveau nom de l'étudiant:</label><br>
            <input type="text" id="nouveau_nom" name="nouveau_nom" value="<?php echo isset($selectedInfo['nom']) ? $selectedInfo['nom'] : ''; ?>" required><br>

            <label for="nouveau_prenom">Nouveau prénom de l'étudiant:</label><br>
            <input type="text" id="nouveau_prenom" name="nouveau_prenom" value="<?php echo isset($selectedInfo['prenom']) ? $selectedInfo['prenom'] : ''; ?>" required><br>
            <label for="nouveau_sexe">Nouveau sexe de l'étudiant:</label><br>
            <select name="nouveau_sexe" required>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select><br>

            <label for="nouveau_date_naissance">Nouvelle date de naissance de l'étudiant:</label><br>
            <input type="date" id="nouveau_date_naissance" name="nouveau_date_naissance" required><br>

            <label for="nouveau_lieu_naissance">Nouveau lieu de naissance de l'étudiant:</label><br>
            <input type="text" id="nouveau_lieu_naissance" name="nouveau_lieu_naissance" required><br>

            <label for="nouveau_adresse">Nouvelle adresse de l'étudiant:</label><br>
            <input type="text" id="nouveau_adresse" name="nouveau_adresse" required><br>

            <label for="nouveau_ville">Nouvelle ville de l'étudiant:</label><br>
            <input type="text" id="nouveau_ville" name="nouveau_ville" required><br>

            <label for="nouveau_pays">Nouveau pays de l'étudiant:</label><br>
            <input type="text" id="nouveau_pays" name="nouveau_pays" required><br>

            <label for="nouveau_telephone">Nouveau téléphone de l'étudiant:</label><br>
            <input type="tel" id="nouveau_telephone" name="nouveau_telephone" required><br>

            <label for="nouveau_email">Nouvel email de l'étudiant:</label><br>
            <input type="email" id="nouveau_email" name="nouveau_email" required><br>

            <label for="nouveau_annee_etude">Nouvelle année d'étude de l'étudiant:</label><br>
            <input type="text" id="nouveau_annee_etude" name="nouveau_annee_etude" required><br>

            <label for="nouveau_filieres">Nouvelle filière de l'étudiant:</label><br>
            <select name="nouveau_filieres" required>
                <?php
                // Afficher la liste des filières à partir de la base de données
                $sql_filieres = "SELECT id_filiere, nom_filiere FROM filiere";
                $stmt_filieres = $conn->query($sql_filieres);
                while ($row_filiere = $stmt_filieres->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"" . $row_filiere['id_filiere'] . "\">" . $row_filiere['nom_filiere'] . "</option>";
                }
                ?>
            </select><br>

            <label for="nouveau_parcours">Nouveau parcours de l'étudiant:</label><br>
            <select name="nouveau_parcours" required>
                <option value="licence">Licence</option>
                <option value="master">Master</option>
                <option value="doctorat">Doctorat</option>
            </select><br>

            <input type="submit" class="btn-primary" value="Modifier">
        </form>
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
