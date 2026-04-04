# Build stage
FROM node:22-alpine AS builder

WORKDIR /app

# Install pnpm
RUN npm install -g pnpm

# 1. Copia PRIMEIRO os arquivos de pacote
COPY package.json pnpm-lock.yaml ./

# 2. Copia a pasta patches (se existir)
# A barra no final (patches/) ajuda o Docker a entender que é um diretório
COPY patches/ ./patches/

# 3. AGORA instala as dependências (ele já tem os patches)
RUN pnpm install --frozen-lockfile

# 4. Copia o resto do código
COPY . .

# 5. Build
RUN pnpm build


# Production stage
FROM node:22-alpine

WORKDIR /app

# Install pnpm
RUN npm install -g pnpm

# Copia os arquivos de pacote do builder
COPY --from=builder /app/package.json /app/pnpm-lock.yaml ./
# Copia a pasta patches do builder
COPY --from=builder /app/patches/ ./patches/

# Instala apenas dependências de produção
RUN pnpm install --frozen-lockfile --prod

# Copia a build final
COPY --from=builder /app/dist ./dist

# Expõe a porta
EXPOSE 3000

# Variáveis de ambiente
ENV NODE_ENV=production

# Inicia o app
CMD ["node", "dist/index.js"]
