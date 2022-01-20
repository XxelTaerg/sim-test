### Начальные данные

```sh
docker-compose up -d
```

Чтобы  заполнить базу данных
```sh
docker-compose exec app php artisan db:seed
```
