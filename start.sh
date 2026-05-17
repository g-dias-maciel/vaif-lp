#!/bin/bash

# Tattoo LP - Quick Start Script

echo "🚀 Iniciando Tattoo LP..."

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "❌ Docker não está instalado. Instale em https://docker.com"
    exit 1
fi

# Start containers
echo "📦 Iniciando containers..."
docker-compose up -d

# Wait for MySQL to be ready
echo "⏳ Aguardando MySQL ficar pronto..."
sleep 10

# Check if containers are running
if docker-compose ps | grep -q "Up"; then
    echo "✅ Containers iniciados com sucesso!"
    echo ""
    echo "🌐 Acesse: http://localhost:8000"
    echo "📊 API: http://localhost:8000/api/leads/submit"
    echo ""
    echo "Para ver os logs:"
    echo "  docker-compose logs -f php"
    echo ""
    echo "Para parar:"
    echo "  docker-compose down"
else
    echo "❌ Erro ao iniciar containers"
    docker-compose logs
    exit 1
fi
