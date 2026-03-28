import { z } from "zod";
import { publicProcedure, router } from "../_core/trpc";
import { createLead, getLeadById, getPendingLeads } from "../db";
import { sendEmail, formatLeadEmail } from "../_core/email";

const leadInputSchema = z.object({
  nome: z.string().min(1, "Nome é obrigatório"),
  whatsapp: z.string().min(1, "WhatsApp é obrigatório"),
  instagram: z.string().min(1, "Instagram é obrigatório"),
  faturamento: z.number().positive("Faturamento deve ser positivo"),
  ticket: z.number().positive("Ticket deve ser positivo"),
  sessoes: z.number().positive("Sessões deve ser positivo"),
  horas_admin: z.number().positive("Horas admin deve ser positivo"),
  valor_hora: z.number().positive(),
  prejuizo_mensal: z.number().positive(),
  potencial_lucro: z.number().positive(),
  horas_secretario: z.number().positive(),
});

export const leadsRouter = router({
  submit: publicProcedure
    .input(leadInputSchema)
    .mutation(async ({ input }) => {
      try {
        const result = await createLead({
          nome: input.nome,
          whatsapp: input.whatsapp,
          instagram: input.instagram,
          faturamento: Math.round(input.faturamento),
          ticket: Math.round(input.ticket),
          sessoes: Math.round(input.sessoes),
          horas_admin: Math.round(input.horas_admin),
          valor_hora: Math.round(input.valor_hora),
          prejuizo_mensal: Math.round(input.prejuizo_mensal),
          potencial_lucro: Math.round(input.potencial_lucro),
          horas_secretario: Math.round(input.horas_secretario),
          synced: 0,
        });

        // Send email notification
        const emailHtml = formatLeadEmail(input);
        await sendEmail({
          to: "marketingvaif@gmail.com",
          subject: `Novo Lead: ${input.nome} - Calculadora Lucro Oculto`,
          html: emailHtml,
        });

        return {
          success: true,
          message: "Lead criado com sucesso",
        };
      } catch (error) {
        console.error("[Leads] Error creating lead:", error);
        throw new Error("Falha ao salvar o lead");
      }
    }),

  getPending: publicProcedure.query(async () => {
    try {
      const pendingLeads = await getPendingLeads();
      return pendingLeads;
    } catch (error) {
      console.error("[Leads] Error fetching pending leads:", error);
      return [];
    }
  }),

  getById: publicProcedure
    .input(z.object({ id: z.number() }))
    .query(async ({ input }) => {
      try {
        const lead = await getLeadById(input.id);
        return lead;
      } catch (error) {
        console.error("[Leads] Error fetching lead:", error);
        return null;
      }
    }),
});
