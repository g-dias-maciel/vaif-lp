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
// 👇 ADICIONE ESTA VARIÁVEL NO SEU COOLIFY (URL DO WEBHOOK DO N8N)
$n8nWebhookUrl = getenv('N8N_CALENDAR_WEBHOOK_URL'); 

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Atualiza o lead no banco de dados principal
    $sql = "UPDATE leads SET data_agendamento = ? WHERE whatsapp = ? ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['data_agendamento'],
        $data['whatsapp']
    ]);

    // 2. BUSCA O NOME DO LEAD (para enviar ao n8n junto com o horário)
    $stmtNome = $pdo->prepare("SELECT nome, instagram FROM leads WHERE whatsapp = ? ORDER BY id DESC LIMIT 1");
    $stmtNome->execute([$data['whatsapp']]);
    $leadInfo = $stmtNome->fetch(PDO::FETCH_ASSOC);

    // 3. 👇 DISPARA PARA O N8N
    if ($n8nWebhookUrl && $leadInfo) {
        $payloadN8n = [
            'nome' => $leadInfo['nome'],
            'whatsapp' => $data['whatsapp'],
            'instagram' => $leadInfo['instagram'],
            'data_agendamento' => $data['data_agendamento']
        ];

        $ch = curl_init($n8nWebhookUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payloadN8n));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_exec($ch);
        curl_close($ch);
    }

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erro Real: ' . $e->getMessage()]);
}
?>
