<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['whatsapp']) || !isset($data['data_agendamento'])) {
    echo json_encode(['success' => false, 'error' => 'Dados incompletos.']);
    exit;
}

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
// Opcional: Você pode colocar o Webhook do n8n aqui também para avisar o seu CRM que o horário foi marcado

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Atualiza o lead existente com a data da reunião
    $sql = "UPDATE leads SET data_agendamento = ? WHERE whatsapp = ? ORDER BY id DESC LIMIT 1";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['data_agendamento'],
        $data['whatsapp']
    ]);

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erro Real: ' . $e->getMessage()]);
}
?>
