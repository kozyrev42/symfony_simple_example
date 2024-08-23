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