#!/bin/bash
echo "==> Fazendo deploy em Homologação..."

# Instala dependências no host (necessário pelo volume mount)
docker run --rm \
  -v $(pwd)/app:/app \
  -w /app \
  composer:latest composer install --no-interaction --prefer-dist --no-blocking

docker compose -f docker/homolog/docker-compose.yml up -d --build
echo "==> Aguardando banco de dados..."
sleep 15
docker compose -f docker/homolog/docker-compose.yml exec -T app_homolog php artisan migrate --force
docker compose -f docker/homolog/docker-compose.yml exec -T app_homolog php artisan db:seed --force

echo ""
echo "✅ Homologação disponível em: http://177.44.248.78:8081"
echo "   Login: admin / senha123"
