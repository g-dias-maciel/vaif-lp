<?php
/**
 * Leads API Handler
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/email.php';
require_once __DIR__ . '/../helpers/validation.php';

function handleLeadSubmission() {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate input
    $errors = validateLeadInput($input);
    if (!empty($errors)) {
        sendErrorResponse('Validation failed: ' . implode(', ', $errors), 400);
    }

    try {
        $db = Database::getInstance();

        // Prepare data
        $data = [
            'nome' => $input['nome'],
            'whatsapp' => $input['whatsapp'],
            'instagram' => $input['instagram'],
            'faturamento' => (int)$input['faturamento'],
            'ticket' => (int)$input['ticket'],
            'sessoes' => (int)$input['sessoes'],
            'horas_admin' => (int)$input['horas_admin'],
            'valor_hora' => (int)$input['valor_hora'],
            'prejuizo_mensal' => (int)$input['prejuizo_mensal'],
            'potencial_lucro' => (int)$input['potencial_lucro'],
            'horas_secretario' => (int)$input['horas_secretario'],
            'synced' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Insert into database
        $db->insert('leads', $data);
        $leadId = $db->lastInsertId();

        // Send email notification
        $emailSent = sendLeadNotificationEmail($input);

        sendSuccessResponse(
            ['lead_id' => $leadId, 'email_sent' => $emailSent],
            'Lead criado com sucesso'
        );
    } catch (Exception $e) {
        error_log('Lead submission error: ' . $e->getMessage());
        sendErrorResponse('Erro ao salvar o lead: ' . $e->getMessage(), 500);
    }
}

function getLeadsList() {
    try {
        $db = Database::getInstance();
        $leads = $db->select('leads', [], 100);
        
        sendSuccessResponse($leads, 'Leads retrieved successfully');
    } catch (Exception $e) {
        error_log('Get leads error: ' . $e->getMessage());
        sendErrorResponse('Erro ao buscar leads', 500);
    }
}
?>
