<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Nenhum dado recebido.']);
    exit;
}

// 1. Database & Webhook Credentials from Coolify Environment Variables
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$makeWebhookUrl = getenv('MAKE_WEBHOOK_URL');

try {
    // 2. Connect to the Database
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Insert into Database
    $sql = "INSERT INTO leads (nome, whatsapp, instagram, faturamento, ticket, sessoes, horas_admin, valor_hora, horas_secretario, prejuizo_mensal, potencial_lucro) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['nome'],
        $data['whatsapp'],
        $data['instagram'],
        $data['faturamento'],
        $data['ticket'],
        $data['sessoes'],
        $data['horas_admin'],
        $data['valor_hora'],
        $data['horas_secretario'],
        $data['prejuizo_mensal'],
        $data['potencial_lucro']
    ]);

    // 4. If DB insert succeeds, forward to Make.com Webhook
    if ($makeWebhookUrl) {
        $ch = curl_init($makeWebhookUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Don't hang the site if Make is down
        
        curl_exec($ch);
        curl_close($ch);
    }

    // 5. Send success back to the frontend
    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    // If the database fails, we return an error so the user can try again
    echo json_encode(['success' => false, 'error' => 'Erro interno ao salvar os dados.']);
    // Optional: error_log($e->getMessage()); to keep your exact DB errors hidden from the public
}
?>