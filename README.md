## How to start this project
1.	Clone the repository	git clone https://github.com/77rolex/AFPA-sign-documents-online.git
2.	Enter the project directory	cd AFPA-sign-documents-online
3.	Install PHP dependencies	composer install
4.	Create .env.local file with DB credentials	Add:<br>APP_ENV=dev<br>APP_SECRET=your_app_secret<br>DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=8.0"
5.	Create the database	php bin/console doctrine:database:create
6.	Run database migrations	php bin/console doctrine:migrations:migrate
7.	(Optional) Load demo fixtures	php bin/console doctrine:fixtures:load
8.	Install frontend assets (if used)	npm install && npm run build
9.	Start local server (Symfony CLI)	symfony server:start
10.	Or start with PHP built-in server	php -S localhost:8000 -t public
✅	Open in browser	http://localhost:8000
