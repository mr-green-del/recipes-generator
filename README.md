## Зависимости

- docker
- docker-compose

## Установка

В корне проекта выполнить команду:
```bash
    make install
```

## Нюансы

- Проект доступен по адресу localhost:8080
- Методы апи для теста:
    - POST:
        - http://localhost:8080/api/recipes/make/dcii
    - GET:
        - http://localhost:8080/api/recipes/ingredients
        - http://localhost:8080/api/recipes/ingredient_types
