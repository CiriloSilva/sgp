# 🕰️ SGP – Sistema de Gestão de Pontos

Este SGP (Sistema de Gestão de Pontos) foi desenvolvido exclusivamente para fins de aprendizado na disciplina de POSI, APBD e PWEB. Ele não foi projetado para uso em produção ou para tratamento de dados sensíveis de RH sem revisão de segurança.

> **Projeto acadêmico** desenvolvido como prova de conceito para controle de presença de colaboradores via **ESP8266 + PN532 (RFID)**, com backend **PHP/MySQL** e interface web responsiva.

---

## ✨ Visão geral

| Camada        | Tecnologia | Descrição                                                    |
|---------------|------------|--------------------------------------------------------------|
| **Hardware**  | ESP8266 + PN532 | Lê o UID de pulseiras/cartões RFID e envia via HTTP.      |
| **Backend**   | PHP 8 + MySQL | API `presenca.php` grava o registro e páginas protegidas por sessão. |
| **Frontend**  | HTML/CSS + Vanilla JS | Páginas com modais de feedback, navegação dinâmica e atualização automática de relatório. |

---

## 📂 Estrutura do repositório

```text
firmware/             # Sketch Arduino para ESP8266
sql/schema.sql        # Criação das tabelas (registros, funcionarios, usuarios)
web/                  # Backend PHP + assets
│  ├─ db.php          # Conexão reutilizável + session_start()
│  ├─ presenca.php    # Endpoint que recebe o UID
│  ├─ login.php       # Autenticação
│  ├─ register.php    # Criação de usuário
│  ├─ cadastro.php    # Cadastro de funcionário (somente logados)
│  ├─ relatorio.php   # Relatório público (auto-refresh 5 s)
│  ├─ logout.php
│  ├─ style.css
│  └─ modal.js
README.md             # Este arquivo
```

## 🚀 Guia rápido de instalação
1. Clone ou baixe o repositório.

2. MySQL

```sql
SOURCE sql/schema.sql;
```

3. Servidor PHP

Copie web/ para a raiz do Apache (ex.: /ponto).
Ajuste usuário/senha do MySQL em web/db.php se necessário.

4. Firmware

Edite firmware/rfid_ponto.ino → defina SSID, PASSWORD, SERVER_URL.
Placa: NodeMCU 1.0 (ESP-12E).
Compile e carregue.

5. Fluxo de uso

Acesse http://<host>/ponto/register.html → crie seu usuário.
Faça login em login.html.
Use Cadastro para vincular UID 🔄 nome.
Veja batidas em Relatório (atualiza a cada 5 s).


## 🛠️ Pendente

HTTPS + token de autenticação no endpoint.
Dashboards com gráficos (Chart.js).
