import { ENV } from "./env";

interface EmailPayload {
  to: string;
  subject: string;
  html: string;
}

/**
 * Send email using Manus Built-in Email Service
 */
export async function sendEmail(payload: EmailPayload): Promise<boolean> {
  try {
    const response = await fetch(`${ENV.forgeApiUrl}/email/send`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${ENV.forgeApiKey}`,
      },
      body: JSON.stringify({
        to: payload.to,
        subject: payload.subject,
        html: payload.html,
      }),
    });

    if (!response.ok) {
      console.error("[Email] Failed to send email:", response.statusText);
      return false;
    }

    console.log(`[Email] Email sent successfully to ${payload.to}`);
    return true;
  } catch (error) {
    console.error("[Email] Error sending email:", error);
    return false;
  }
}

/**
 * Format lead data as HTML email
 */
export function formatLeadEmail(data: {
  nome: string;
  whatsapp: string;
  instagram: string;
  faturamento: number;
  ticket: number;
  sessoes: number;
  horas_admin: number;
  valor_hora: number;
  prejuizo_mensal: number;
  potencial_lucro: number;
  horas_secretario: number;
}): string {
  return `
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
            <span class="field-value">${data.nome}</span>
          </div>
          <div class="field">
            <span class="field-label">WhatsApp:</span>
            <span class="field-value">${data.whatsapp}</span>
          </div>
          <div class="field">
            <span class="field-label">Instagram:</span>
            <span class="field-value">@${data.instagram}</span>
          </div>
        </div>

        <div class="section">
          <div class="section-title">💰 Dados Financeiros Informados</div>
          <div class="field">
            <span class="field-label">Faturamento Bruto Mensal:</span>
            <span class="field-value">R$ ${data.faturamento.toLocaleString("pt-BR")}</span>
          </div>
          <div class="field">
            <span class="field-label">Ticket Médio:</span>
            <span class="field-value">R$ ${data.ticket.toLocaleString("pt-BR")}</span>
          </div>
          <div class="field">
            <span class="field-label">Sessões por Mês:</span>
            <span class="field-value">${data.sessoes}</span>
          </div>
          <div class="field">
            <span class="field-label">Horas/dia no WhatsApp:</span>
            <span class="field-value">${data.horas_admin}h</span>
          </div>
        </div>

        <div class="section">
          <div class="section-title">📊 Diagnóstico Calculado</div>
          <div class="field">
            <span class="field-label">Valor/hora:</span>
            <span class="field-value">R$ ${data.valor_hora.toLocaleString("pt-BR")}</span>
          </div>
          <div class="field">
            <span class="field-label">Horas/mês em admin:</span>
            <span class="field-value">${data.horas_secretario}h</span>
          </div>
          <div class="highlight">
            <strong>💔 Prejuízo Mensal Estimado:</strong><br>
            <span style="font-size: 24px; color: #D4AF37; font-weight: bold;">R$ ${data.prejuizo_mensal.toLocaleString("pt-BR")}</span>
          </div>
          <div class="highlight">
            <strong>✨ Potencial de Lucro (com sistema premium):</strong><br>
            <span style="font-size: 24px; color: #D4AF37; font-weight: bold;">R$ ${data.potencial_lucro.toLocaleString("pt-BR")}</span>
          </div>
        </div>

        <div class="footer">
          <p>Este é um lead qualificado da calculadora de lucro oculto. Faça contato em breve!</p>
          <p>Enviado em ${new Date().toLocaleString("pt-BR")}</p>
        </div>
      </div>
    </body>
    </html>
  `;
}
