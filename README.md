# Pulling Data API Importer
Приложение загружает данные из внешнего API и сохраняет их в MySQL.
## Используемый стек
- PHP 8.3
- Laravel 13.15.0
- MySQL 8
- Docker
- Docker Compose
## Импортируемые сущности
- Incomes
- Orders
- Sales
- Stocks
## Запуск проекта
### Клонирование репозитория
```bash
git clone url
```
```bash
cd name
```
### Поднять контейнеры
```bash
docker compose up -d --build
```
### Установка зависимостей
```bash
docker compose exec app composer install
```
### Настройка окружения
Создать файл .env:
```bash
cp .env.example .env
```
Сгенерировать ключ приложения:
```bash
docker compose exec app php artisan key:generate
```
### Выполнение миграций
```bash
docker compose exec app php artisan migrate
```
## Настройка API
В файле .env необходимо указать:\
PULLING_DATA_URL=\<URL>\
PULLING_DATA_KEY=\<KEY>
## Настройка БД
DB_CONNECTION=mysql\
DB_HOST=\<HOST>\
DB_PORT=3306\
DB_DATABASE=\<DATABASE>\
DB_USERNAME=\<USERNAME>\
DB_PASSWORD=\<PASSWORD>
## Запуск импорта
Для загрузки всех данных используется Artisan-команда:
```bash
docker compose exec app php artisan app:sync-data
```
Команда последовательно импортирует:
1. Incomes
2. Orders
3. Sales
4. Stocks

## БД резвернул
Доступ:\
Host: thomas.proxy.rlwy.net\
Port: 57017\
Database: railway\
Username: reviewer\
Password: StrongPassword123\

Таблицы:
- incomes
- orders
- sales
- stocks
