# Service Panel
Основное веб-приложение решения кейса. Представляет из себя личный кабинет сотрудника с возможностью выбора и просмотра
сгенерированных одностраничников, а также панель управления, которая предоставляет уполномоченным сотрудникам возможность редактировать
документы и генерировать одностраничники.

Требования для развёртывания:
1) PHP 7.0 и выше
2) Установленный веб-сервер
3) Установленный composer
4) Наличие СУБД

Настройка окружения:
1) Скачать или склонировать проект
2) Произвести установку библиотек проекта путём выполнения команды *composer install* (dev-mode) или *composer install --no-dev --optimize-autoloader* (prod-mode)
3) Настроить переменные окружения в файле *.env*
4) Создать базу данных командой *php bin/console doctrine:database:create*
5) Произвести миграция командой *php bin/console doctrine:migrations:migrate*
6) Заполнить базу данных
7) Сделать в выбранном веб-сервере доменом папку *public*

Для удобства проект был развёрнут [здесь](http://mirror-reflection.ru)

Наработки дизайна в Figma находятся [здесь](https://www.figma.com/file/qbGIpzyoYGONxQDa88DI4g/%D0%A0%D0%BE%D1%81%D0%B0%D1%82%D0%BE%D0%BC)