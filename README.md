### Команды

```sh
docker-compose up -d
```

Выполнить миграции
```sh
docker-compose exec app php artisan migrate
```

Заполнить базу данных
```sh
docker-compose exec app php artisan db:seed
```


