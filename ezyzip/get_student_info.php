<?php
$servername = "localhost";
$dbname = "gestion_etudiants";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer l'ID de l'étudiant à partir de la requête GET
    $studentId = $_GET['id'];

    // Sélectionner les informations de l'étudiant en fonction de l'ID
    $stmt = $conn->prepare("SELECT nom, prenom, autre_champ FROM etudiant WHERE id_etudiant = :id");
    $stmt->bindParam(':id', $studentId);
    $stmt->execute();

    // Renvoyer les informations de l'étudiant au format JSON
    $studentInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($studentInfo);
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
