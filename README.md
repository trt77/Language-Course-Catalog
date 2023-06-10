<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Launch

1. Uruchomienie projektu wymaga PHP, Composer, Node.js i NPM. Instrukcja 
instalacji tych narzędzi znajduje się w dokumentacji Laravel:
Installation - Laravel - The PHP Framework For Web Artisans
2. Wypakuj katalog z projektem po czym przejdź do wypakowanego katalogu 
używając terminala (Win + R, ‘cmd.exe’), w tym celu użyj komendy cd 
„sciezka_do_katalogu”
3. Uruchom polecenie composer install
4. Uruchom polecenie npm install
5. Kolejny krok wymaga instalacji PostgreSQL wraz z narzędziem pgAdmin (jeśli 
nie są zainstalowane). Zarówno PostgreSQL jak i pgAdmin są zawarte w 
instalatorze dostępnym pod tym adresem: PostgreSQL: Windows installers.
6. Skorzystaj z narzędzia pgAdmin, aby utworzyć nową bazę danych. Zanotuj 
nazwę bazy danych, nazwę użytkownika i hasło, które będziesz potrzebował do 
następnego kroku. Jeśli nie masz zainstalowanego narzędzia pgAdmin, możesz 
je pobrać i zainstalować tutaj: PostgreSQL: Windows installers Instalator 
Link do pobrania narzędzia pgAdmin: Download (pgadmin.org)
7. Skopiuj plik .env.example do nowego pliku o nazwie .env. W pliku .env ustaw 
parametry DB_DATABASE, DB_USERNAME i DB_PASSWORD na 
odpowiednie wartości, które zanotowałeś podczas tworzenia bazy danych.
Pamiętaj, że projekt zakłada użycie systemu PostgreSQL.
8. Uruchom polecenie php artisan key:generate, aby wygenerować klucz 
aplikacji Laravel. Klucz ten jest wymagany dla wszystkich aplikacji Laravel i 
służy do zabezpieczania sesji użytkownika oraz danych szyfrowanych.
9. Uruchom polecenie php artisan storage:link
10.Uruchom polecenie php artisan migrate
11.Wybierz A lub B. Jeśli uruchamiasz projekt bez wypełniania przykładowymi 
danymi, z jednym domyślnym kontem administratora – uruchom polecenie A. 
Jeśli uruchamiasz projekt wypełniony danymi do celów testowych z jednym 
domyślnym kontem administratora i jednym testowym kontem użytkownika –
uruchom polecenie B.
A: php artisan db:seed --class=AdminUserSeeder
B: php artisan db:seed
12.Uruchom polecenie php artisan serve
13.Uruchom przeglądarkę i przejdź do adresu URL serwera deweloperskiego 
(domyślnie jest to http://127.0.0.1:8000). Adres ten wyświetla się w terminalu




## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
