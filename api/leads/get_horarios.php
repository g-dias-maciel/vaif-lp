<?php
header('Content-Type: application/json');

// Validate Environment Variables
if (!$host || !$dbname || !$user || !$pass) {
    echo json_encode(['success' => false, 'error' => 'Configurações de banco de dados não estão definidas.']);
    error_log('Error: Database connection details not set');
    exit;
}
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pega todos os horários que não estão vazios
    // Function to Retrieve Occupied Time Slots
function getOccupiedSlots($pdo) {
    $stmt = $pdo->query("SELECT data_agendamento FROM leads WHERE data_agendamento IS NOT NULL");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
    // Call getOccupiedSlots function
$ocupados = getOccupiedSlots($pdo);

    echo json_encode(['success' => true, 'ocupados' => $ocupados]);

} catch (PDOException $e) {
    // Enhanced Error Handling
catch (PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Erro ao buscar horários.']);
}
}
?>
