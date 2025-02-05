# Запуск 

```bash
php -S localhost:8000 -t public
```

- Важно указать порт 8000, если будете запускать api-client

Пример запроса:
- `GET http://localhost:8000/random` → `{ "id": "unique_id", "number": 42 }`
- `GET http://localhost:8000/get?id=unique_id` → `{ "id": "unique_id", "number": 42 }`

# API Client

```bash
php tests/api-client/test.php
```

- Запускалось на PHP 8.3.15
