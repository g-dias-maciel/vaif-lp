<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucro Oculto - Calculadora para Tatuadores</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --gold: #D4B04C; 
            --bg-dark: #0A0A0A;
            --bg-card: #121212;
            --text-main: rgb(242, 237, 228);   /* Off-white para textos em destaque/Headers */
            --text-muted: rgb(160, 154, 142);  /* Tom neutro para parágrafos */
            --border-color: #222222;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
            background-image: radial-gradient(circle at 80% 20%, rgba(212, 176, 76, 0.05), transparent 40%);
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ─── Animações Globais ─── */
        .fade-in-up {
            opacity: 0;
            transform: translateY(40px);
            animation: fadeInUp 1.2s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        }

        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ─── Tipografia Geral ─── */
        h1, h2, h3, .serif-font {
            font-family: 'Cormorant Garamond', serif;
            color: var(--text-main);
            font-weight: 600;
        }

        strong {
            color: var(--text-main);
            font-weight: 600;
        }

        /* ─── Hero Section ─── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 80px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-content {
            max-width: 650px;
        }

        .hero-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 30px;
            display: block;
            font-family: 'Montserrat', sans-serif;
        }

        .hero-title {
            font-size: clamp(3rem, 6vw, 4.5rem);
            font-weight: 600;
            line-height: 1.1;
            margin-bottom: 40px;
        }

        .hero-title span {
            color: var(--gold);
            font-style: italic;
        }

        .hero-divider {
            display: flex;
            align-items: center;
            margin: 40px 0;
        }

        .hero-divider::before, .hero-divider::after {
            content: '';
            flex-grow: 0;
            width: 40px;
            height: 1px;
            background-color: var(--border-color);
        }

        .diamond {
            width: 6px;
            height: 6px;
            background-color: var(--gold);
            transform: rotate(45deg);
            margin: 0 15px;
        }

        .hero-subtitle {
            font-size: 15px;
            font-weight: 400;
            color: var(--text-muted);
            margin-bottom: 40px;
            line-height: 1.8;
            max-width: 500px;
        }

        .hero-links {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: flex-start;
        }

        .small-text {
            font-size: 10px;
            color: var(--text-muted);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* ─── Botões ─── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 32px;
            background-color: var(--gold);
            color: #000; /* Fica escuro para legibilidade no botão dourado */
            border: none;
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            width: 100%;
        }

        .hero-content .btn-primary {
            width: auto;
        }

        .btn-primary:hover {
            background-color: #E5C35E;
            transform: translateY(-2px);
        }

        /* ─── Calculadora Section ─── */
        .calculator-section {
            padding: 100px 0;
            text-align: center;
            background-color: #0d0d0d;
        }

        .section-header {
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 2.5rem;
            margin: 20px 0;
        }

        .calc-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            padding: 50px;
            text-align: left;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 40px;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .form-label span {
            color: var(--text-main);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-prefix {
            position: absolute;
            left: 20px;
            color: var(--gold);
            font-size: 14px;
            font-weight: 600;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px 16px 50px;
            background-color: #1A1A1A;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--gold);
        }

        .form-input::placeholder {
            color: #444;
        }

        .input-hint {
            display: block;
            font-size: 11px;
            color: var(--text-muted);
            opacity: 0.8;
            margin-top: 8px;
        }

        .divider-center {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 40px 0;
        }

        .divider-center::before, .divider-center::after {
            content: '';
            width: 100%;
            height: 1px;
            background-color: var(--border-color);
        }

        /* ─── Resultados Específicos ─── */
        .result-section {
            display: none;
            padding: 80px 0;
            text-align: center;
        }

        .result-section.active {
            display: block;
            animation: fadeInUp 1s ease forwards;
        }

        .resultado-texto-intro {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 12px;
            text-align: left;
        }

        .divisor-linha {
            width: 100%;
            height: 1px;
            background-color: var(--border-color);
            margin: 30px 0;
        }

        .valor-gigante {
            color: var(--gold);
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3rem, 7vw, 5rem);
            font-weight: 700;
            line-height: 1.1;
            margin: 10px 0;
            text-shadow: 0 0 40px rgba(212, 176, 76, 0.25);
        }

        .promessa-box {
            border: 1px solid rgba(212, 176, 76, 0.15);
            background: rgba(212, 176, 76, 0.03);
            padding: 30px;
            margin: 40px 0;
            text-align: left;
        }

        .promessa-label {
            color: var(--gold);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 15px;
        }

        .promessa-box p {
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.6;
        }

        #potencialValueText {
             color: var(--gold);
        }

        .locked-action {
            position: relative;
            padding: 40px 0;
            margin: 30px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: repeating-linear-gradient(
                180deg,
                rgba(242, 237, 228, 0.02) 0px,
                rgba(242, 237, 228, 0.02) 10px,
                transparent 10px,
                transparent 22px
            );
        }

        .locked-action::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(180deg, var(--bg-card) 0%, transparent 20%, transparent 80%, var(--bg-card) 100%);
            pointer-events: none;
        }

        .locked-box {
            position: relative;
            z-index: 2;
            border: 1px solid rgba(212, 176, 76, 0.3);
            background: #0A0A0A;
            padding: 20px 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .locked-box span {
            color: var(--gold);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 60px 20px;
            border-top: 1px solid var(--border-color);
        }

        @media (max-width: 768px) {
            .calc-card { padding: 30px 20px; }
            .hero-title { font-size: 2.5rem; }
        }
    </style>
</head>
<body>

    <section class="hero">
        <div class="hero-content fade-in-up">
            <span class="hero-label">Exclusivo para artistas do realismo e alto padrão</span>
            <h1 class="hero-title">
                Descubra quanto dinheiro você está <br>
                <span>"deixando na mesa"</span> <br>
                todos os meses no WhatsApp.
            </h1>
            
            <div class="hero-divider fade-in-up delay-1">
                <div class="diamond"></div>
            </div>

            <p class="hero-subtitle fade-in-up delay-2">
                Você domina a agulha e já fatura múltiplos 5 dígitos. Mas se ainda perde horas negociando com clientes que pedem desconto, você atingiu o <strong>teto do seu estúdio.</strong>
            </p>

            <div class="hero-links fade-in-up delay-3">
                <button class="btn-primary" onclick="scrollToCalculator()">Calcular meu lucro oculto &darr;</button>
                <span class="small-text">Diagnóstico Gratuito • Sem Compromisso</span>
            </div>
        </div>
    </section>

    <div style="text-align: center; margin-bottom: 50px; color: var(--gold); font-size: 10px; letter-spacing: 2px; text-transform: uppercase; font-weight: 600;">
        Role <br> <span style="font-size: 16px;">&darr;</span>
    </div>

    <section class="calculator-section" id="calculator">
        <div class="container">
            <div class="section-header">
                <span class="hero-label" style="margin-bottom: 15px; justify-content: center; display: flex;">Diagnóstico Financeiro</span>
                <h2 class="section-title">A Calculadora do Lucro Oculto</h2>
                <div class="divider-center" style="max-width: 200px; margin: 20px auto;">
                    <div class="diamond"></div>
                </div>
                <p style="color: var(--text-muted); font-size: 13px; max-width: 400px; margin: 0 auto;">Preencha os campos abaixo com honestidade. O diagnóstico é preciso apenas com dados reais.</p>
            </div>

            <div class="calc-card">
                <form id="calcForm" onsubmit="handleCalculate(event)">
                    
                    <div class="form-group">
                        <label class="form-label"><span>01 &mdash;</span> Faturamento Bruto Mensal Atual</label>
                        <div class="input-wrapper">
                            <span class="input-prefix">R$</span>
                            <input type="text" inputmode="numeric" class="form-input" name="faturamento" placeholder="Ex: 15.000" required>
                        </div>
                        <span class="input-hint">Quanto você fatura em média por mês</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><span>02 &mdash;</span> Ticket Médio Por Sessão</label>
                        <div class="input-wrapper">
                            <span class="input-prefix">R$</span>
                            <input type="text" inputmode="numeric" class="form-input" name="ticket" placeholder="Ex: 1.500" required>
                        </div>
                        <span class="input-hint">Valor médio cobrado por sessão</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><span>03 &mdash;</span> Média de Sessões Por Mês</label>
                        <div class="input-wrapper">
                            <span class="input-prefix">#</span>
                            <input type="number" class="form-input" name="sessoes" placeholder="Ex: 10" required>
                        </div>
                        <span class="input-hint">Quantas sessões você realiza por mês</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><span>04 &mdash;</span> Horas Gastas Por Dia Respondendo Clientes</label>
                        <div class="input-wrapper">
                            <span class="input-prefix">h</span>
                            <input type="text" inputmode="numeric" class="form-input" name="horas_admin" placeholder="Ex: 3" required>
                        </div>
                        <span class="input-hint">Tempo diário gasto com atendimento no WhatsApp/Direct</span>
                    </div>

                    <div class="divider-center">
                        <div class="diamond"></div>
                    </div>

                    <button type="submit" class="btn-primary">Ver Diagnóstico &rarr;</button>
                    <p style="text-align: center; font-size: 11px; color: var(--text-muted); opacity: 0.7; margin-top: 15px;">Seus dados são confidenciais e não serão compartilhados.</p>
                </form>
            </div>
        </div>
    </section>

    <section class="result-section" id="resultSection">
        <div class="container">
            <div class="section-header">
                <span class="hero-label" style="margin-bottom: 15px; justify-content: center; display: flex;">Seu Diagnóstico</span>
                <h2 class="section-title">O Custo Real do Seu Tempo</h2>
                <div class="divider-center" style="max-width: 200px; margin: 20px auto;">
                    <div class="diamond"></div>
                </div>
            </div>

            <div class="calc-card" style="text-align: center; padding-top: 60px;">
                
                <p class="resultado-texto-intro">Você gasta em média <strong id="horasMesValue">0 horas por mês</strong> sendo secretário de si mesmo.</p>
                <p class="resultado-texto-intro">O seu <strong>Custo de Oportunidade atual</strong> (dinheiro perdido) é de:</p>

                <div class="divisor-linha"></div>

                <p class="form-label" style="text-align: center; letter-spacing: 3px;">Prejuízo Mensal Estimado</p>
                <div class="valor-gigante" id="prejuizoValue">R$ 0,00</div>
                <p style="color: var(--text-muted); opacity: 0.8; font-size: 12px; margin-bottom: 40px;">dinheiro que você deixa na mesa todo mês</p>

                <div class="promessa-box">
                    <span class="promessa-label">A Promessa</span>
                    <p>Com um sistema de captação premium, seu faturamento pode saltar para <strong id="potencialValueText">R$ 0,00</strong> <strong>sem tatuar uma hora a mais.</strong></p>
                </div>

                <div class="locked-action">
                    <div class="locked-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <span>Plano de Ação Bloqueado</span>
                    </div>
                </div>

                <p style="text-align: center; font-size: 14px; color: var(--text-muted); margin: 40px auto; max-width: 500px; line-height: 1.6;">
                    Para ver o plano de ação detalhado de como recuperar esse dinheiro e atrair clientes <strong>High-Ticket</strong>, preencha abaixo:
                </p>

                <form id="leadForm" onsubmit="handleLeadSubmit(event)" style="text-align: left;">
                    <div class="form-group">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" class="form-input" name="nome" placeholder="Seu nome" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">WhatsApp</label>
                        <input type="tel" class="form-input" name="whatsapp" placeholder="(11) 99999-9999" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">@ Do Instagram</label>
                        <div class="input-wrapper">
                            <span class="input-prefix" style="color: var(--gold);">@</span>
                            <input type="text" class="form-input" name="instagram" placeholder="seu.perfil" required>
                        </div>
                    </div>
                    
                    <div class="divider-center">
                        <div class="diamond"></div>
                    </div>

                    <button type="submit" class="btn-primary" id="submitBtn">Quero o Plano de Escala &rarr;</button>
                    <p style="text-align: center; font-size: 11px; color: var(--text-muted); opacity: 0.7; margin-top: 20px;">Sem spam. Apenas conteúdo de alto valor para artistas sérios.</p>
                </form>
                
                <div id="successMessage" style="display: none; padding: 40px 0;">
                    <h3 style="color: var(--gold); font-family: 'Cormorant Garamond', serif; font-size: 2.5rem;">Obrigado.</h3>
                    <p style="color: var(--text-muted); margin-top: 15px; font-size: 16px;">Nossa equipe entrará em contato via WhatsApp em breve.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="diamond" style="margin: 0 auto 30px;"></div>
            <p class="small-text" style="margin-bottom: 10px;">Desenvolvido para especialistas. Suas informações estão seguras.</p>
            <p class="small-text" style="color: var(--text-muted); opacity: 0.6;">&copy; 2026 • Todos os direitos reservados</p>
        </div>
    </footer>

    <script>
        function scrollToCalculator() {
            document.getElementById('calculator').scrollIntoView({ behavior: 'smooth' });
        }

        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const easeProgress = 1 - Math.pow(1 - progress, 3);
                const current = Math.floor(easeProgress * (end - start) + start);
                
                element.textContent = 'R$ ' + current.toLocaleString('pt-BR') + ',00';
                
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    element.textContent = 'R$ ' + end.toLocaleString('pt-BR') + ',00';
                }
            };
            window.requestAnimationFrame(step);
        }

        // Corrigido: Função segura para ler números formatados no padrão BR (Ex: 15.000,50 vira 15000.50)
        function parseBrNumber(val) {
            if (!val) return 0;
            // Tira todos os pontos e troca a vírgula por ponto decimal
            let cleanVal = val.toString().replace(/\./g, '').replace(',', '.');
            return parseFloat(cleanVal) || 0;
        }

        function handleCalculate(event) {
            event.preventDefault();
            
            const form = event.target;
            
            // Lendo os valores e limpando os erros de digitação (pontos/vírgulas)
            const faturamento = parseBrNumber(form.faturamento.value);
            const ticket = parseBrNumber(form.ticket.value);
            const sessoes = parseBrNumber(form.sessoes.value);
            const horas_admin = parseBrNumber(form.horas_admin.value);

            // Lógica matemática corrigida:
            // Assumimos média de 8h por sessão para encontrar o "Valor da Hora" verdadeira tatuando
            const valor_hora = faturamento / (sessoes * 8); 
            const horasTotaisMes = horas_admin * 26;
            
            // Prejuízo = Horas gastas no mês * Valor da sua hora
            const prejuizo_mensal = Math.round(horasTotaisMes * valor_hora);
            
            // Potencial (Conforme sua regra de negócio anterior)
            const potencial_lucro = Math.round(faturamento + (prejuizo_mensal * 0.7));

            window.calcData = {
                faturamento, ticket, sessoes, horas_admin,
                valor_hora: Math.round(valor_hora),
                horas_secretario: Math.round(horasTotaisMes),
                prejuizo_mensal, potencial_lucro
            };

            // Aplica os textos na tela
            document.getElementById('horasMesValue').textContent = horasTotaisMes + ' horas por mês';
            document.getElementById('potencialValueText').textContent = 'R$ ' + potencial_lucro.toLocaleString('pt-BR') + ',00';

            const calcSec = document.getElementById('calculator');
            const resultSec = document.getElementById('resultSection');
            
            // Esconde a calculadora (para não focar no hero, sumimos com ela)
            calcSec.style.display = 'none';
            resultSec.classList.add('active');
            
            // Foca perfeitamente no topo do resultado
            setTimeout(() => {
                resultSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
                animateValue(document.getElementById('prejuizoValue'), 0, prejuizo_mensal, 2500);
            }, 100);
        }
        // Aplica validação em tempo real aos inputs quando a página carrega
        document.addEventListener('DOMContentLoaded', function() {
            const instagramInput = document.querySelector('input[name="instagram"]');
            const whatsappInput = document.querySelector('input[name="whatsapp"]');

            // 1. Bloqueia o "@" e espaços no campo do Instagram
            if (instagramInput) {
                instagramInput.addEventListener('input', function(e) {
                    this.value = this.value.replace(/[@\s]/g, '');
                });
            }

            // 2. Cria a máscara automática para o WhatsApp: (99) 99999-9999
            if (whatsappInput) {
                whatsappInput.addEventListener('input', function(e) {
                    // Remove tudo que não for número
                    let v = this.value.replace(/\D/g, '');
                    
                    // Limita a 11 dígitos no máximo (DDD + 9 dígitos)
                    if (v.length > 11) v = v.substring(0, 11);
                    
                    // Aplica a formatação
                    if (v.length > 2) {
                        v = '(' + v.substring(0, 2) + ') ' + v.substring(2);
                    }
                    if (v.length > 10) {
                        v = v.substring(0, 10) + '-' + v.substring(10);
                    }
                    
                    this.value = v;
                });
            }
        });

        async function handleLeadSubmit(event) {
            event.preventDefault();
            
            const form = event.target;
            const submitBtn = document.getElementById('submitBtn');
            
            // Validação de segurança do WhatsApp antes de enviar
            const whatsappNumeros = form.whatsapp.value.replace(/\D/g, '');
            if (whatsappNumeros.length < 10) {
                alert('Por favor, insira um número de WhatsApp válido com o DDD.');
                form.whatsapp.focus();
                return;
            }

            submitBtn.textContent = 'Enviando...';
            submitBtn.disabled = true;

            try {
                const payload = {
                    nome: form.nome.value,
                    whatsapp: form.whatsapp.value,
                    instagram: form.instagram.value,
                    ...window.calcData
                };

                const response = await fetch('/api/leads/submit.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (data.success) {
                    document.getElementById('leadForm').style.display = 'none';
                    document.querySelector('.locked-action').style.display = 'none';
                    document.getElementById('successMessage').style.display = 'block';
                } else {
                    alert('Erro: ' + (data.error || 'Não foi possível enviar.'));
                    submitBtn.textContent = 'Tentar Novamente';
                    submitBtn.disabled = false;
                }
            } catch (error) {
                alert('Erro de conexão. Verifique sua internet.');
                submitBtn.textContent = 'Quero o Plano de Escala \u2192';
                submitBtn.disabled = false;
            }
        }
    </script>
</body>
</html>