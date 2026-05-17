<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucro Oculto - Calculadora para Tatuadores</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #0D0D0D;
            color: #F2EDE4;
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ─── Header ─── */
        header {
            padding: 40px 0;
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
            position: sticky;
            top: 0;
            background: rgba(13, 13, 13, 0.95);
            backdrop-filter: blur(10px);
            z-index: 100;
        }

        .logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            font-weight: 700;
            color: #D4AF37;
            letter-spacing: 2px;
        }

        /* ─── Hero Section ─── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.05) 0%, transparent 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.3), transparent);
        }

        .hero-content {
            max-width: 800px;
            z-index: 2;
        }

        .hero-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #D4AF37;
            margin-bottom: 20px;
        }

        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.5rem, 8vw, 4.5rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 20px;
            color: #F2EDE4;
        }

        .hero-subtitle {
            font-size: 18px;
            font-weight: 300;
            color: #A09A8E;
            margin-bottom: 40px;
            line-height: 1.8;
        }

        .cta-button {
            display: inline-block;
            padding: 16px 48px;
            background-color: #D4AF37;
            color: #0D0D0D;
            border: none;
            border-radius: 4px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .cta-button:hover {
            background-color: #E8C547;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }

        /* ─── Calculator Section ─── */
        .calculator-section {
            padding: 80px 0;
            scroll-margin-top: 100px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #D4AF37;
            margin-bottom: 15px;
            display: block;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            margin-bottom: 20px;
            color: #F2EDE4;
        }

        .luxury-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(212, 175, 55, 0.15);
            border-radius: 8px;
            padding: 40px;
            backdrop-filter: blur(10px);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #D4AF37;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 4px;
            color: #F2EDE4;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 0.08);
            border-color: #D4AF37;
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.2);
        }

        .form-input::placeholder {
            color: #6B6B6B;
        }

        .btn-calculate {
            width: 100%;
            padding: 16px;
            background-color: #D4AF37;
            color: #0D0D0D;
            border: none;
            border-radius: 4px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-calculate:hover {
            background-color: #E8C547;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }

        .btn-calculate:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        /* ─── Result Section ─── */
        .result-section {
            padding: 80px 0;
            display: none;
            scroll-margin-top: 100px;
        }

        .result-section.active {
            display: block;
        }

        .result-value {
            color: #D4AF37;
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 700;
            line-height: 1;
        }

        .result-box {
            background: rgba(212, 175, 55, 0.05);
            border: 1px solid rgba(212, 175, 55, 0.15);
            padding: 30px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }

        .result-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #6B6B6B;
            margin-bottom: 15px;
        }

        /* ─── Lead Form ─── */
        .lead-form-section {
            margin-top: 60px;
            padding-top: 40px;
            border-top: 1px solid rgba(212, 175, 55, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .success-message {
            text-align: center;
            padding: 60px 20px;
            display: none;
        }

        .success-message.active {
            display: block;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            border: 2px solid rgba(212, 175, 55, 0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .error-message {
            background-color: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: #FF6B6B;
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 15px;
            display: none;
        }

        .error-message.active {
            display: block;
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(212, 175, 55, 0.3);
            border-radius: 50%;
            border-top-color: #D4AF37;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ─── Footer ─── */
        footer {
            padding: 40px 0;
            border-top: 1px solid rgba(212, 175, 55, 0.1);
            text-align: center;
            color: #6B6B6B;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .hero { min-height: 60vh; }
            .luxury-card { padding: 30px 20px; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">LUCRO OCULTO</div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <p class="hero-label">Diagnóstico Financeiro</p>
                <h1 class="hero-title">Descubra Quanto Você Está Perdendo</h1>
                <p class="hero-subtitle">A maioria dos tatuadores de alto padrão deixa entre R$ 10k a R$ 50k na mesa todo mês. Descubra seu número.</p>
                <button class="cta-button" onclick="scrollToCalculator()">Calcular Agora</button>
            </div>
        </section>

        <!-- Calculator Section -->
        <section class="calculator-section" id="calculator">
            <div class="container">
                <div class="section-header">
                    <span class="section-label">Calculadora</span>
                    <h2 class="section-title">Seu Diagnóstico Financeiro</h2>
                </div>

                <div class="luxury-card">
                    <form id="calcForm" onsubmit="handleCalculate(event)">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Faturamento Bruto Mensal (R$)</label>
                                <input type="number" class="form-input" name="faturamento" placeholder="15000" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ticket Médio (R$)</label>
                                <input type="number" class="form-input" name="ticket" placeholder="1500" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Sessões por Mês</label>
                                <input type="number" class="form-input" name="sessoes" placeholder="10" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Horas/dia no WhatsApp</label>
                                <input type="number" class="form-input" name="horas_admin" placeholder="3" required>
                            </div>
                        </div>

                        <button type="submit" class="btn-calculate">Calcular Meu Prejuízo</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Result Section -->
        <section class="result-section" id="resultSection">
            <div class="container">
                <div class="section-header">
                    <span class="section-label">Seu Diagnóstico</span>
                    <h2 class="section-title">Aqui Está a Verdade</h2>
                </div>

                <div class="luxury-card">
                    <div class="result-box">
                        <p class="result-label">Prejuízo Mensal Estimado</p>
                        <p class="result-value" id="prejuizoValue">R$ 0</p>
                        <p style="color: #3A3A3A; margin-top: 10px; font-size: 14px;">dinheiro que você deixa na mesa todo mês</p>
                    </div>

                    <div class="result-box">
                        <p class="result-label">Potencial de Lucro (com sistema premium)</p>
                        <p class="result-value" id="potencialValue">R$ 0</p>
                        <p style="color: #3A3A3A; margin-top: 10px; font-size: 14px;">quanto você poderia ganhar otimizando</p>
                    </div>

                    <!-- Lead Capture Form -->
                    <div class="lead-form-section">
                        <p class="section-label" style="text-align: center;">Receba Seu Plano de Escala</p>
                        <p style="text-align: center; color: #A09A8E; margin-bottom: 30px;">Preencha seus dados e nossa equipe entrará em contato com uma estratégia personalizada</p>

                        <div id="errorMessage" class="error-message"></div>

                        <form id="leadForm" onsubmit="handleLeadSubmit(event)">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Seu Nome</label>
                                    <input type="text" class="form-input" name="nome" placeholder="João Silva" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">WhatsApp</label>
                                    <input type="tel" class="form-input" name="whatsapp" placeholder="(11) 99999-9999" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Instagram</label>
                                <input type="text" class="form-input" name="instagram" placeholder="seu.instagram" required>
                            </div>

                            <button type="submit" class="btn-calculate" id="submitBtn">
                                <span id="submitText">Quero o Plano de Escala</span>
                                <span id="submitLoader" style="display: none;" class="loading"></span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="success-message" id="successMessage">
                    <div class="success-icon">✓</div>
                    <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 28px; margin-bottom: 15px;">Obrigado!</h3>
                    <p style="color: #A09A8E; font-size: 16px;">Nossa equipe entrará em contato em breve com o seu plano de escala personalizado.<br>Verifique seu WhatsApp.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2026 Lucro Oculto. Todos os direitos reservados.</p>
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
                // Calculate progress between 0 and 1
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                
                // Add an "ease-out" math effect so it slows down at the end
                const easeProgress = 1 - Math.pow(1 - progress, 3);
                const current = Math.floor(easeProgress * (end - start) + start);
                
                // Update the text with the Brazilian currency format
                element.textContent = 'R$ ' + current.toLocaleString('pt-BR');
                
                // Continue animation if not finished
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    // Ensure the exact final number is displayed at the end
                    element.textContent = 'R$ ' + end.toLocaleString('pt-BR');
                }
            };
            window.requestAnimationFrame(step);
        }

        function handleCalculate(event) {
            event.preventDefault();
            
            const form = event.target;
            const faturamento = parseFloat(form.faturamento.value);
            const ticket = parseFloat(form.ticket.value);
            const sessoes = parseFloat(form.sessoes.value);
            const horas_admin = parseFloat(form.horas_admin.value);

            // Calculations
            const valor_hora = faturamento / (sessoes * 8);
            const horas_secretario = (horas_admin * 30) * valor_hora / faturamento * sessoes;
            const prejuizo_mensal = Math.round(horas_secretario * valor_hora);
            const potencial_lucro = Math.round(faturamento + (prejuizo_mensal * 0.5));

            // Store values for lead submission
            window.calcData = {
                faturamento,
                ticket,
                sessoes,
                horas_admin,
                valor_hora: Math.round(valor_hora),
                horas_secretario: Math.round(horas_secretario),
                prejuizo_mensal,
                potencial_lucro
            };

            // Get the HTML elements
            const prejuizoEl = document.getElementById('prejuizoValue');
            const potencialEl = document.getElementById('potencialValue');

            // Animate them from 0 to the final value over 2000 milliseconds (2 seconds)
            animateValue(prejuizoEl, 0, prejuizo_mensal, 2000);
            animateValue(potencialEl, 0, potencial_lucro, 2000);
            
            // Show result section
            document.getElementById('resultSection').classList.add('active');
            setTimeout(() => {
                document.getElementById('resultSection').scrollIntoView({ behavior: 'smooth' });
            }, 100);
        }

        async function handleLeadSubmit(event) {
            event.preventDefault();
            
            if (!window.calcData) {
                alert('Por favor, calcule primeiro');
                return;
            }

            const form = event.target;
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitLoader = document.getElementById('submitLoader');
            const errorMessage = document.getElementById('errorMessage');

            // Show loading state
            submitBtn.disabled = true;
            submitText.style.display = 'none';
            submitLoader.style.display = 'inline-block';
            errorMessage.classList.remove('active');

            try {
                const payload = {
                    nome: form.nome.value,
                    whatsapp: form.whatsapp.value,
                    instagram: form.instagram.value,
                    ...window.calcData
                };

                const response = await fetch('/api/leads/submit.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (data.success) {
                    // Hide form and show success message
                    document.getElementById('leadForm').style.display = 'none';
                    document.getElementById('successMessage').classList.add('active');
                } else {
                    throw new Error(data.error || 'Erro ao enviar formulário');
                }
            } catch (error) {
                console.error('Error:', error);
                errorMessage.textContent = error.message;
                errorMessage.classList.add('active');
                
                submitBtn.disabled = false;
                submitText.style.display = 'inline';
                submitLoader.style.display = 'none';
            }
        }
    </script>
</body>
</html>
