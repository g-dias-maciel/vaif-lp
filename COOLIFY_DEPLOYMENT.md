# 🚀 Guia Completo de Deploy no Coolify

## Índice
1. [Pré-requisitos](#pré-requisitos)
2. [Preparação do Projeto](#preparação-do-projeto)
3. [Deploy no Coolify](#deploy-no-coolify)
4. [Configuração do Banco de Dados](#configuração-do-banco-de-dados)
5. [Configuração de Email](#configuração-de-email)
6. [Troubleshooting](#troubleshooting)

---

## Pré-requisitos

- ✅ Conta no Coolify (self-hosted ou cloud)
- ✅ Repositório GitHub com o código
- ✅ Docker instalado localmente (para testes)
- ✅ Acesso SSH ao servidor Coolify (se self-hosted)

---

## Preparação do Projeto

### 1. Criar Arquivo .env

Crie um arquivo `.env` na raiz do projeto:

```bash
# Database Configuration
DB_HOST=mysql
DB_PORT=3306
DB_NAME=tattoo_lp
DB_USER=tattoo_user
DB_PASSWORD=TattooSecure123!@#

# Email Configuration
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_usuario_mailtrap
MAIL_PASSWORD=sua_senha_mailtrap
MAIL_FROM=noreply@tattoo-lp.com
MAIL_TO=marketingvaif@gmail.com

# Application
APP_ENV=production
APP_DEBUG=false
```

**Nota:** Este arquivo NÃO deve ser commitado no Git. Adicione ao `.gitignore`.

### 2. Testar Localmente com Docker

```bash
# Build e inicie os containers
docker-compose up -d

# Verifique se está rodando
docker-compose ps

# Acesse http://localhost:8000
```

### 3. Fazer Push para GitHub

```bash
git add .
git commit -m "Initial commit: PHP + MySQL tattoo calculator"
git push origin main
```

---

## Deploy no Coolify

### Passo 1: Criar Aplicação PHP

1. Abra seu painel Coolify
2. Clique em **"New Application"**
3. Selecione **"Docker"** como tipo
4. Escolha **"GitHub"** como source
5. Selecione seu repositório
6. Configure:
   - **Name:** `tattoo-lp-php`
   - **Build Pack:** Docker
   - **Dockerfile:** `Dockerfile.php`
   - **Port:** `8000`

### Passo 2: Criar Banco de Dados MySQL

1. No Coolify, clique em **"New Service"** → **"MySQL"**
2. Configure:
   - **Name:** `tattoo-lp-mysql`
   - **Version:** 8.0
   - **Root Password:** Crie uma senha forte
   - **Database:** `tattoo_lp`
   - **User:** `tattoo_user`
   - **Password:** `TattooSecure123!@#`

3. Aguarde até ficar **"Running"** (verde)

### Passo 3: Conectar Aplicação ao Banco

1. Na aplicação PHP, vá em **"Environment"** ou **"Variables"**
2. Adicione as variáveis de ambiente:

```
DB_HOST=tattoo-lp-mysql
DB_PORT=3306
DB_NAME=tattoo_lp
DB_USER=tattoo_user
DB_PASSWORD=TattooSecure123!@#
APP_ENV=production
APP_DEBUG=false
```

### Passo 4: Executar Migrações

Antes do primeiro deploy, você precisa criar as tabelas no banco:

**Opção A: Via Coolify UI**
1. Na aplicação, vá em **"Deployments"**
2. Clique em **"Pre-deploy commands"**
3. Adicione:
   ```bash
   mysql -h${DB_HOST} -u${DB_USER} -p${DB_PASSWORD} ${DB_NAME} < database/init.sql
   ```

**Opção B: Via SSH (se self-hosted)**
```bash
ssh seu_usuario@seu_servidor
cd /caminho/do/projeto
mysql -h localhost -u tattoo_user -p tattoo_lp < database/init.sql
```

### Passo 5: Deploy

1. Clique em **"Deploy"** na aplicação
2. Aguarde o build completar (~5-10 minutos na primeira vez)
3. Quando ficar **"Running"**, acesse a URL fornecida

---

## Configuração de Email

### Usando Mailtrap (Recomendado para Testes)

1. Acesse https://mailtrap.io
2. Crie uma conta gratuita
3. Crie um novo projeto
4. Vá em **"SMTP Settings"**
5. Copie as credenciais:
   - **Host:** smtp.mailtrap.io
   - **Port:** 2525
   - **Username:** seu_usuario
   - **Password:** sua_senha

6. Adicione ao Coolify:
   ```
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=seu_usuario_mailtrap
   MAIL_PASSWORD=sua_senha_mailtrap
   ```

### Usando Gmail (Produção)

1. Ative "Senhas de Aplicativo" no Gmail
2. Gere uma senha de aplicativo
3. Configure:
   ```
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=seu_email@gmail.com
   MAIL_PASSWORD=sua_senha_app
   ```

### Usando SendGrid (Melhor para Produção)

1. Crie conta em https://sendgrid.com
2. Gere uma API Key
3. Configure:
   ```
   MAIL_HOST=smtp.sendgrid.net
   MAIL_PORT=587
   MAIL_USERNAME=apikey
   MAIL_PASSWORD=sua_api_key_sendgrid
   ```

---

## Verificação Pós-Deploy

### 1. Testar Página Principal

```bash
curl http://seu_dominio.com
# Deve retornar HTML da página
```

### 2. Testar API de Leads

```bash
curl -X POST http://seu_dominio.com/api/leads/submit \
  -H "Content-Type: application/json" \
  -d '{
    "nome": "Teste",
    "whatsapp": "(11) 99999-9999",
    "instagram": "teste",
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

Resposta esperada:
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

### 3. Verificar Logs

No Coolify:
1. Clique na aplicação
2. Vá em **"Logs"**
3. Procure por mensagens de erro

---

## Troubleshooting

### Erro: "Connection refused" ao conectar no banco

**Causa:** Aplicação não consegue alcançar o MySQL

**Solução:**
1. Verifique se o MySQL está em status "Running"
2. Confirme que `DB_HOST` está correto (deve ser o nome do serviço MySQL)
3. Teste a conexão manualmente:
   ```bash
   mysql -h seu_host -u tattoo_user -p tattoo_lp
   ```

### Erro: 404 ao acessar a página

**Causa:** Apache não está servindo os arquivos corretamente

**Solução:**
1. Verifique se o Dockerfile.php está correto
2. Confirme que o arquivo `public/.htaccess` existe
3. Reinicie o container:
   ```bash
   docker-compose restart php
   ```

### Email não é enviado

**Causa:** Credenciais SMTP incorretas ou firewall bloqueando

**Solução:**
1. Teste as credenciais SMTP localmente
2. Verifique se a porta SMTP não está bloqueada
3. Confirme que `MAIL_TO` está correto
4. Verifique os logs da aplicação

### Banco de dados não foi criado

**Causa:** Migrações não foram executadas

**Solução:**
1. Execute manualmente via SSH:
   ```bash
   mysql -h localhost -u tattoo_user -p tattoo_lp < database/init.sql
   ```
2. Ou via Coolify UI, execute o comando de pré-deploy

---

## Configuração de Domínio Customizado

1. No Coolify, vá em sua aplicação
2. Clique em **"Domains"** ou **"Custom Domain"**
3. Adicione seu domínio (ex: `tattoo-calc.com.br`)
4. Configure o DNS:
   - **Type:** CNAME ou A record
   - **Value:** Conforme instruções do Coolify
5. Aguarde propagação DNS (~24h)

---

## Backup e Manutenção

### Backup do Banco de Dados

```bash
# Local
docker-compose exec mysql mysqldump -u tattoo_user -p tattoo_lp > backup.sql

# Via SSH (Coolify)
ssh seu_usuario@seu_servidor
docker exec tattoo-lp-mysql mysqldump -u tattoo_user -p tattoo_lp > /backups/tattoo_lp_$(date +%Y%m%d).sql
```

### Restaurar Backup

```bash
mysql -u tattoo_user -p tattoo_lp < backup.sql
```

### Monitorar Logs

```bash
# Local
docker-compose logs -f php

# Via SSH
docker logs -f tattoo-lp-php
```

---

## Próximos Passos

1. **Integração com Notion** - Sincronizar leads automaticamente
2. **WhatsApp Business API** - Enviar mensagens automáticas
3. **Dashboard Admin** - Visualizar e gerenciar leads
4. **Analytics** - Rastrear conversões e ROI

---

## Suporte

Se tiver problemas:
1. Verifique os logs no Coolify
2. Teste localmente com `docker-compose up`
3. Consulte a documentação do Coolify: https://coolify.io/docs

---

**Última atualização:** 2026-05-17
**Versão:** 1.0
