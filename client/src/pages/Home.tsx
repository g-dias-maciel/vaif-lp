/**
 * VELVET DARK — Landing Page
 * Design: Luxury Contemporary, Dark Mode, Gold Accents
 * Fonts: Cormorant Garamond (headings) + Montserrat (body/UI)
 * Colors: #0D0D0D bg, #F2EDE4 text, #D4AF37 gold accent
 * Layout: Mobile-first SPA with smooth scroll sections
 */

import { useEffect, useRef, useState } from "react";
import { trpc } from "@/lib/trpc";

// ─── Types ───────────────────────────────────────────────────
interface CalcInputs {
  faturamento: string;
  ticket: string;
  sessoes: string;
  horas_admin: string;
}

interface CalcResults {
  valor_hora: number;
  prejuizo_mensal: number;
  potencial_lucro: number;
  horas_secretario: number;
}

interface LeadForm {
  nome: string;
  whatsapp: string;
  instagram: string;
}

// ─── Utilities ───────────────────────────────────────────────
function formatBRL(value: number): string {
  return new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
    minimumFractionDigits: 2,
  }).format(value);
}

function useCountUp(target: number, duration: number = 1800, active: boolean = false) {
  const [current, setCurrent] = useState(0);
  useEffect(() => {
    if (!active) return;
    let start = 0;
    const startTime = performance.now();
    const step = (now: number) => {
      const elapsed = now - startTime;
      const progress = Math.min(elapsed / duration, 1);
      // Ease out expo
      const eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
      setCurrent(Math.floor(eased * target));
      if (progress < 1) requestAnimationFrame(step);
      else setCurrent(target);
    };
    requestAnimationFrame(step);
  }, [target, duration, active]);
  return current;
}

// ─── Ornament Divider ────────────────────────────────────────
function GoldDivider({ className = "" }: { className?: string }) {
  return (
    <div className={`gold-divider ${className}`}>
      <div className="gold-divider-diamond" />
    </div>
  );
}

// ─── Hero Section ────────────────────────────────────────────
function HeroSection({ onCalculate }: { onCalculate: () => void }) {
  return (
    <section
      className="relative min-h-screen flex items-center overflow-hidden grain-overlay"
      style={{
        background: "#0D0D0D",
      }}
    >
      {/* Background image — right side */}
      <div
        className="absolute inset-0 z-0"
        style={{
          backgroundImage:
            "url(https://d2xsxph8kpxj0f.cloudfront.net/310519663486917648/irrCoUbQoV6yC8GdYKjsD9/hero-bg-FNevDH6u7dQ5qmXMetACwE.webp)",
          backgroundSize: "cover",
          backgroundPosition: "center right",
          backgroundRepeat: "no-repeat",
          opacity: 0.55,
        }}
      />
      {/* Dark gradient overlay — left to right */}
      <div
        className="absolute inset-0 z-0"
        style={{
          background:
            "linear-gradient(100deg, #0D0D0D 45%, rgba(13,13,13,0.75) 65%, rgba(13,13,13,0.2) 100%)",
        }}
      />
      {/* Radial gold glow — top right */}
      <div
        className="absolute top-0 right-0 w-[600px] h-[600px] z-0 pointer-events-none"
        style={{
          background:
            "radial-gradient(ellipse at top right, rgba(212,175,55,0.07) 0%, transparent 65%)",
        }}
      />

      {/* Content */}
      <div className="container relative z-10 py-24 md:py-32">
        <div className="max-w-2xl">
          {/* Pre-title */}
          <p
            className="opacity-0 animate-fade-up delay-100 text-xs font-semibold tracking-[0.25em] uppercase mb-6"
            style={{ color: "#D4AF37", fontFamily: "Montserrat, sans-serif" }}
          >
            Exclusivo para artistas do realismo e alto padrão
          </p>

          {/* H1 */}
          <h1
            className="opacity-0 animate-fade-up delay-200 font-bold leading-[1.05] mb-6"
            style={{
              fontFamily: "Cormorant Garamond, serif",
              fontSize: "clamp(2.6rem, 6vw, 4.5rem)",
              color: "#F2EDE4",
            }}
          >
            Descubra quanto dinheiro você está{" "}
            <em style={{ color: "#D4AF37", fontStyle: "italic" }}>
              "deixando na mesa"
            </em>{" "}
            todos os meses no WhatsApp.
          </h1>

          {/* Gold divider */}
          <div className="opacity-0 animate-fade-up delay-300 my-8 w-48">
            <GoldDivider />
          </div>

          {/* Subtitle */}
          <p
            className="opacity-0 animate-fade-up delay-400 text-base leading-relaxed mb-10 max-w-xl"
            style={{
              color: "#A09A8E",
              fontFamily: "Montserrat, sans-serif",
              fontWeight: 300,
            }}
          >
            Você domina a agulha e já fatura múltiplos 5 dígitos. Mas se ainda
            perde horas negociando com clientes que pedem desconto, você atingiu
            o{" "}
            <strong style={{ color: "#F2EDE4", fontWeight: 500 }}>
              teto do seu estúdio.
            </strong>
          </p>

          {/* CTA */}
          <div className="opacity-0 animate-fade-up delay-500">
            <button className="btn-gold" onClick={onCalculate}>
              <span>Calcular meu lucro oculto</span>
              <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="2.5"
                strokeLinecap="round"
                strokeLinejoin="round"
              >
                <path d="M12 5v14M5 12l7 7 7-7" />
              </svg>
            </button>
          </div>

          {/* Trust signal */}
          <p
            className="opacity-0 animate-fade-up delay-600 mt-6 text-xs tracking-widest uppercase"
            style={{ color: "#3A3A3A", fontFamily: "Montserrat, sans-serif" }}
          >
            Diagnóstico gratuito · Sem compromisso
          </p>
        </div>
      </div>

      {/* Scroll indicator */}
      <div
        className="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 opacity-40"
        style={{ color: "#D4AF37" }}
      >
        <span
          className="text-xs tracking-widest uppercase"
          style={{ fontFamily: "Montserrat, sans-serif" }}
        >
          Role
        </span>
        <svg
          width="16"
          height="24"
          viewBox="0 0 16 24"
          fill="none"
          stroke="currentColor"
          strokeWidth="1.5"
        >
          <rect x="1" y="1" width="14" height="22" rx="7" />
          <circle cx="8" cy="8" r="2" fill="currentColor">
            <animateTransform
              attributeName="transform"
              type="translate"
              values="0 0; 0 6; 0 0"
              dur="2s"
              repeatCount="indefinite"
            />
          </circle>
        </svg>
      </div>
    </section>
  );
}

// ─── Calculator Section ──────────────────────────────────────
function CalculatorSection({
  sectionRef,
  onResult,
}: {
  sectionRef: React.RefObject<HTMLElement | null>;
  onResult: (r: CalcResults, inputs: CalcInputs) => void;
}) {
  const [inputs, setInputs] = useState<CalcInputs>({
    faturamento: "",
    ticket: "",
    sessoes: "",
    horas_admin: "",
  });
  const [errors, setErrors] = useState<Partial<CalcInputs>>({});

  const fields = [
    {
      id: "faturamento" as keyof CalcInputs,
      label: "Faturamento Bruto Mensal atual",
      prefix: "R$",
      placeholder: "Ex: 15000",
      hint: "Quanto você fatura em média por mês",
    },
    {
      id: "ticket" as keyof CalcInputs,
      label: "Ticket Médio por sessão",
      prefix: "R$",
      placeholder: "Ex: 1500",
      hint: "Valor médio cobrado por sessão",
    },
    {
      id: "sessoes" as keyof CalcInputs,
      label: "Média de sessões por mês",
      prefix: "#",
      placeholder: "Ex: 10",
      hint: "Quantas sessões você realiza por mês",
    },
    {
      id: "horas_admin" as keyof CalcInputs,
      label: "Horas gastas por dia respondendo clientes no WhatsApp/Direct",
      prefix: "h",
      placeholder: "Ex: 3",
      hint: "Tempo diário gasto com atendimento",
    },
  ];

  function validate(): boolean {
    const newErrors: Partial<CalcInputs> = {};
    fields.forEach(({ id }) => {
      const val = parseFloat(inputs[id]);
      if (!inputs[id] || isNaN(val) || val <= 0) {
        newErrors[id] = "Insira um valor válido maior que zero.";
      }
    });
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  }

  function handleCalculate() {
    if (!validate()) return;

    const faturamento = parseFloat(inputs.faturamento);
    const ticket = parseFloat(inputs.ticket);
    const sessoes = parseFloat(inputs.sessoes);
    const horas_admin = parseFloat(inputs.horas_admin);

    const valor_hora = faturamento / (sessoes * 8);
    const prejuizo_mensal = horas_admin * 22 * valor_hora;
    const potencial_lucro = ticket * 1.2 * sessoes;
    const horas_secretario = horas_admin * 22;

    onResult({ valor_hora, prejuizo_mensal, potencial_lucro, horas_secretario }, inputs);
  }

  return (
    <section
      ref={sectionRef as React.RefObject<HTMLElement>}
      className="relative py-24 md:py-32"
      style={{ background: "#0D0D0D" }}
    >
      {/* Subtle top separator */}
      <div
        className="absolute top-0 left-0 right-0 h-px"
        style={{
          background:
            "linear-gradient(90deg, transparent, rgba(212,175,55,0.3), transparent)",
        }}
      />

      <div className="container">
        {/* Section header */}
        <div className="text-center mb-16">
          <p
            className="text-xs font-semibold tracking-[0.25em] uppercase mb-4"
            style={{ color: "#D4AF37", fontFamily: "Montserrat, sans-serif" }}
          >
            Diagnóstico Financeiro
          </p>
          <h2
            className="font-bold leading-tight mb-6"
            style={{
              fontFamily: "Cormorant Garamond, serif",
              fontSize: "clamp(2rem, 4vw, 3rem)",
              color: "#F2EDE4",
            }}
          >
            A Calculadora do Lucro Oculto
          </h2>
          <GoldDivider className="max-w-xs mx-auto" />
          <p
            className="mt-6 text-sm max-w-md mx-auto leading-relaxed"
            style={{
              color: "#6B6B6B",
              fontFamily: "Montserrat, sans-serif",
              fontWeight: 300,
            }}
          >
            Preencha os campos abaixo com honestidade. O diagnóstico é preciso
            apenas com dados reais.
          </p>
        </div>

        {/* Calculator card */}
        <div className="luxury-card max-w-2xl mx-auto p-8 md:p-12">
          {/* Card inner glow */}
          <div
            className="absolute inset-0 pointer-events-none rounded-sm"
            style={{
              background:
                "radial-gradient(ellipse at top center, rgba(212,175,55,0.04) 0%, transparent 60%)",
            }}
          />

          <div className="space-y-8 relative">
            {fields.map((field, index) => (
              <div key={field.id} className="space-y-2">
                <label
                  htmlFor={field.id}
                  className="block text-xs font-semibold tracking-widest uppercase"
                  style={{
                    color: "#A09A8E",
                    fontFamily: "Montserrat, sans-serif",
                  }}
                >
                  {String(index + 1).padStart(2, "0")} — {field.label}
                </label>
                <div className="relative flex items-center">
                  <span
                    className="absolute left-4 text-sm font-medium select-none"
                    style={{ color: "#D4AF37", fontFamily: "Montserrat, sans-serif" }}
                  >
                    {field.prefix}
                  </span>
                  <input
                    id={field.id}
                    type="number"
                    min="0"
                    step="any"
                    placeholder={field.placeholder}
                    value={inputs[field.id]}
                    onChange={(e) => {
                      setInputs((prev) => ({ ...prev, [field.id]: e.target.value }));
                      if (errors[field.id]) {
                        setErrors((prev) => ({ ...prev, [field.id]: undefined }));
                      }
                    }}
                    className={`luxury-input pl-10 ${errors[field.id] ? "!border-red-500/50" : ""}`}
                  />
                </div>
                {errors[field.id] ? (
                  <p
                    className="text-xs"
                    style={{ color: "#ef4444", fontFamily: "Montserrat, sans-serif" }}
                  >
                    {errors[field.id]}
                  </p>
                ) : (
                  <p
                    className="text-xs"
                    style={{ color: "#3A3A3A", fontFamily: "Montserrat, sans-serif" }}
                  >
                    {field.hint}
                  </p>
                )}
              </div>
            ))}

            {/* Divider */}
            <div className="pt-4">
              <GoldDivider />
            </div>

            {/* Submit */}
            <button
              className="btn-gold w-full text-sm"
              onClick={handleCalculate}
            >
              Ver Diagnóstico
              <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="2.5"
                strokeLinecap="round"
                strokeLinejoin="round"
              >
                <path d="M5 12h14M12 5l7 7-7 7" />
              </svg>
            </button>

            <p
              className="text-center text-xs"
              style={{ color: "#3A3A3A", fontFamily: "Montserrat, sans-serif" }}
            >
              Seus dados são confidenciais e não serão compartilhados.
            </p>
          </div>
        </div>
      </div>
    </section>
  );
}

// ─── Result Section ──────────────────────────────────────────
function ResultSection({
  results,
  inputs,
  onLeadSubmit,
}: {
  results: CalcResults;
  inputs: CalcInputs;
  onLeadSubmit: (data: LeadForm) => void;
}) {
  const submitLeadMutation = trpc.leads.submit.useMutation();
  const [leadForm, setLeadForm] = useState<LeadForm>({
    nome: "",
    whatsapp: "",
    instagram: "",
  });
  const [leadErrors, setLeadErrors] = useState<Partial<LeadForm>>({});
  const [submitted, setSubmitted] = useState(false);
  const [isLoading, setIsLoading] = useState(false);

  const prejuizoCount = useCountUp(Math.round(results.prejuizo_mensal), 2000, true);
  const potencialCount = useCountUp(Math.round(results.potencial_lucro), 2000, true);

  function validateLead(): boolean {
    const errs: Partial<LeadForm> = {};
    if (!leadForm.nome.trim()) errs.nome = "Informe seu nome.";
    if (!leadForm.whatsapp.trim()) errs.whatsapp = "Informe seu WhatsApp.";
    if (!leadForm.instagram.trim()) errs.instagram = "Informe seu Instagram.";
    setLeadErrors(errs);
    return Object.keys(errs).length === 0;
  }

  function handleLeadSubmit() {
    if (!validateLead()) return;
    
    submitLeadMutation.mutate(
      {
        nome: leadForm.nome,
        whatsapp: leadForm.whatsapp,
        instagram: leadForm.instagram,
        faturamento: parseFloat(inputs.faturamento),
        ticket: parseFloat(inputs.ticket),
        sessoes: parseFloat(inputs.sessoes),
        horas_admin: parseFloat(inputs.horas_admin),
        valor_hora: results.valor_hora,
        prejuizo_mensal: results.prejuizo_mensal,
        potencial_lucro: results.potencial_lucro,
        horas_secretario: results.horas_secretario,
      },
      {
        onSuccess: () => {
          setSubmitted(true);
          onLeadSubmit(leadForm);
        },
        onError: (error) => {
          console.error("Erro ao enviar lead:", error);
        },
      }
    );
  }

  if (submitted) {
    return (
      <section
        className="relative py-24 md:py-32 flex items-center justify-center"
        style={{ background: "#0D0D0D", minHeight: "60vh" }}
      >
        <div className="container text-center">
          <div className="luxury-card max-w-lg mx-auto p-12 animate-fade-in">
            <div
              className="w-16 h-16 mx-auto mb-8 flex items-center justify-center"
              style={{ border: "1px solid rgba(212,175,55,0.4)" }}
            >
              <svg
                width="28"
                height="28"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#D4AF37"
                strokeWidth="2"
                strokeLinecap="round"
                strokeLinejoin="round"
              >
                <polyline points="20 6 9 17 4 12" />
              </svg>
            </div>
            <h2
              className="font-bold mb-4"
              style={{
                fontFamily: "Cormorant Garamond, serif",
                fontSize: "2rem",
                color: "#F2EDE4",
              }}
            >
              Recebido com sucesso.
            </h2>
            <GoldDivider className="max-w-xs mx-auto my-6" />
            <p
              className="text-sm leading-relaxed"
              style={{
                color: "#A09A8E",
                fontFamily: "Montserrat, sans-serif",
                fontWeight: 300,
              }}
            >
              Nossa equipe entrará em contato em breve com o seu plano de escala
              personalizado. Verifique seu WhatsApp.
            </p>
          </div>
        </div>
      </section>
    );
  }

  return (
    <section
      className="relative py-24 md:py-32"
      style={{ background: "#0D0D0D" }}
    >
      <div
        className="absolute top-0 left-0 right-0 h-px"
        style={{
          background:
            "linear-gradient(90deg, transparent, rgba(212,175,55,0.3), transparent)",
        }}
      />

      <div className="container">
        {/* Header */}
        <div className="text-center mb-16">
          <p
            className="text-xs font-semibold tracking-[0.25em] uppercase mb-4"
            style={{ color: "#D4AF37", fontFamily: "Montserrat, sans-serif" }}
          >
            Seu Diagnóstico
          </p>
          <h2
            className="font-bold leading-tight mb-6"
            style={{
              fontFamily: "Cormorant Garamond, serif",
              fontSize: "clamp(2rem, 4vw, 3rem)",
              color: "#F2EDE4",
            }}
          >
            O Custo Real do Seu Tempo
          </h2>
          <GoldDivider className="max-w-xs mx-auto" />
        </div>

        {/* Main result card */}
        <div className="luxury-card max-w-2xl mx-auto p-8 md:p-12 mb-8 animate-fade-up">
          {/* Diagnosis text */}
          <div className="mb-10">
            <p
              className="text-base leading-loose"
              style={{
                color: "#A09A8E",
                fontFamily: "Montserrat, sans-serif",
                fontWeight: 300,
              }}
            >
              Você gasta em média{" "}
              <strong
                style={{ color: "#F2EDE4", fontWeight: 600 }}
              >
                {results.horas_secretario} horas por mês
              </strong>{" "}
              sendo secretário de si mesmo. O seu{" "}
              <strong style={{ color: "#F2EDE4", fontWeight: 600 }}>
                Custo de Oportunidade atual
              </strong>{" "}
              (dinheiro perdido) é de:
            </p>
          </div>

          {/* Big loss number */}
          <div className="text-center py-8 mb-10" style={{ borderTop: "1px solid rgba(212,175,55,0.1)", borderBottom: "1px solid rgba(212,175,55,0.1)" }}>
            <p
              className="text-xs font-semibold tracking-[0.25em] uppercase mb-3"
              style={{ color: "#6B6B6B", fontFamily: "Montserrat, sans-serif" }}
            >
              Prejuízo Mensal Estimado
            </p>
            <p
              className="result-value font-bold"
              style={{
                fontFamily: "Cormorant Garamond, serif",
                fontSize: "clamp(2.8rem, 7vw, 5rem)",
                lineHeight: 1,
              }}
            >
              {formatBRL(prejuizoCount)}
            </p>
            <p
              className="text-xs mt-3"
              style={{ color: "#3A3A3A", fontFamily: "Montserrat, sans-serif" }}
            >
              dinheiro que você deixa na mesa todo mês
            </p>
          </div>

          {/* Promise */}
          <div
            className="p-6 mb-10"
            style={{
              background: "rgba(212,175,55,0.05)",
              border: "1px solid rgba(212,175,55,0.15)",
            }}
          >
            <p
              className="text-xs font-semibold tracking-[0.2em] uppercase mb-3"
              style={{ color: "#D4AF37", fontFamily: "Montserrat, sans-serif" }}
            >
              A Promessa
            </p>
            <p
              className="text-sm leading-relaxed"
              style={{
                color: "#A09A8E",
                fontFamily: "Montserrat, sans-serif",
                fontWeight: 300,
              }}
            >
              Com um sistema de captação premium, seu faturamento pode saltar
              para{" "}
              <strong
                className="text-gold-shimmer"
                style={{ fontWeight: 700, fontFamily: "Montserrat, sans-serif" }}
              >
                {formatBRL(potencialCount)}
              </strong>{" "}
              <strong style={{ color: "#F2EDE4", fontWeight: 500 }}>
                sem tatuar uma hora a mais.
              </strong>
            </p>
          </div>

          {/* Blurred teaser */}
          <div className="relative mb-10">
            <div className="blur-lock space-y-3 select-none" aria-hidden>
              <div className="h-3 rounded" style={{ background: "#2A2A2A", width: "90%" }} />
              <div className="h-3 rounded" style={{ background: "#2A2A2A", width: "75%" }} />
              <div className="h-3 rounded" style={{ background: "#2A2A2A", width: "85%" }} />
              <div className="h-3 rounded" style={{ background: "#2A2A2A", width: "60%" }} />
            </div>
            <div
              className="absolute inset-0 flex items-center justify-center"
              style={{ backdropFilter: "blur(2px)" }}
            >
              <div
                className="text-center px-6 py-4"
                style={{
                  background: "rgba(13,13,13,0.85)",
                  border: "1px solid rgba(212,175,55,0.3)",
                }}
              >
                <svg
                  className="mx-auto mb-2"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#D4AF37"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                >
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                  <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                <p
                  className="text-xs font-semibold tracking-widest uppercase"
                  style={{ color: "#D4AF37", fontFamily: "Montserrat, sans-serif" }}
                >
                  Plano de Ação Bloqueado
                </p>
              </div>
            </div>
          </div>

          {/* Lead capture */}
          <div>
            <p
              className="text-sm leading-relaxed mb-8 text-center"
              style={{
                color: "#A09A8E",
                fontFamily: "Montserrat, sans-serif",
                fontWeight: 300,
              }}
            >
              Para ver o plano de ação detalhado de como recuperar esse dinheiro
              e atrair clientes{" "}
              <strong style={{ color: "#F2EDE4", fontWeight: 500 }}>
                High-Ticket
              </strong>
              , preencha abaixo:
            </p>

            <div className="space-y-5">
              {/* Nome */}
              <div className="space-y-2">
                <label
                  htmlFor="lead-nome"
                  className="block text-xs font-semibold tracking-widest uppercase"
                  style={{ color: "#A09A8E", fontFamily: "Montserrat, sans-serif" }}
                >
                  Nome completo
                </label>
                <input
                  id="lead-nome"
                  type="text"
                  placeholder="Seu nome"
                  value={leadForm.nome}
                  onChange={(e) => {
                    setLeadForm((p) => ({ ...p, nome: e.target.value }));
                    if (leadErrors.nome) setLeadErrors((p) => ({ ...p, nome: undefined }));
                  }}
                  className={`luxury-input ${leadErrors.nome ? "!border-red-500/50" : ""}`}
                />
                {leadErrors.nome && (
                  <p className="text-xs" style={{ color: "#ef4444", fontFamily: "Montserrat, sans-serif" }}>
                    {leadErrors.nome}
                  </p>
                )}
              </div>

              {/* WhatsApp */}
              <div className="space-y-2">
                <label
                  htmlFor="lead-whatsapp"
                  className="block text-xs font-semibold tracking-widest uppercase"
                  style={{ color: "#A09A8E", fontFamily: "Montserrat, sans-serif" }}
                >
                  WhatsApp
                </label>
                <input
                  id="lead-whatsapp"
                  type="tel"
                  placeholder="(11) 99999-9999"
                  value={leadForm.whatsapp}
                  onChange={(e) => {
                    setLeadForm((p) => ({ ...p, whatsapp: e.target.value }));
                    if (leadErrors.whatsapp) setLeadErrors((p) => ({ ...p, whatsapp: undefined }));
                  }}
                  className={`luxury-input ${leadErrors.whatsapp ? "!border-red-500/50" : ""}`}
                />
                {leadErrors.whatsapp && (
                  <p className="text-xs" style={{ color: "#ef4444", fontFamily: "Montserrat, sans-serif" }}>
                    {leadErrors.whatsapp}
                  </p>
                )}
              </div>

              {/* Instagram */}
              <div className="space-y-2">
                <label
                  htmlFor="lead-instagram"
                  className="block text-xs font-semibold tracking-widest uppercase"
                  style={{ color: "#A09A8E", fontFamily: "Montserrat, sans-serif" }}
                >
                  @ do Instagram
                </label>
                <div className="relative flex items-center">
                  <span
                    className="absolute left-4 text-sm font-medium select-none"
                    style={{ color: "#D4AF37", fontFamily: "Montserrat, sans-serif" }}
                  >
                    @
                  </span>
                  <input
                    id="lead-instagram"
                    type="text"
                    placeholder="seu.perfil"
                    value={leadForm.instagram}
                    onChange={(e) => {
                      setLeadForm((p) => ({ ...p, instagram: e.target.value }));
                      if (leadErrors.instagram) setLeadErrors((p) => ({ ...p, instagram: undefined }));
                    }}
                    className={`luxury-input pl-10 ${leadErrors.instagram ? "!border-red-500/50" : ""}`}
                  />
                </div>
                {leadErrors.instagram && (
                  <p className="text-xs" style={{ color: "#ef4444", fontFamily: "Montserrat, sans-serif" }}>
                    {leadErrors.instagram}
                  </p>
                )}
              </div>

              {/* Submit */}
              <div className="pt-4">
                <GoldDivider className="mb-8" />
                <button
                  className="btn-gold w-full disabled:opacity-50"
                  onClick={handleLeadSubmit}
                  disabled={isLoading || submitLeadMutation.isPending}
                >
                  {isLoading || submitLeadMutation.isPending ? "Enviando..." : "Quero o Plano de Escala"}
                  {!isLoading && !submitLeadMutation.isPending && (
                    <svg
                      width="16"
                      height="16"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      strokeWidth="2.5"
                      strokeLinecap="round"
                      strokeLinejoin="round"
                    >
                      <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                  )}
                </button>
                <p
                  className="text-center text-xs mt-4"
                  style={{ color: "#3A3A3A", fontFamily: "Montserrat, sans-serif" }}
                >
                  Sem spam. Apenas conteúdo de alto valor para artistas sérios.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

// ─── Footer ──────────────────────────────────────────────────
function Footer() {
  return (
    <footer
      className="relative py-12"
      style={{
        background: "#080808",
        borderTop: "1px solid rgba(212,175,55,0.1)",
      }}
    >
      <div className="container text-center">
        <GoldDivider className="max-w-xs mx-auto mb-8" />
        <p
          className="text-xs tracking-widest uppercase"
          style={{
            color: "#3A3A3A",
            fontFamily: "Montserrat, sans-serif",
          }}
        >
          Desenvolvido para especialistas. Suas informações estão seguras.
        </p>
        <p
          className="text-xs mt-3"
          style={{ color: "#252525", fontFamily: "Montserrat, sans-serif" }}
        >
          © {new Date().getFullYear()} · Todos os direitos reservados
        </p>
      </div>
    </footer>
  );
}

// ─── Main Page ───────────────────────────────────────────────
export default function Home() {
  const calcRef = useRef<HTMLElement | null>(null);
  const resultRef = useRef<HTMLDivElement>(null);

  const [results, setResults] = useState<CalcResults | null>(null);
  const [calcInputs, setCalcInputs] = useState<CalcInputs | null>(null);
  const [showResult, setShowResult] = useState(false);

  function scrollToCalc() {
    calcRef.current?.scrollIntoView({ behavior: "smooth", block: "start" });
  }

  function handleResult(r: CalcResults, inputs: CalcInputs) {
    setResults(r);
    setCalcInputs(inputs);
    setShowResult(true);
    // Scroll to result after state update
    setTimeout(() => {
      resultRef.current?.scrollIntoView({ behavior: "smooth", block: "start" });
    }, 100);
  }

  function handleLeadSubmit(data: LeadForm) {
    // This is called from ResultSection after successful submission
    // The actual API call is handled inside ResultSection
  }

  return (
    <div
      className="min-h-screen"
      style={{ background: "#0D0D0D", fontFamily: "Montserrat, sans-serif" }}
    >
      <HeroSection onCalculate={scrollToCalc} />

      {!showResult && (
        <CalculatorSection sectionRef={calcRef} onResult={handleResult} />
      )}

      {showResult && results && calcInputs && (
        <div ref={resultRef}>
          <ResultSection
            results={results}
            inputs={calcInputs}
            onLeadSubmit={handleLeadSubmit}
          />
        </div>
      )}

      <Footer />
    </div>
  );
}
