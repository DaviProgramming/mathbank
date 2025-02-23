# 🏦 MathBank 

![PHP](https://img.shields.io/badge/PHP-8.2-blue.svg)
![Laravel](https://img.shields.io/badge/Laravel-11.x-orange.svg)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-15.x-black.svg)
![Docker](https://img.shields.io/badge/Docker-20.x-brightgreen.svg)

MathBank é uma aplicação que permite realizar transações financeiras 💵, gerenciar usuários 👥 e carteiras 💼. Desenvolvido com o framework Laravel na versão 11 em PHP 8.2, e utilizando PostgreSQL como banco de dados, o projeto oferece uma solução robusta e moderna para quem busca uma plataforma de gerenciamento financeiro. A implementação em Docker facilita a configuração e o uso da aplicação. 🚀

## ✨ Funcionalidades 

- **Gerenciamento de Usuários**: Criação, edição e exclusão de usuários.
- **Gerenciamento de Carteiras**: Controle de múltiplas carteiras por usuário.
- **Transações Financeiras**: Acompanhamento e histórico de transações, incluindo depósitos e saques.

## 🛠️ Tecnologias Utilizadas 

- **Backend**: Laravel 11, PHP 8.2
- **Banco de Dados**: PostgreSQL
- **Containerização**: Docker

## 🔧 Pré-requisitos 

Antes de começar, assegure-se de ter as seguintes ferramentas instaladas em sua máquina:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/)

## 🛠️ Instalação 

1. Clone o repositório:
    ```bash
   git clone https://github.com/DaviProgramming/mathbank.git
    ```
2. Navegue até o diretório do projeto:

   ```bash
   cd mathBank
   ```

3. Construa e inicie os containers Docker:

   ```bash
   docker-compose up --build
   ```

4. Acesse o container do PHP:

   ```bash
   docker exec -it mathbank-app bash
   ```

5. 🌐 Acesse a aplicação através do navegador em `http://localhost:8000`. 

## 🧪 Rodando os Testes 

Para garantir que tudo está funcionando corretamente, você pode rodar os testes da aplicação. Siga os passos abaixo:

1. Acesse o container do PHP:
   ```bash
   docker exec -it app bash
   ```

2. Execute os testes:
   ```bash
   docker compose exec app php artisan test tests/feature
   ```

## 🤝 Contribuição 

Contribuições são bem-vindas! Se você gostaria de ajudar, siga as etapas abaixo:

1. Faça um fork do repositório.
2. Crie sua feature branch (`git checkout -b nova-feature`).
3. Faça suas alterações e commit (`git commit -m 'Adiciona nova feature'`).
4. Envie para o seu repositório (`git push origin nova-feature`).
5. Abra um Pull Request.

## 📄 Licença 

Este projeto está licenciado sob a MIT License. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 📫 Contato 

Para qualquer dúvida, sinta-se à vontade para abrir uma issue ou entrar em contato diretamente.
