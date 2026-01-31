# Быстрый Старт - Что Делать Дальше?
# Quick Start - What To Do Next?

## 🎯 Вы открыли проект в VS Code. Что дальше?

### Шаг 1: Установите Рекомендуемые Расширения

VS Code предложит установить расширения - **нажмите "Install All"** (Установить все)

Или установите вручную:
1. Нажмите `Ctrl+Shift+X` (открыть Extensions)
2. Найдите и установите:
   - PHP Intelephense
   - PHP Debug
   - Live Server
   - HTML CSS Support

### Шаг 2: Убедитесь, что XAMPP Запущен

1. Откройте **XAMPP Control Panel**
2. Нажмите **Start** для Apache
3. Нажмите **Start** для MySQL
4. Оба должны быть зелеными

### Шаг 3: Создайте Базу Данных

1. Откройте браузер: http://localhost/phpmyadmin
2. Нажмите **"New"** (Новая база данных)
3. Имя: `group_project_web`
4. Нажмите **"Create"** (Создать)
5. Выполните этот SQL код (вкладка SQL):

```sql
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

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_code VARCHAR(50),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_code) REFERENCES students(student_code)
);

-- Создаем тестового администратора (пароль: admin123)
INSERT INTO admins (username, password) VALUES 
('admin', '$2y$10$YourHashedPasswordHere');
```

### Шаг 4: Запустите Проект

**Вариант A - Через XAMPP:**
1. Скопируйте папку проекта в `C:\xampp\htdocs\`
2. Откройте: http://localhost/PROJECT/auth.html

**Вариант B - Встроенный PHP сервер (в VS Code):**
1. В VS Code нажмите `Ctrl+Shift+P`
2. Введите "Tasks: Run Task"
3. Выберите "Start PHP Server"
4. Откройте: http://localhost:8000/auth.html

### Шаг 5: Протестируйте Сайт

1. **Зарегистрируйтесь:**
   - Откройте http://localhost:8000/auth.html
   - Нажмите "Register Now"
   - Заполните форму регистрации
   - Нажмите "Register"

2. **Войдите в систему:**
   - Вернитесь на страницу входа
   - Введите ваш student code и пароль
   - Нажмите "Login"

3. **Проверьте функции:**
   - Главная страница должна загрузиться
   - Попробуйте перейти в Chat
   - Проверьте другие разделы меню

---

## 🔧 Полезные Команды в VS Code

### Терминал (открыть: Ctrl+`)

```bash
# Запустить PHP сервер
php -S localhost:8000

# Проверить версию PHP
php -v

# Проверить синтаксис файла
php -l filename.php
```

### Горячие Клавиши

- `Ctrl+P` - Быстрый поиск файлов
- `Ctrl+Shift+F` - Поиск по всему проекту
- `Ctrl+B` - Показать/скрыть боковую панель
- `Ctrl+`` - Открыть терминал
- `F5` - Запустить отладку
- `Ctrl+/` - Закомментировать строку

---

## 📝 Структура Файлов

### Пользовательские Страницы:
- `auth.html` - Выбор входа/регистрации
- `login.html` - Форма входа
- `register.html` - Форма регистрации
- `index.php` - Главная страница
- `about.html` - О университете
- `programs.html` - Программы
- `contacts.html` - Контакты
- `chat.html` - Чат

### Административные Страницы:
- `admin_login.html` - Вход администратора
- `admin_dashboard.php` - Панель управления
- `admin_students.php` - Управление студентами
- `admin_chat.php` - Управление чатом

### PHP Скрипты:
- `config.php` - Настройки БД
- `login.php` - Обработка входа
- `register.php` - Обработка регистрации
- `chat.php` - Сохранение сообщений
- `get_chat.php` - Получение сообщений

---

## ❓ Частые Проблемы

### "Connection failed"
➡️ Убедитесь, что MySQL запущен в XAMPP

### PHP код показывается как текст
➡️ Используйте `http://localhost/...`, а не `file://...`

### Страница не загружается
➡️ Проверьте, что Apache запущен в XAMPP

### База данных не найдена
➡️ Создайте БД `group_project_web` в phpMyAdmin

---

## 📚 Следующие Шаги

1. ✅ Изучите код в файлах
2. ✅ Попробуйте изменить дизайн (CSS файлы)
3. ✅ Добавьте новые функции
4. ✅ Прочитайте полное руководство: [SETUP_GUIDE.md](SETUP_GUIDE.md)

---

## 🎓 Полезные Ресурсы

- **PHP Документация:** https://www.php.net/manual/ru/
- **W3Schools PHP:** https://www.w3schools.com/php/
- **VS Code Документация:** https://code.visualstudio.com/docs
- **MySQL Tutorial:** https://www.w3schools.com/mysql/

---

**Успехов в разработке! 🚀**

Если возникли проблемы - смотрите [SETUP_GUIDE.md](SETUP_GUIDE.md)
