# Проект Motors
Стек:
  - Nginx
  - Php 8.0
  - mysql 5.8
  - Nodejs 12
  
  
  - Laravel 8

#### проект докеризирован,доступны следующие команды
весь список команд можно посмотреть в Makefile

разворачивание проекта (выполняеться один раз)
проект будет доступен по http://192.168.150.1
```sh
$ make init
```
поднятие сервисов докера
```sh
$ make up
```
остановка сервисов докера
```sh
$ make down
```
перестройка сервисов
```sh
$ make rebuild
```
