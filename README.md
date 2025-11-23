# Laravel + Vue + inertiajs + tailwind

## Persiapan

Untuk menjalankan project berikut, pastikan anda sudah menginstall composer, php, laravel, nodejs, npm, postgresql.

link-link berikut dapat membantu anda untuk menginstall & mengkonfigurasi semua kebutuhan tersebut:
- [php+composer+nodejs+npm+laravel](https://www.youtube.com/watch?v=-uERuBkURfM).
- [inertiajs](https://inertiajs.com/docs/v2/getting-started).
- [postgresql](https://www.datacamp.com/tutorial/installing-postgresql-windows-macosx).

## Install
Setelah mempersiapkan hal-hal sebelumnya & melakukan pull project ke local computer, kita perlu mengkoneksikan postgresql dengan laravel, sebab default database yang digunakan adalah sqlite.

untuk melakukannya ikuti tutorial berikut:
- [connect laravel to postgresql](https://www.youtube.com/watch?v=vrJUMNXgppw).

setelah itu kita memasukkan command:
```bash
npm install
```

setelah mengkoneksikan postgresql dengan laravel & melakukan install package, maka kita bisa lanjut melakukan migrasi database menggunakan command:

```bash
php artisan migrate:fresh
```

kemudian kita bisa mulai menyalakan aplikasi:
```bash
composer run dev
```
aplikasi akan berjalan default di localhost:8000
## Menjalankan Aplikasi

Untuk menjalankan aplikasi kita perlu register terlebih dahulu, kemudian jika sudah registrasi, kita bisa langsung login menggunakan email & password yang kita register.

jika sudah login terdapat halaman daftar nilai. karena masih kosong, kita bisa menambahkan siswa terlebih dahulu, melalui tombol tambah siswa. Kemudian jika sudah, kita bisa menambahkan nilai mata pelajara tertentu untuk siswa tersebut.

Jika nilai sudah tampil di daftar, kita bisa melakukan edit maupun delete nilai tersebut.

## Arsitektur & Alasan penggunaan
Arsitektur yang digunakan adalah monolitic dengan kombinasi laravel + vuejs yang di jembatani inertiajs, ditambah dengan tailwind untuk styling.

Alasan penggunaan arsitektur tersebut karena lebih mudah jika dibandingkan dengan aplikasi terpisah. fitur yang masih sederhana & scope penggunaan yang sempit, membuat arsitektur ini menjadi lebih ideal. Lebih lanjut waktu deployment lebih cepat jika menggunakan arsitektur monolitik.

## License

This is open-sourced software licensed under the MIT license.
