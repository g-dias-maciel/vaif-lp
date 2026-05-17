# 📦 Guia de Instalação - Tattoo LP PHP

## Opção 1: Instalação Local com Docker (Recomendado)

### Pré-requisitos
- Docker Desktop instalado (https://docker.com)
- Git instalado
- Terminal/CMD

### Passo 1: Clonar o Repositório

```bash
git clone seu_repositorio_aqui
cd tattoo-lp-php
```

### Passo 2: Configurar Variáveis de Ambiente

```bash
# Copie o arquivo de exemplo
cp .env.example .env

# Edite o arquivo .env com suas configurações
# Você pode usar seu editor favorito:
nano .env
# ou
code .env
```

**Configurações Essenciais:**

```env
# Database (deixe como está para Docker local)
DB_HOST=mysql
DB_PORT=3306
DB_NAME=tattoo_lp
DB_USER=tattoo_user
DB_PASSWORD=TattooSecure123!@#

# Email - Escolha uma opção:

# Opção A: Mailtrap (Testes - Recomendado para começar)
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_usuario_mailtrap
MAIL_PASSWORD=sua_senha_mailtrap

# Opção B: Gmail (Produção)
# MAIL_HOST=smtp.gmail.com
# MAIL_PORT=587
# MAIL_USERNAME=seu_email@gmail.com
# MAIL_PASSWORD=sua_senha_app

# Opção C: SendGrid (Melhor para produção)
# MAIL_HOST=smtp.sendgrid.net
# MAIL_PORT=587
# MAIL_USERNAME=apikey
# MAIL_PASSWORD=sua_api_key_sendgrid

# Aplicação
APP_ENV=development
APP_DEBUG=true
```

### Passo 3: Iniciar os Containers

```bash
# Opção A: Usar o script (Linux/Mac)
chmod +x start.sh
./start.sh

# Opção B: Comando manual
docker-compose up -d
```

### Passo 4: Aguardar Inicialização

```bash
# Verifique o status
docker-compose ps

# Você deve ver:
# NAME                COMMAND             STATUS
# tattoo-lp-php       apache2-foreground  Up 2 minutes
# tattoo-lp-mysql     docker-entrypoint   Up 2 minutes
```

### Passo 5: Acessar a Aplicação

Abra seu navegador e acesse:
- **URL:** http://localhost:8000
- **Deve aparecer:** Landing page com calculadora

---

## Opção 2: Instalação no Coolify (Self-Hosted)

Veja [COOLIFY_DEPLOYMENT.md](./COOLIFY_DEPLOYMENT.md) para instruções completas.

**Resumo rápido:**
1. Push para GitHub
2. Crie aplicação Docker no Coolify
3. Configure variáveis de ambiente
4. Deploy

---

## Configuração de Email

### Mailtrap (Testes)

1. Acesse https://mailtrap.io
2. Crie conta gratuita
3. Vá em **"Integrations"** → **"SMTP"**
4. Copie as credenciais
5. Adicione ao `.env`

### Gmail (Produção)

1. Acesse https://myaccount.google.com/apppasswords
2. Crie uma senha de aplicativo
3. Use no `.env`:
   ```env
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=seu_email@gmail.com
   MAIL_PASSWORD=sua_senha_app
   ```

### SendGrid (Recomendado)

1. Crie conta em https://sendgrid.com
2. Gere uma API Key
3. Use no `.env`:
   ```env
   MAIL_HOST=smtp.sendgrid.net
   MAIL_PORT=587
   MAIL_USERNAME=apikey
   MAIL_PASSWORD=sua_api_key
   ```

---

## Testes

### Testar Página Principal

```bash
curl http://localhost:8000
# Deve retornar HTML da página
```

### Testar API de Leads

```bash
curl -X POST http://localhost:8000/api/leads/submit \
  -H "Content-Type: application/json" \
  -d '{
    "nome": "Teste Silva",
    "whatsapp": "(11) 99999-9999",
    "instagram": "teste.silva",
    "faturamento": 15000,
    "ticket": 1500,
    "sessoes": 10,
    "horas_admin": 3,
    "valor_hora": 187,
    "prejuizo_mensal": 12375,
    "potencial_lucro": 18000,
    "horas_secretario": 66
  }'
```

**Resposta esperada:**
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

---

## Verificar Logs

```bash
# PHP
docker-compose logs -f php

# MySQL
docker-compose logs -f mysql

# Todos
docker-compose logs -f

# Parar logs: Ctrl+C
```

---

## Parar a Aplicação

```bash
# Parar containers (dados persistem)
docker-compose stop

# Remover containers (dados persistem no volume)
docker-compose down

# Remover tudo incluindo dados
docker-compose down -v
```

---

## Troubleshooting

### Erro: "Cannot connect to Docker daemon"
- Certifique-se que Docker Desktop está rodando
- Reinicie o Docker

### Erro: "Port 8000 already in use"
- Mude a porta em `docker-compose.yml`:
  ```yaml
  ports:
    - "8001:8000"  # Mude 8000 para 8001
  ```

### Erro: "Connection refused" ao conectar no banco
- Aguarde 10-15 segundos para MySQL iniciar
- Verifique credenciais em `.env`
- Reinicie: `docker-compose restart`

### Email não é enviado
- Teste credenciais SMTP em Mailtrap
- Verifique se porta SMTP não está bloqueada
- Veja logs: `docker-compose logs php`

---

## Próximos Passos

1. **Customizar Email** - Edite `src/helpers/email.php`
2. **Adicionar Campos** - Edite `public/home.php` e `database/init.sql`
3. **Integrar Notion** - Adicione sincronização em `src/api/leads.php`
4. **Deploy** - Siga [COOLIFY_DEPLOYMENT.md](./COOLIFY_DEPLOYMENT.md)

---

## Suporte

- 📖 Documentação: [README.md](./README.md)
- 🚀 Deploy: [COOLIFY_DEPLOYMENT.md](./COOLIFY_DEPLOYMENT.md)
- 🐛 Issues: GitHub Issues

---

**Pronto! Sua aplicação deve estar rodando em http://localhost:8000** 🎉
