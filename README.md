## Установка
1. `composer install`
2. Настройте `.env.local` с параметрами MySQL
3. `php bin/console doctrine:database:create`
4. `php bin/console doctrine:migrations:migrate`
5. `symfony server:start`