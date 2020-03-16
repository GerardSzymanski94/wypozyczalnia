#Laravel Admin

Paczka laravela z zainstalowanym panelem admina

### Instalacja 


Instalacja niezbędnych bibliotek

```bash
composer install
```

Instalacja podstawowych tabel i utworzenie admina
```php
php artisan migrate --seed
```

Dane do logowania do panelu admina

```php
url: /administracja
login: admin@admin.pl
hasło: 123qwe
```

### Podstawowa organizacja plików

Controllers - Admin
```bash
php artisan make Admin/NameController
```

Kontrolery należy dziedziczyć po Admin/BaseController