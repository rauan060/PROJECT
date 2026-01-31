# IITU University Website - Полное Руководство по Настройке
# IITU University Website - Complete Setup Guide

## О Проекте / About Project

Это веб-сайт Международного Университета Информационных Технологий (IITU), созданный с использованием PHP, HTML и CSS. Проект включает систему аутентификации студентов, чат, административную панель и информационные страницы о университете.

This is a website for the International Information Technology University (IITU), created using PHP, HTML, and CSS. The project includes student authentication, chat system, admin panel, and informational pages about the university.

---

## 📋 Содержание / Table of Contents

1. [Требования](#требования--requirements)
2. [Установка VS Code](#установка-vs-code)
3. [Установка Необходимых Программ](#установка-необходимых-программ)
4. [Настройка Проекта](#настройка-проекта)
5. [Структура Проекта](#структура-проекта)
6. [Запуск Проекта](#запуск-проекта)
7. [Использование VS Code](#использование-vs-code)
8. [Решение Проблем](#решение-проблем)

---

## 🔧 Требования / Requirements

### Программное обеспечение / Software:
- **Visual Studio Code** (последняя версия / latest version)
- **PHP** 7.4 или выше / or higher
- **MySQL** 5.7 или выше / or higher
- **Apache** или **XAMPP** / or **XAMPP**
- **Git** (опционально / optional)

---

## 💻 Установка VS Code

### Windows:
1. Скачайте VS Code с официального сайта: https://code.visualstudio.com/
2. Запустите установщик `VSCodeSetup.exe`
3. Следуйте инструкциям установщика
4. Рекомендуется добавить VS Code в PATH (опция "Add to PATH" во время установки)

### macOS:
1. Скачайте VS Code с: https://code.visualstudio.com/
2. Откройте `.dmg` файл
3. Перетащите Visual Studio Code в папку Applications

### Linux (Ubuntu/Debian):
```bash
sudo apt update
sudo apt install software-properties-common apt-transport-https wget
wget -q https://packages.microsoft.com/keys/microsoft.asc -O- | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://packages.microsoft.com/repos/vscode stable main"
sudo apt update
sudo apt install code
```

---

## 🛠️ Установка Необходимых Программ

### Вариант 1: Использование XAMPP (Рекомендуется для начинающих)

**Windows:**
1. Скачайте XAMPP: https://www.apachefriends.org/
2. Установите XAMPP в `C:\xampp`
3. Запустите XAMPP Control Panel
4. Запустите модули Apache и MySQL

**macOS:**
1. Скачайте XAMPP для macOS
2. Установите в `/Applications/XAMPP`
3. Откройте XAMPP Manager
4. Запустите Apache и MySQL

**Linux:**
```bash
wget https://www.apachefriends.org/xampp-files/8.2.4/xampp-linux-x64-8.2.4-0-installer.run
chmod +x xampp-linux-x64-8.2.4-0-installer.run
sudo ./xampp-linux-x64-8.2.4-0-installer.run
```

### Вариант 2: Установка Отдельных Компонентов

**PHP (Windows):**
1. Скачайте PHP: https://windows.php.net/download/
2. Распакуйте в `C:\php`
3. Добавьте `C:\php` в переменную PATH
4. Переименуйте `php.ini-development` в `php.ini`

**PHP (macOS):**
```bash
brew install php
```

**PHP (Linux):**
```bash
sudo apt update
sudo apt install php php-mysql php-mbstring php-xml
```

**MySQL:**
- Windows/macOS: https://dev.mysql.com/downloads/mysql/
- Linux: `sudo apt install mysql-server`

---

## ⚙️ Настройка Проекта

### Шаг 1: Клонирование Проекта

```bash
# Создайте папку для проекта
mkdir C:\xampp\htdocs\iitu-project  # Windows
mkdir /Applications/XAMPP/htdocs/iitu-project  # macOS
mkdir /opt/lampp/htdocs/iitu-project  # Linux

# Скопируйте все файлы проекта в эту папку
# Или используйте Git (если настроен):
git clone <repository-url> C:\xampp\htdocs\iitu-project
```

### Шаг 2: Настройка Базы Данных

1. Откройте браузер и перейдите: http://localhost/phpmyadmin
2. Создайте новую базу данных:
   - Нажмите "New" (Новая)
   - Имя базы данных: `group_project_web`
   - Кодировка: `utf8mb4_general_ci`
   - Нажмите "Create" (Создать)

3. Импортируйте таблицы (если есть SQL файл):
   - Выберите базу данных `group_project_web`
   - Перейдите на вкладку "Import" (Импорт)
   - Выберите файл SQL
   - Нажмите "Go" (Вперед)

4. Создайте таблицы вручную (если нет SQL файла):

```sql
-- Таблица студентов
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_code VARCHAR(50) UNIQUE NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    birth_date DATE,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Таблица администраторов
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Таблица сообщений чата
CREATE TABLE chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_code VARCHAR(50),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_code) REFERENCES students(student_code)
);
```

### Шаг 3: Настройка Конфигурации

Откройте файл `config.php` и убедитесь, что настройки правильные:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Если у MySQL есть пароль, укажите его здесь
define('DB_NAME', 'group_project_web');
?>
```

---

## 📁 Структура Проекта

```
PROJECT/
│
├── .vscode/                    # Настройки VS Code
│   ├── settings.json          # Настройки рабочего пространства
│   ├── extensions.json        # Рекомендуемые расширения
│   └── launch.json            # Конфигурация отладки
│
├── deleted/                    # Удаленные файлы
│
├── *.html                     # HTML страницы
│   ├── index.php              # Главная страница (требует авторизации)
│   ├── auth.html              # Страница выбора входа/регистрации
│   ├── login.html             # Форма входа студента
│   ├── register.html          # Форма регистрации студента
│   ├── about.html             # О университете
│   ├── programs.html          # Программы обучения
│   ├── admissions.html        # Поступление
│   ├── contacts.html          # Контакты
│   ├── chat.html              # Чат студентов
│   ├── admin_login.html       # Вход для администратора
│   └── header.html            # Шапка сайта
│
├── *.php                      # PHP скрипты
│   ├── login.php              # Обработка входа
│   ├── register.php           # Обработка регистрации
│   ├── config.php             # Конфигурация БД
│   ├── chat.php               # Отправка сообщений
│   ├── get_chat.php           # Получение сообщений
│   ├── admin_dashboard.php    # Панель администратора
│   ├── admin_students.php     # Управление студентами
│   ├── admin_chat.php         # Чат администратора
│   ├── edit_student.php       # Редактирование студента
│   ├── update_student.php     # Обновление данных студента
│   └── delete_student.php     # Удаление студента
│
├── *.css                      # Стили
│   ├── index.css              # Стили главной страницы
│   ├── auth.css               # Стили авторизации
│   ├── login.css              # Стили входа
│   ├── register.css           # Стили регистрации
│   ├── about.css              # Стили страницы "О нас"
│   ├── header.css             # Стили шапки
│   ├── chat.css               # Стили чата
│   ├── admin.css              # Стили админ-панели
│   └── style.css              # Общие стили
│
├── *.jpg, *.png               # Изображения
│   ├── logo.png               # Логотип университета
│   ├── univer.jpg             # Фото университета
│   ├── background.jpg         # Фоновое изображение
│   └── ...                    # Другие изображения
│
├── README.md                  # Краткое описание
├── SETUP_GUIDE.md             # Это руководство
└── .gitattributes             # Настройки Git
```

### Описание Основных Файлов:

#### Страницы Пользователя:
- **auth.html** - Стартовая страница с выбором входа/регистрации
- **login.html** - Форма входа для зарегистрированных студентов
- **register.html** - Форма регистрации новых студентов
- **index.php** - Главная страница (доступна только после входа)
- **chat.html** - Чат для общения студентов

#### Административные Страницы:
- **admin_login.html** - Вход для администратора
- **admin_dashboard.php** - Главная панель администратора
- **admin_students.php** - Управление списком студентов
- **admin_chat.php** - Просмотр и управление чатом

#### PHP Обработчики:
- **config.php** - Подключение к базе данных
- **login.php** - Проверка учетных данных и создание сессии
- **register.php** - Регистрация нового студента
- **chat.php** - Сохранение сообщений в БД
- **get_chat.php** - Получение сообщений из БД

---

## 🚀 Запуск Проекта

### Метод 1: Использование XAMPP

1. **Запустите XAMPP Control Panel**
2. **Запустите Apache и MySQL**
3. **Откройте браузер** и перейдите:
   ```
   http://localhost/iitu-project/auth.html
   ```

### Метод 2: Встроенный PHP сервер (для разработки)

```bash
# Перейдите в папку проекта
cd C:\xampp\htdocs\iitu-project

# Запустите встроенный PHP сервер
php -S localhost:8000

# Откройте в браузере:
# http://localhost:8000/auth.html
```

### Метод 3: Использование Live Server в VS Code

1. Установите расширение "Live Server" в VS Code
2. Откройте файл `auth.html`
3. Нажмите правой кнопкой мыши → "Open with Live Server"
4. **Важно:** MySQL должен быть запущен для работы PHP функционала

---

## 🎨 Использование VS Code

### Установка Рекомендуемых Расширений

При открытии проекта VS Code предложит установить рекомендуемые расширения:

1. **PHP Intelephense** - Автодополнение и анализ PHP кода
2. **PHP Debug** - Отладка PHP приложений
3. **HTML CSS Support** - Поддержка HTML и CSS
4. **Auto Rename Tag** - Автоматическое переименование парных тегов
5. **Auto Close Tag** - Автоматическое закрытие тегов
6. **Live Server** - Локальный сервер для разработки
7. **Prettier** - Форматирование кода

### Горячие Клавиши / Keyboard Shortcuts:

- **Ctrl+P** (Cmd+P на Mac) - Быстрый поиск файлов
- **Ctrl+Shift+F** - Поиск по всем файлам
- **Ctrl+`** - Открыть/закрыть терминал
- **F5** - Запустить отладку
- **Ctrl+Shift+P** - Открыть Command Palette
- **Alt+Up/Down** - Переместить строку вверх/вниз
- **Ctrl+D** - Выделить следующее совпадение
- **Ctrl+/** - Закомментировать/раскомментировать строку

### Полезные Команды в Терминале VS Code:

```bash
# Запустить PHP сервер
php -S localhost:8000

# Проверить версию PHP
php -v

# Проверить синтаксис PHP файла
php -l filename.php

# Запустить MySQL (если установлен отдельно)
mysql -u root -p
```

### Отладка PHP в VS Code:

1. Установите расширение "PHP Debug"
2. Установите Xdebug для PHP
3. Настройте `php.ini`:
   ```ini
   [XDebug]
   zend_extension = "path/to/xdebug"
   xdebug.mode = debug
   xdebug.start_with_request = yes
   xdebug.client_port = 9003
   ```
4. Установите точку останова (клик на номере строки)
5. Нажмите F5 для запуска отладки

---

## 🔍 Работа с Проектом

### Тестирование Функционала:

#### 1. Регистрация Студента:
1. Откройте http://localhost/iitu-project/auth.html
2. Нажмите "Register" (Регистрация)
3. Заполните форму регистрации
4. Проверьте, что студент добавлен в БД (phpMyAdmin)

#### 2. Вход в Систему:
1. Вернитесь на auth.html
2. Нажмите "Login" (Вход)
3. Введите student_code и пароль
4. Должна открыться главная страница index.php

#### 3. Тестирование Чата:
1. Войдите в систему
2. Перейдите в раздел "Chat"
3. Отправьте сообщение
4. Обновите страницу - сообщение должно отображаться

#### 4. Административная Панель:
1. Откройте admin_login.html
2. Войдите с учетными данными администратора
3. Проверьте функции управления студентами

### Добавление Нового Функционала:

#### Пример: Добавление новой страницы

1. Создайте HTML файл:
```html
<!-- new_page.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>New Page</h1>
    <!-- Ваш контент -->
</body>
</html>
```

2. Создайте CSS файл:
```css
/* new_page.css */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
}
```

3. Добавьте ссылку в навигацию (header.html):
```html
<li><a href="new_page.html">New Page</a></li>
```

---

## ❓ Решение Проблем

### Проблема: "Connection failed" при подключении к БД

**Решение:**
1. Убедитесь, что MySQL запущен (XAMPP Control Panel)
2. Проверьте настройки в `config.php`
3. Убедитесь, что база данных `group_project_web` существует

### Проблема: Страница не загружается

**Решение:**
1. Проверьте, что Apache запущен
2. Убедитесь, что путь к файлу правильный
3. Проверьте консоль браузера (F12) на наличие ошибок

### Проблема: PHP код отображается как текст

**Решение:**
1. Убедитесь, что используете `.php` расширение
2. Откройте файл через `http://localhost/...`, а не `file://...`
3. Убедитесь, что Apache правильно настроен для обработки PHP

### Проблема: "Session expired" при входе

**Решение:**
1. Очистите cookies браузера
2. Проверьте настройки сессии в PHP
3. Убедитесь, что файлы сессии могут быть созданы

### Проблема: Расширения VS Code не работают

**Решение:**
1. Перезапустите VS Code
2. Проверьте, что расширения установлены и включены
3. Проверьте путь к PHP в настройках VS Code

---

## 📚 Дополнительные Ресурсы

### Документация:
- **PHP:** https://www.php.net/manual/ru/
- **MySQL:** https://dev.mysql.com/doc/
- **HTML/CSS:** https://developer.mozilla.org/ru/
- **VS Code:** https://code.visualstudio.com/docs

### Обучающие Материалы:
- **PHP Tutorial:** https://www.w3schools.com/php/
- **MySQL Tutorial:** https://www.w3schools.com/mysql/
- **HTML/CSS Tutorial:** https://www.w3schools.com/html/

---

## 👥 Авторы

Проект создан: Rauan, Aruzhan и Miras

---

## 📝 Лицензия

Этот проект создан в образовательных целях для IITU.

---

## 🤝 Вклад в Проект

Если вы хотите внести изменения:
1. Создайте новую ветку: `git checkout -b feature/your-feature`
2. Внесите изменения
3. Закоммитьте: `git commit -m "Add some feature"`
4. Отправьте: `git push origin feature/your-feature`

---

## ☎️ Поддержка

При возникновении проблем:
1. Проверьте раздел "Решение Проблем" выше
2. Обратитесь к документации
3. Создайте issue в репозитории

---

**Успешной разработки! / Happy Coding!** 🚀
