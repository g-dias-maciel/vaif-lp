<?php
header('Content-Type: application/json');

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pega todos os horários que não estão vazios
    $stmt = $pdo->query("SELECT data_agendamento FROM leads WHERE data_agendamento IS NOT NULL");
    $ocupados = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode(['success' => true, 'ocupados' => $ocupados]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'ocupados' => []]); // Se der erro, assume vazio para não quebrar a tela
}
?>
