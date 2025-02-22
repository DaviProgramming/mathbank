#!/bin/bash

INIT_FLAG="/var/www/html/storage/.docker_init"

if [ ! -f "$INIT_FLAG" ]; then
    echo "🚀 Primeira inicialização - executando configurações iniciais..."

    echo "🔍 Limpando cache..."
    php artisan config:clear
    php artisan cache:clear
    php artisan route:clear
    php artisan view:clear

    echo "🔑 Gerando key laravel..."
    php artisan key:generate --force --no-interaction

    echo "🛡️ Gerando key jwt..."
    php artisan jwt:secret --force --no-interaction

    echo "🔍 Verificando conexão com o banco..."
    sleep 2

    function check_db() {
        PGPASSWORD=${DB_PASSWORD} psql -h postgres -U postgres -d math_bank -c '\l' > /dev/null 2>&1
        return $?
    }

    max_retries=3
    count=0

    until check_db; do
        count=$((count + 1))
        if [ $count -gt $max_retries ]; then
            echo "❌ Erro: Falha ao conectar ao banco após $max_retries tentativas"
            echo "📝 Debugando conexão..."
            PGPASSWORD=${DB_PASSWORD} psql -h postgres -U postgres -d math_bank -c '\l'
            exit 1
        fi
        echo "⏳ Tentativa $count de $max_retries - Aguardando banco..."
        sleep 1
    done

    echo "✅ Banco conectado com sucesso!"

    echo "📦 Criando tabelas do sistema..."
    php artisan cache:table
    php artisan session:table
    php artisan queue:table

    echo "🔄 Executando migrations..."
    php artisan migrate --force

    echo "🌱 Executando seeds..."
    php artisan db:seed --force

    # Ajusta permissões
    chmod -R 777 storage bootstrap/cache

    # Cria o arquivo de flag para indicar que a inicialização já foi feita
    touch "$INIT_FLAG"

    echo "✅ Configuração inicial concluída!"
fi

# Se nenhum comando for passado, inicia o servidor
if [ $# -eq 0 ]; then
    exec php artisan serve --host=0.0.0.0
else
    exec "$@"
fi
