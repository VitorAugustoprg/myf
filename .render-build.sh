#!/usr/bin/env bash

# Atualiza os pacotes
apt-get update && apt-get install -y php php-cli php-mbstring

# Instala dependências do Composer, se necessário
# composer install
