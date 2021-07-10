Aplikasi CRUD data buku dibangun menggunakan bahasa pemrograman PHP dengan framework laravel 8 dan Bootstrap. 

Fitur aplikasi :

- Insert data
- Edit data
- Delete data
- Update data

==========================================================================================================

Langkah - Langkah install aplikasi

- "composer install" ( Perintah ini akan menginstal library-library atau dependencies yang digunakan Laravel.)
- "copy .env.example .env" ( Perntah ini membuat file .env berdasarkan dari file .env.example )
- "php artisan key:generate" ( Perintah ini akan meng-generate key untuk dimasukkan ke APP_KEY di file .env )

Selanjutnya silahkan buat database dengan nama baru di xampp. Lalu sesuaikan nama database, username, dan password database di file .env.

- "php artisan migrate" ( Perintah ini akan meng-generate table yang dimiliki database aplikasi )

NOTE : Ikuti langkah diatas tanpa tanda petik ( " )
