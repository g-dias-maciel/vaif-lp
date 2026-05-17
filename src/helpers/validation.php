<?php
/**
 * Validation Helper
 */

function validateLeadInput($input) {
    $errors = [];

    // Validate required fields
    if (empty($input['nome'])) {
        $errors[] = 'Nome é obrigatório';
    }
    if (empty($input['whatsapp'])) {
        $errors[] = 'WhatsApp é obrigatório';
    }
    if (empty($input['instagram'])) {
        $errors[] = 'Instagram é obrigatório';
    }

    // Validate numeric fields
    $numericFields = ['faturamento', 'ticket', 'sessoes', 'horas_admin', 'valor_hora', 'prejuizo_mensal', 'potencial_lucro', 'horas_secretario'];
    foreach ($numericFields as $field) {
        if (!isset($input[$field]) || !is_numeric($input[$field])) {
            $errors[] = "$field deve ser um número válido";
        }
    }

    return $errors;
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function sanitizeString($string) {
    return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
}
?>
