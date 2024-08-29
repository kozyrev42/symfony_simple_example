<p align="center"><a href="https://symfony.com" target="_blank">
    <img src="https://symfony.com/logos/symfony_dynamic_01.svg" alt="Symfony Logo">
</a></p>

1. Создание нового проекта:
`composer create-project symfony/website-skeleton symfony_simple_example`

- Запуск встроенного сервера: 
`php -S localhost:8000 -t public`

 - создан тестовый роут в файле: config/routes.yaml

 - создан тестовый обработчик в файле: src/Controller/TestApiController.php

2. Установил на Ubuntu Symfony CLI

Жизненный цикл запроса в Symfony.


3. Описана начальная структура проекта Symfony.

4. Написал простую консольную команду.

6. Добавлен .env в .gitignore
- Если файл .env уже был закоммичен ранее, Git продолжит отслеживать его изменения. Чтобы полностью удалить его из отслеживания, выполните следующую команду:
`git rm --cached .env` 

### накатить миграции
php bin/console doctrine:migrations:migrate

### откатить последнюю миграцию
php bin/console doctrine:migrations:migrate prev

7. Созданы: Миграция, Сущность, Репозитотрий, Команда консольная для создания поста.

8. Добавлен контроллер для обработки http-запроса. Создание поста.

9. Добавлены методы: вернуть все посты, обновление поста, удаление поста.

10. Создал форму PostType, для валидации входящих данных.

11. Создана сущность Категория + таблица. Категория привязана к Посту.
Данные категории будут подтягиваться вместе с постом, если пост имеет категорию.
Создан PostValidator, для валидации входящих данных.