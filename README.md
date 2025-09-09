# PHP проект - «Менеджер задач»
### Hexlet tests and linter status:
[![Actions Status](https://github.com/mkolotovich/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/mkolotovich/php-project-57/actions)
[![PHP CI](https://github.com/mkolotovich/php-project-57/actions/workflows/workflow.yml/badge.svg)](https://github.com/mkolotovich/php-project-48/actions/workflows/workflow.yml)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=mkolotovich_php-project-57&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=mkolotovich_php-project-57)

## Описание
Task Manager – система управления задачами, подобная http://www.redmine.org/. Она позволяет ставить задачи, назначать исполнителей и менять их статусы. Для работы с системой требуется регистрация и аутентификация.
![главная страница](https://cdn2.hexlet.io/store/derivatives/original/5c115ebd54fc50471937adbcc329d947.png)
![статусы](https://cdn2.hexlet.io/store/derivatives/original/29b62867fe159bf0d3d74696f054cd83.png)
![задачи](https://cdn2.hexlet.io/store/derivatives/original/a9f3f5f5f788fac8acd8dc5f1ea9913e.png)

## Требования
1. Убедитесь, что у вас установлен PHP версии 8.2 или выше. В противном случае установите PHP версии 8.2 или выше.
2. Создайте файл .env в котором пропишите переменную окружения MAIL_PORT которая задаёт подключение к почте. Также создайте переменные окружения MAIL_USERNAME, MAIL_PASSWORD, MAIL_FROM_ADDRESS, MAIL_FROM_NAME и задайте им значение имя пользователя почты, пароль почты, адрес отправителя и имя отправителя соответсвенно.

## Установка 

```sh
$ make build
```
## Запуск локального сервера

```sh
$ make dev
open http://localhost:5000
```

## Запуск линтера
```sh
$ make lint
```
Ссылка на деплой - https://php-project-57-44yv.onrender.com