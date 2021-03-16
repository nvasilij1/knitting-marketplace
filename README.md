## About Knitting Marketplace

Бамп базы данных mysql файл
knitting_marketplace.sql

### Api и административная панель торговой площадки ВсёСвязано

Роуты для тестов

{{localmarket}} - Имя вашего локального сервера

1. Вернет товары по магазину 4
```
Method Get
http://{{localmarket}}/api/category_id/4
```

2. Вернет список не заблокированных магазинов
```
Method Get
http://{{localmarket}}/api/get_category
```

3. Добавит новый магазин 

```
Method POST
http://{{localmarket}}/api/post_create_market
```
С параметрами
```
vk_oid - идентификатор vk страницы
vk_name - имя 
vk_surname - фамилия
encoded_string - картинка магазина в base64 
```

4. Изменить данные магазина

```
Method POST
http://{{localmarket}}/api/post_market_edit_form
```
С параметрами
```
vk_oid - идентификатор vk страницы
email - email магазина 
category_name - название магазина
market_description - описание магазина
email_notification - разрешить присылать уведомления по email
push_notification - разрешить присылать уведомления на телефон
```

Не забываем переименовать .env.example в .env и внести данные о соединении с базой данных

### Тесты
Проверяем роут /api/get_category
Нам известно, что в базе есть category_id = 1, его проверим в ответе JSON сервера
```
tests/Feature/CategoryTest.php
```


### Для проверки url в Postman файл 

New Knitting Marketplace.postman_collection.json

## Security Vulnerabilities

If you discover a security vulnerability within Marketplace, please send an e-mail to Vasiliy Nesterov via [nvasilij1@yandex.ru](mailto:nvasilij1@yandex.ru). All security vulnerabilities will be promptly addressed.

## License

Is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
