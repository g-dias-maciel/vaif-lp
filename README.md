# 💰 Lucro Oculto - Calculadora para Tatuadores

Uma landing page luxuosa em **PHP + MySQL** que calcula o prejuízo mensal de tatuadores de alto padrão e captura leads qualificados.

## 🎨 Design

- **Dark Mode Luxury** com tema "Velvet Dark"
- Cores: Fundo #0D0D0D, Texto #F2EDE4, Acento Ouro #D4AF37
- Tipografia: Cormorant Garamond (títulos) + Montserrat (UI)
- Responsivo e otimizado para mobile

## 🚀 Stack Tecnológico

- **Backend:** PHP 8.2 + Apache
- **Database:** MySQL 8.0
- **Frontend:** HTML5 + CSS3 + JavaScript vanilla
- **Containerização:** Docker + Docker Compose
- **Email:** SMTP (Mailtrap, Gmail, SendGrid)

## 📁 Estrutura do Projeto

```
tattoo-lp-php/
├── public/
│   ├── index.php              # Entry point
│   ├── home.php               # Landing page com calculadora
│   └── .htaccess              # URL rewriting
├── src/
│   ├── config/
│   │   ├── env.php            # Environment variables
│   │   └── database.php       # Database connection
│   ├── api/
│   │   └── leads.php          # Lead submission API
│   ├── helpers/
│   │   ├── validation.php     # Input validation
│   │   └── email.php          # Email templates
│   └── router.php             # Request routing
├── database/
│   └── init.sql               # Database schema
├── docker-compose.yml         # Docker services
├── Dockerfile.php             # PHP container
├── .env.example               # Environment template
├── COOLIFY_DEPLOYMENT.md      # Deployment guide
└── README.md                  # This file
```

## 🏃 Quickstart Local

### Pré-requisitos
- Docker e Docker Compose instalados
- Git

### Instalação

```bash
# Clone o repositório
git clone seu_repositorio
cd tattoo-lp-php

# Copie o arquivo de ambiente
cp .env.example .env

# Inicie os containers
docker-compose up -d

# Verifique se está rodando
docker-compose ps

# Acesse http://localhost:8000
```

### Parar os containers

```bash
docker-compose down
```

## 🔧 Configuração

### Variáveis de Ambiente

Edite `.env`:

```bash
# Database
DB_HOST=mysql
DB_NAME=tattoo_lp
DB_USER=tattoo_user
DB_PASSWORD=TattooSecure123!@#

# Email (Mailtrap)
MAIL_HOST=smtp.mailtrap.io
MAIL_USERNAME=seu_usuario
MAIL_PASSWORD=sua_senha

# Application
APP_ENV=production
APP_DEBUG=false
```

### Email

1. **Mailtrap (Testes):** Crie conta em https://mailtrap.io
2. **Gmail (Produção):** Use senhas de aplicativo
3. **SendGrid (Recomendado):** Melhor para volume

## 📊 Funcionalidades

### 1. Landing Page
- Hero section com CTA
- Calculadora interativa
- Resultado com diagnóstico financeiro
- Captura de leads

### 2. Calculadora
- Entrada: Faturamento, ticket, sessões, horas admin
- Saída: Prejuízo mensal, potencial de lucro
- Cálculos em tempo real no navegador

### 3. Captura de Leads
- Formulário com validação
- Salva no banco MySQL
- Envia email automático
- Resposta JSON para frontend

### 4. Email Automático
- Template HTML formatado
- Inclui dados do lead e diagnóstico
- Enviado para marketingvaif@gmail.com

## 🌐 API Endpoints

### POST /api/leads/submit

Submete um novo lead.

**Request:**
```json
{
  "nome": "João Silva",
  "whatsapp": "(11) 99999-9999",
  "instagram": "joao.silva",
  "faturamento": 15000,
  "ticket": 1500,
  "sessoes": 10,
  "horas_admin": 3,
  "valor_hora": 187,
  "prejuizo_mensal": 12375,
  "potencial_lucro": 18000,
  "horas_secretario": 66
}
```

**Response (Sucesso):**
```json
{
  "success": true,
  "message": "Lead criado com sucesso",
  "data": {
    "lead_id": 1,
    "email_sent": true
  }
}
```

**Response (Erro):**
```json
{
  "success": false,
  "error": "Validation failed: Nome é obrigatório"
}
```

### GET /api/leads/list

Retorna lista de leads.

**Response:**
```json
{
  "success": true,
  "message": "Leads retrieved successfully",
  "data": [
    {
      "id": 1,
      "nome": "João Silva",
      "whatsapp": "(11) 99999-9999",
      "instagram": "joao.silva",
      "faturamento": 15000,
      "created_at": "2026-05-17 10:30:00"
    }
  ]
}
```

## 📦 Deploy

### Coolify (Recomendado)

Veja [COOLIFY_DEPLOYMENT.md](./COOLIFY_DEPLOYMENT.md) para instruções detalhadas.

**Resumo:**
1. Push para GitHub
2. Crie aplicação Docker no Coolify
3. Configure variáveis de ambiente
4. Execute migrações
5. Deploy

### Docker Localmente

```bash
# Build
docker-compose build

# Run
docker-compose up -d

# Logs
docker-compose logs -f php

# Stop
docker-compose down
```

## 🐛 Troubleshooting

### Erro: "Connection refused" ao conectar no banco
- Verifique se MySQL está rodando: `docker-compose ps`
- Confirme credenciais em `.env`
- Reinicie: `docker-compose restart`

### Erro: 404 ao acessar página
- Verifique se Apache está rodando
- Confirme que `public/.htaccess` existe
- Reinicie PHP: `docker-compose restart php`

### Email não é enviado
- Teste credenciais SMTP em Mailtrap
- Verifique porta SMTP não está bloqueada
- Confira `MAIL_TO` está correto
- Veja logs: `docker-compose logs php`

## 📝 Logs

```bash
# PHP
docker-compose logs -f php

# MySQL
docker-compose logs -f mysql

# Todos
docker-compose logs -f
```

## 🔐 Segurança

- ✅ Validação de entrada no backend
- ✅ Prepared statements (PDO)
- ✅ Proteção contra SQL injection
- ✅ Sanitização de dados
- ✅ HTTPS recomendado em produção
- ✅ Credenciais em `.env` (não commitado)

## 📈 Próximos Passos

1. **Integração Notion** - Sincronizar leads automaticamente
2. **WhatsApp Business API** - Enviar mensagens automáticas
3. **Dashboard Admin** - Gerenciar leads
4. **Analytics** - Rastrear conversões
5. **A/B Testing** - Otimizar copy e design

## 📞 Suporte

- Documentação: [COOLIFY_DEPLOYMENT.md](./COOLIFY_DEPLOYMENT.md)
- Issues: GitHub Issues
- Email: suporte@tattoo-lp.com

## 📄 Licença

MIT License - Veja LICENSE para detalhes

---

**Desenvolvido com ❤️ para tatuadores de alto padrão**

Versão: 1.0.0  
Última atualização: 2026-05-17
