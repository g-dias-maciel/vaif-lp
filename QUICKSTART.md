# ⚡ Quick Start - Tattoo LP PHP

## 30 segundos para rodar localmente

### 1. Clonar
```bash
git clone seu_repo
cd tattoo-lp-php
```

### 2. Configurar
```bash
cp .env.example .env
# Edite .env com suas credenciais SMTP (opcional para testes)
```

### 3. Rodar
```bash
docker-compose up -d
```

### 4. Acessar
```
http://localhost:8000
```

✅ Pronto! A calculadora está rodando.

---

## Testar API

```bash
curl -X POST http://localhost:8000/api/leads/submit \
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

---

## Parar

```bash
docker-compose down
```

---

## Próximo: Deploy no Coolify

Veja [COOLIFY_DEPLOYMENT.md](./COOLIFY_DEPLOYMENT.md)

---

**Documentação completa:** [README.md](./README.md)  
**Instalação detalhada:** [INSTALLATION.md](./INSTALLATION.md)
