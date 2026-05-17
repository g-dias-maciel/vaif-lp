# 🚀 Deploy no Coolify com Nixpacks

## Por que Nixpacks?

Nixpacks é mais moderno, confiável e resolve muitos problemas com Docker manual:
- ✅ Detecção automática de linguagem (PHP)
- ✅ Gerenciamento de dependências
- ✅ Melhor performance
- ✅ Menos erros de compatibilidade
- ✅ Suporte nativo para variáveis de ambiente

---

## Passo 1: Preparar o Repositório

```bash
cd tattoo-lp-php

# Certifique-se que tem os arquivos:
# - nixpacks.toml (configuração)
# - database/migrate.php (migrações)
# - public/index.php (entry point)
# - src/ (código PHP)

git add .
git commit -m "Add Nixpacks configuration"
git push origin main
```

---

## Passo 2: Criar Aplicação no Coolify

1. **Abra seu painel Coolify**
2. Clique em **"New Application"**
3. Selecione **"GitHub"** como source
4. Escolha seu repositório `tattoo-lp-php`
5. Clique em **"Create"**

---

## Passo 3: Configurar Build

Na aplicação criada:

1. Vá em **"Build"** ou **"Settings"**
2. Deixe como padrão (Nixpacks detectará automaticamente)
3. Se precisar customizar:
   - **Build Pack:** Nixpacks (automático)
   - **Build Command:** (deixe em branco - Nixpacks cuida)
   - **Start Command:** (deixe em branco - Nixpacks cuida)

---

## Passo 4: Configurar Variáveis de Ambiente

1. Vá em **"Environment"** ou **"Variables"**
2. Adicione:

```env
# Database
DB_HOST=seu_mysql_host
DB_PORT=3306
DB_NAME=tattoo_lp
DB_USER=tattoo_user
DB_PASSWORD=SenhaForte123!@#

# Email
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

---

## Passo 5: Configurar Pre-Deploy Command

1. Vá em **"Deployments"** ou **"Build Settings"**
2. Procure por **"Pre-deploy commands"** ou **"Build hooks"**
3. Adicione:

```bash
php database/migrate.php
```

---

## Passo 6: Deploy

1. Clique em **"Deploy"** ou **"Build & Deploy"**
2. Aguarde o build completar (~3-5 minutos)
3. Quando ficar **"Running"** (verde), acesse a URL

---

## Verificação Pós-Deploy

### 1. Acessar a Página

```bash
curl https://seu_dominio.com
# Deve retornar HTML da página
```

### 2. Testar API

```bash
curl -X POST https://seu_dominio.com/api/leads/submit \
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

### 3. Verificar Logs

No Coolify:
1. Clique na aplicação
2. Vá em **"Logs"**
3. Procure por erros

---

## Troubleshooting

### Erro: "PHP not found"
- Nixpacks detecta automaticamente
- Certifique-se que tem arquivos `.php` na raiz ou em `public/`

### Erro: "Database connection refused"
- Verifique `DB_HOST` está correto
- Confirme credenciais do banco
- Teste conexão manualmente

### Erro: "Migration failed"
- Verifique `database/init.sql` existe
- Verifique `database/migrate.php` está correto
- Veja logs: `docker logs seu_container`

### Erro: 404 ao acessar página
- Verifique `public/index.php` existe
- Confirme `.htaccess` foi criado
- Reinicie a aplicação

---

## Diferenças: Docker vs Nixpacks

| Aspecto | Docker | Nixpacks |
|--------|--------|----------|
| Configuração | Manual (Dockerfile) | Automática (nixpacks.toml) |
| Complexidade | Alta | Baixa |
| Performance | Boa | Excelente |
| Debugging | Difícil | Fácil |
| Tamanho da imagem | Grande | Pequeno |
| Suporte Coolify | Bom | Nativo |

---

## Próximos Passos

1. **Domínio Customizado** - Configure seu domínio no Coolify
2. **SSL/HTTPS** - Ative automaticamente
3. **Backups** - Configure backups automáticos do banco
4. **Monitoring** - Monitore performance

---

## Suporte

- 📖 Documentação Nixpacks: https://nixpacks.com
- 🚀 Documentação Coolify: https://coolify.io/docs
- 🐛 Logs: Veja na aba "Logs" do Coolify

---

**Pronto para deploy com Nixpacks! 🚀**
