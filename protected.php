<?php
$servername = "localhost";
$db_username = "titi";
$db_password = "titi";
$dbname = "titi";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
    // Configurer PDO pour afficher les erreurs en cas de problème
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion à la base de données réussie";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
// Récupération des données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];
// Construction de la requête SQL (utilisation de requête préparée pour la sécurité)
$sqlQuery = "SELECT * FROM utilisateurs WHERE nom_utilisateur = :username AND mot_de_passe = :password";
$stmt = $conn->prepare($sqlQuery);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();
// Vérification des résultats
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Connexion Réussie - Bienvenue, " . $row['nom_utilisateur'];
} else {
    echo "Échec de la Connexion";
}
// Fermeture de la connexion à la base de données
$conn = null;
?>