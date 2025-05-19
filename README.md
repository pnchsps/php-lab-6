# Отчет по лабораторной работе №6

## Тема

Взаимодействие с базой данных. Авторизация и аутентификация.

## Цель

Разработка веб-приложения для платформы проведения городских мероприятий с регистрацией и авторизацией граждан.

## Структура проекта

```
event_platform/
├── admin/
│   ├— add_registration.php
│   ├— attendees.php
│   ├— event_edit.php
│   └— event_list.php
├── config.php
├── events.php
├── header.php
├── init.php
├── login.php
├── logout.php
├── record.php
└── register.php
```

## Инструкция по запуску

1. Скопируйте проект в папку, доступную в Apache (XAMPP/Denwer/...)
2. Запустите MySQL и Apache
3. Откройте [http://localhost/EVENT\_PLATFORM/init.php](http://localhost/EVENT_PLATFORM/init.php)
4. База данных будет создана автоматически
5. Посещайте `register.php`, чтобы создать пользователя

## Документация

*Для работы с бд я использовала PDО из личного интереса и для того, чтобы минимализировать использование панели phpmyadmin.

### roles

* id
* name (user, manager)

### users

* id, name, email, password, token, role\_id (FK)

### events

* id, name, price, number\_seats, date

### event\_records

* id, user\_id (FK), event\_id (FK)

### Возможности для ролей (доп. уровень)

* capabilities
* roles\_capabilities

## Функции

* Регистрация и авторизация с токенами
* Просмотр мероприятий
* Запись на мероприятие
* Админ-панель для manager:

  * Добавление/редактирование мероприятий
  * Просмотр посетителей мероприятий

## Примеры использования

### Просмотр мероприятий

```php
$stmt = $pdo->query("SELECT * FROM events ORDER BY date ASC");
```

### Запись на мероприятие

```php
$pdo->prepare("INSERT INTO event_records (user_id, event_id) VALUES (?, ?)")
    ->execute([$user['id'], $_GET['event_id']]);
```

## Ответы на контрольные вопросы

**1. Что такое аутентификация?**

* Это процесс проверки личности (логин/пароль).

**2. А авторизация?**

* Это определение, что этот пользователь может делать (роли, права).

**3. Зачем нужен token?**

* Это ключ, по которому сервер понимает, кто сделал запрос.

**4. Зачем роли?**

* Ограничивать доступ: user vs manager.

## Источники

* [https://www.php.net](https://www.php.net)
* [https://www.mysql.com](https://www.mysql.com)
* [https://github.com](https://github.com)

## Дополнительно

* Проект поддерживает расширяемую схему ролей (capabilities).
* Код простой, расширяемый и подходит для начинающих разработчиков.
