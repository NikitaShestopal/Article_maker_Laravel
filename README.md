Podcast CMS (JSON-based)
Сучасна та легка система керування контентом (CMS) для подкастів та публікацій, побудована на Laravel 12 та Livewire. Проєкт використовує локальне сховище JSON як базу даних, що робить його ідеальним для швидкого розгортання та тестування.

Особливості (Features)
Повний CRUD: Створення, читання та редагування статей/подкастів.

No-DB Engine: Вся робота ведеться через локальні JSON-файли (Laravel Storage).

Side Drawer: Форма додавання нової статті виїжджає справа (через FAB-кнопку +).

Blur Effects: Використання backdrop-filter для фокусування на контенті.

Responsive Grid: Адаптивна сітка карток для будь-яких пристроїв.

Laravel Power: Використання колекцій (Collections), маршрутизації та Blade-шаблонів.

Швидкий старт (Setup)
1. Встановлення залежностей
composer install
npm install && npm run dev

2. Налаштування середовища
cp .env.example .env
php artisan key:generate

3. Підготовка сховища
Переконайтеся, що файл podcasts.json (або ваш шлях у контролері) існує в storage/app/private/ або storage/app/public/.
php artisan storage:link

4. Запуск
php artisan serve
Проєкт буде доступний за адресою: http://localhost:8000
