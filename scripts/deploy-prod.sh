#!/bin/bash
echo "==> Fazendo deploy em Produção..."

# Instala dependências no host (necessário pelo volume mount)
docker run --rm \
  -v $(pwd)/app:/app \
  -w /app \
  composer:latest composer install --no-interaction --prefer-dist --no-blocking

docker compose -f docker/prod/docker-compose.yml up -d --build
echo "==> Aguardando banco de dados..."
sleep 15
docker compose -f docker/prod/docker-compose.yml exec -T app_prod php artisan migrate --force
docker compose -f docker/prod/docker-compose.yml exec -T app_prod php artisan db:seed --force

echo ""
echo "✅ Produção disponível em: http://177.44.248.78:8082"
echo "   Login: admin / senha123"
