# Ročníkový projekt - Samoobslužná půjčovna paddleboardů

## Požadavky na prostředí

Pro správný běh aplikace je nutné mít nainstalováno:
- PHP 8.1 nebo novější
- Composer
- Symfony CLI
- MySQL server (např. v rámci balíku XAMPP)

## Postup instalace a spuštění

### 1. Příprava databáze

1. Spusťte MySQL server (XAMPP Control Panel).
2. Otevřete rozhraní phpMyAdmin.
3. Vytvořte novou prázdnou databázi s názvem: paddleboardy
4. Vyberte vytvořenou databázi a proveďte import SQL souboru ze složky projektu:
   database/paddleboardy.sql

### 2. Konfigurace spojení a Mailtrapu (.env.local)

1. V kořenovém adresáři projektu vytvořte nový soubor s názvem: .env.local
2. Do tohoto souboru vložte následující konfiguraci (upravte dle svých lokálních přístupů):

```
# Nastavení spojení s databází
DATABASE_URL="mysql://root:@127.0.0.1:3306/paddleboardy?serverVersion=8.0.32&charset=utf8mb4"
# Nastavení odesílání e-mailů přes Mailtrap
# Nahraďte USER a PASSWORD svými údaji z Mailtrap.io
MAILER_DSN="smtp://USER:PASSWORD@sandbox.smtp.mailtrap.io:2525"
```

### 3. Instalace závislostí

Otevřete terminál v adresáři projektu a spusťte příkaz pro instalaci knihoven:

```
composer install
```

### 4. Spuštění aplikace

Aplikaci spustíte pomocí lokálního Symfony serveru příkazem:

```
symfony serve
```

Po spuštění bude webová aplikace dostupná na adrese: http://127.0.0.1:8000
