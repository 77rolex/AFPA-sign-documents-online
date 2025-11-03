=============================== EXPLICATION =================================

## How to use this project
📄 Project Purpose
The goal of this project is to enable four parties to sign an agreement online.
1) The document in question is a convention required for completing an internship during a student’s training. The student (intern) independently finds a real company willing to host them for the internship.
2) Once the intern has found a suitable company and received verbal confirmation, they visit the website (e.g., https://AFPA-sign-documents-online), register, and create the convention in PDF format.
3) After signing the document themselves, the intern copies the generated signature link and sends it to the company (via email, SMS, or any other method). The company follows the link, reviews the document, and signs it.
4) Once the company has signed, the intern notifies their company commandant that the document has been signed by both the intern and the company (notification is optional — the commandant can check the signature status in their dashboard).
5) After the commandant signs, the final approval is expected from the director of the institution (AFPA). Once the director signs, the document becomes fully valid.




🧾 Preconfigured Users
The database file includes 4 preconfigured users:
1) Intern:
Login: user@mail.com
Password: password;
2) Director:
Login: director@mail.com
Password: pass;
3) Commandant of the first company:
Login: commandant_1@mail.com
Password: pass;
4) Commandant of the second company:
Login: commandant_2@mail.com
Password: pass;




👥 User Roles
-Interns register themselves on the website.
-Company commandants receive their login credentials from the system administrator.
-The director also receives login credentials from the system administrator.




🔐 Permissions
-Interns can create, edit, and delete their own conventions.
-Companies can only view and either sign or reject the document.
-Commandants can view conventions created by interns in their own company, and then sign or reject them.
-The director can view all conventions from all interns (across both companies), and has full access: view, sign, reject, edit, or delete if necessary.



=============================== INSTALATION =================================

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

🗃️ Alternative database setup
Instead of running migrations, you can use the prebuilt SQL file:
-In the root of the project, there's an archive named db_convention.7z
-It contains a ready-to-import .sql database dump
-Simply extract the archive and import the SQL file using http://localhost/phpmyadmin
This allows you to skip steps 5 and 6 if you prefer using the provided database snapshot.






