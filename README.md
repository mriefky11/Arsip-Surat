# Arsip Surat

Aplikasi arsip surat ini merupakan aplikasi berbasis web yang dibuat menggunakan php 7.4 dengan framework laravel 8, untuk database yang digunakan adalah MySQL

fitur aplikasi:

admin
a. Melakukan login untuk masuk ke dalam aplikasi
b. Mengelola data surat keluar
c. Mengelola data surat masuk
d. Mengelola data disposisi surat
e. Mengelola data pengguna
f. Mengubah profil pengguna

Anggota :
a. Melakukan login untuk masuk ke dalam aplikasi
b. Melihat data surat masuk
c. Mengelola data surat keluar
d. Mengelola data disposisi surat
e. Melihat data pengguna
f. Mengubah profil pengguna

cara instal :

<!-- perintah membuat tabel -->

1. php artisan migrate

<!-- perintah membuat isi tabel dummy -->

2. php artisan db:seed --class=DummyUsersSeeder
3. php artisan db:seed --class=CategorySeeder

<!-- perintah menjalankan project laravel -->

4. php artisan serve --host (ip komputer server) --port 8080
