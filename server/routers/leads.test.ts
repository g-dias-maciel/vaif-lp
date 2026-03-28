import { describe, it, expect, vi, beforeEach } from "vitest";
import { leadsRouter } from "./leads";
import * as db from "../db";
import * as email from "../_core/email";

// Mock the database and email modules
vi.mock("../db");
vi.mock("../_core/email");

describe("leadsRouter", () => {
  beforeEach(() => {
    vi.clearAllMocks();
  });

  describe("submit", () => {
    it("should create a lead and send email on successful submission", async () => {
      // Mock database response
      vi.mocked(db.createLead).mockResolvedValueOnce({ insertId: 1 } as any);
      vi.mocked(email.sendEmail).mockResolvedValueOnce(true);

      const caller = leadsRouter.createCaller({} as any);

      const leadData = {
        nome: "João Silva",
        whatsapp: "(11) 99999-9999",
        instagram: "joao.silva",
        faturamento: 15000,
        ticket: 1500,
        sessoes: 10,
        horas_admin: 3,
        valor_hora: 187.5,
        prejuizo_mensal: 12375,
        potencial_lucro: 18000,
        horas_secretario: 66,
      };

      const result = await caller.submit(leadData);

      expect(result).toEqual({
        success: true,
        message: "Lead criado com sucesso",
      });

      // Verify database was called
      expect(db.createLead).toHaveBeenCalledWith(
        expect.objectContaining({
          nome: "João Silva",
          whatsapp: "(11) 99999-9999",
          instagram: "joao.silva",
          synced: 0,
        })
      );

      // Verify email was sent
      expect(email.sendEmail).toHaveBeenCalledWith(
        expect.objectContaining({
          to: "marketingvaif@gmail.com",
          subject: expect.stringContaining("João Silva"),
        })
      );
    });

    it("should validate required fields", async () => {
      const caller = leadsRouter.createCaller({} as any);

      const invalidData = {
        nome: "",
        whatsapp: "",
        instagram: "",
        faturamento: 0,
        ticket: 0,
        sessoes: 0,
        horas_admin: 0,
        valor_hora: 0,
        prejuizo_mensal: 0,
        potencial_lucro: 0,
        horas_secretario: 0,
      };

      try {
        await caller.submit(invalidData);
        expect.fail("Should have thrown validation error");
      } catch (error: any) {
        expect(error.message).toContain("obrigatório");
      }
    });

    it("should handle email sending failure gracefully", async () => {
      vi.mocked(db.createLead).mockResolvedValueOnce({ insertId: 1 } as any);
      vi.mocked(email.sendEmail).mockResolvedValueOnce(false);

      const caller = leadsRouter.createCaller({} as any);

      const leadData = {
        nome: "Maria Santos",
        whatsapp: "(11) 98888-8888",
        instagram: "maria.santos",
        faturamento: 20000,
        ticket: 2000,
        sessoes: 10,
        horas_admin: 4,
        valor_hora: 250,
        prejuizo_mensal: 22000,
        potencial_lucro: 24000,
        horas_secretario: 88,
      };

      // Should still return success even if email fails
      const result = await caller.submit(leadData);

      expect(result.success).toBe(true);
      expect(db.createLead).toHaveBeenCalled();
      expect(email.sendEmail).toHaveBeenCalled();
    });
  });

  describe("getPending", () => {
    it("should return pending leads", async () => {
      const mockLeads = [
        {
          id: 1,
          nome: "Lead 1",
          synced: 0,
        },
        {
          id: 2,
          nome: "Lead 2",
          synced: 0,
        },
      ];

      vi.mocked(db.getPendingLeads).mockResolvedValueOnce(mockLeads as any);

      const caller = leadsRouter.createCaller({} as any);
      const result = await caller.getPending();

      expect(result).toEqual(mockLeads);
      expect(db.getPendingLeads).toHaveBeenCalled();
    });
  });

  describe("getById", () => {
    it("should return a lead by id", async () => {
      const mockLead = {
        id: 1,
        nome: "Test Lead",
        whatsapp: "(11) 99999-9999",
      };

      vi.mocked(db.getLeadById).mockResolvedValueOnce(mockLead as any);

      const caller = leadsRouter.createCaller({} as any);
      const result = await caller.getById({ id: 1 });

      expect(result).toEqual(mockLead);
      expect(db.getLeadById).toHaveBeenCalledWith(1);
    });

    it("should return null if lead not found", async () => {
      vi.mocked(db.getLeadById).mockResolvedValueOnce(undefined);

      const caller = leadsRouter.createCaller({} as any);
      const result = await caller.getById({ id: 999 });

      expect(result).toBeUndefined();
    });
  });
});
