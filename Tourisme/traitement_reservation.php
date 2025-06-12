<?php
$host = 'localhost';
$db = 'Site_Web';
$user = 'postgres';
$password = '1234';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $password);

    $stmt = $pdo->prepare("INSERT INTO reservation (
        nom_complet, email, telephone, date_arrivee, date_depart, nombre_personnes, hotel_choisi
    ) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $_POST['nom_complet'],
        $_POST['email'],
        $_POST['telephone'],
        $_POST['date_arrivee'],
        $_POST['date_depart'],
        $_POST['nombre_personnes'],
        $_POST['hotel_choisi']
    ]);

    // Rediriger vers la page de confirmation avec message
    echo "<script>
        alert('✅ Réservation enregistrée avec succès.');
        const synth = window.speechSynthesis;
        const message = new SpeechSynthesisUtterance('Vous venez de réserver un hôtel. Un mail vous sera envoyé pour confirmer la transaction.');
        synth.speak(message);
        window.location.href = 'index.html';
    </script>";
} catch (PDOException $e) {
    echo "<script>alert('❌ Erreur : " . $e->getMessage() . "');</script>";
}
?>
