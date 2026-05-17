<?php
/**
 * Email Helper - Send notifications
 */

function sendLeadNotificationEmail($leadData) {
    $to = MAIL_TO;
    $subject = "Novo Lead: {$leadData['nome']} - Calculadora Lucro Oculto";
    $htmlContent = generateLeadEmailHTML($leadData);

    // Prepare headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: " . MAIL_FROM . "\r\n";

    // Send email
    $sent = mail($to, $subject, $htmlContent, $headers);

    if ($sent) {
        error_log("Email sent to $to for lead: {$leadData['nome']}");
    } else {
        error_log("Failed to send email to $to for lead: {$leadData['nome']}");
    }

    return $sent;
}

function generateLeadEmailHTML($data) {
    $nome = htmlspecialchars($data['nome']);
    $whatsapp = htmlspecialchars($data['whatsapp']);
    $instagram = htmlspecialchars($data['instagram']);
    $faturamento = number_format($data['faturamento'], 2, ',', '.');
    $ticket = number_format($data['ticket'], 2, ',', '.');
    $sessoes = (int)$data['sessoes'];
    $horas_admin = (int)$data['horas_admin'];
    $valor_hora = number_format($data['valor_hora'], 2, ',', '.');
    $prejuizo_mensal = number_format($data['prejuizo_mensal'], 2, ',', '.');
    $potencial_lucro = number_format($data['potencial_lucro'], 2, ',', '.');
    $horas_secretario = (int)$data['horas_secretario'];
    $timestamp = date('d/m/Y H:i:s');

    return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; padding: 20px; border-radius: 8px; }
        h1 { color: #D4AF37; border-bottom: 2px solid #D4AF37; padding-bottom: 10px; }
        .section { margin: 20px 0; }
        .section-title { color: #0D0D0D; font-weight: bold; font-size: 14px; text-transform: uppercase; margin-bottom: 10px; }
        .field { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee; }
        .field-label { color: #666; font-weight: bold; }
        .field-value { color: #333; }
        .highlight { background-color: #fffacd; padding: 15px; border-left: 4px solid #D4AF37; margin: 15px 0; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎯 Novo Lead - Calculadora Lucro Oculto</h1>
        
        <div class="section">
            <div class="section-title">📋 Informações de Contato</div>
            <div class="field">
                <span class="field-label">Nome:</span>
                <span class="field-value">$nome</span>
            </div>
            <div class="field">
                <span class="field-label">WhatsApp:</span>
                <span class="field-value">$whatsapp</span>
            </div>
            <div class="field">
                <span class="field-label">Instagram:</span>
                <span class="field-value">@$instagram</span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">💰 Dados Financeiros Informados</div>
            <div class="field">
                <span class="field-label">Faturamento Bruto Mensal:</span>
                <span class="field-value">R$ $faturamento</span>
            </div>
            <div class="field">
                <span class="field-label">Ticket Médio:</span>
                <span class="field-value">R$ $ticket</span>
            </div>
            <div class="field">
                <span class="field-label">Sessões por Mês:</span>
                <span class="field-value">$sessoes</span>
            </div>
            <div class="field">
                <span class="field-label">Horas/dia no WhatsApp:</span>
                <span class="field-value">${horas_admin}h</span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">📊 Diagnóstico Calculado</div>
            <div class="field">
                <span class="field-label">Valor/hora:</span>
                <span class="field-value">R$ $valor_hora</span>
            </div>
            <div class="field">
                <span class="field-label">Horas/mês em admin:</span>
                <span class="field-value">${horas_secretario}h</span>
            </div>
            <div class="highlight">
                <strong>💔 Prejuízo Mensal Estimado:</strong><br>
                <span style="font-size: 24px; color: #D4AF37; font-weight: bold;">R$ $prejuizo_mensal</span>
            </div>
            <div class="highlight">
                <strong>✨ Potencial de Lucro (com sistema premium):</strong><br>
                <span style="font-size: 24px; color: #D4AF37; font-weight: bold;">R$ $potencial_lucro</span>
            </div>
        </div>

        <div class="footer">
            <p>Este é um lead qualificado da calculadora de lucro oculto. Faça contato em breve!</p>
            <p>Enviado em $timestamp</p>
        </div>
    </div>
</body>
</html>
HTML;
}
?>
