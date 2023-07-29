# Monolith

## Description

Monolith adalah sebuah aplikasi *pembelian barang sesajen*. Aplikasi ini akan berinteraksi dengan Single Service API yang sebelumnya sudah dibuat ([Github Repo](https://github.com/fawwazabrials/ssbackend-labpro)). Spesifikasi Monolith menggunakan spesifikasi sesuai dengan spesifikasi yang diberikan pada seleksi asisten Labpro.

## Daftar Isi
* [Technology Stack](#technology-stack)
* [Design Patterns](#design-patterns)
* [Requirements](#requirements)
* [Setup](#setup)
* [Features](#features)
* [Bonuses](#bonuses)
* [Appendix](#appendix)
* [Created By](#created-by)

## Technology Stack
* Laravel Framework v10.15.0
* Bootstrap v5.3
* MySQL v8.0.25
* Nginx v1.25.1

## Design Patterns
* Decorator  
Website menggunakan JWT sebagai autentikasi user yang sedang log in, token ini akan disimpan di dalam cookie. Untuk menghindari penulisan kode untuk menyimpan token di authorization header, maka dibuatlah decorator middleware untuk menangani hal tersebut.
* Factory  
Digunakan untuk menjalankan migration dan seeding pada database. Dibuat 2 buah factory untuk masing-masing model yaitu User dan Transaction. Kedua factory tersebut meng-inherit kelas abstract Factory bawaan Laravel.
* Provider  
Website menggunakan package tymondesigns/jwt-auth untuk menginject fungsionalitas JWT ke auth Laravel. Package akan disediakan sebagai provider yang akan menggantikan implementasi default laravel.
## Requirements  
Pastikan [Docker](https://docs.docker.com/desktop/install/windows-install/) sudah terinstall di mesin dan mesin dapat menjalankan Makefile. Pastikan juga container [Single Service API](https://github.com/fawwazabrials/ssbackend-labpro) sedang berjalan.

## Setup  
Terdapat 2 pilihan setup yang bisa dijalankan. Pilihan 1 adalah setup di WSL2 yang sangat dianjurkan. Menggunakan cara ini akan meningkatkan performa loading website. Untuk informasi lanjut mengenai hal tersebut dapat dibaca di [appendix](#appendix). Pilihan kedua adalah setup di Windows seperti biasa.

### 1. Setup WSL (recommended)
1. Untuk Windows, masukkan `\\wsl$` dalam address bar Windows Explorer dan pilih distro WSL2 yang biasa digunakan
2. Clone repository ini di dalam directory distro WSL2
3. Duplikat `.env.example` kemudian rename menjadi `.env`.
4. Jalankan aplikasi docker
5. Jika belum, jalankan container [Single Service API](https://github.com/fawwazabrials/ssbackend-labpro)
6. Ketik `make setup` pada terminal / cmd
7. Jika terdapat error, jalankan `make stop || make up || make composer-setup || make data`
8. Kunjungi website pada url `localhost:80`

### 2. Setup Windows  
1. Clone repository ini
2. Duplikat `.env.example` kemudian rename menjadi `.env`.
3. Jalankan aplikasi docker
4. Jika belum, jalankan container [Single Service API](https://github.com/fawwazabrials/ssbackend-labpro)
5. Ketik `make setup` pada terminal / cmd
7. Jika terdapat error, jalankan `make stop || make up || make composer-setup || make data`
8. Kunjungi website pada url `localhost:80`

Bila tidak mempunyai Makefile, berikut adalah translasi command makefile ke command aslinya
| Makefile            | Command                                                                                                                                                                                                                |
|---------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| make build          | docker-compose build --no-cache --force-rm                                                                                                                                                                             |
| make up             | docker-compose up -d                                                                                                                                                                                                   |
| make composer-setup | docker exec -it --user=root monolith-labpro-app-1 chmod -R 777 /var/www/storage \|\|  exec monolith-labpro-app-1 bash -c "composer install" \|\|  docker exec monolith-labpro-app-1 bash -c "php artisan key:generate" |
| make data           | docker exec monolith-labpro-app-1 bash -c "php artisan migrate:fresh --seed"   

## Features  
* User Login dan Register  
Pengguna dapet melakukan login dengan akun yang terdata pada database. Jika belum mempunyai akun, pengguna dapat mendaftarkan akunnya pada menu register. Jika pengguna ingin sekedar mencoba, disediakan 3 akun dummy pada file `dummy.txt`.
* Katalog Barang  
Katalog barang akan berlaku juga sebagai home page. Monolith akan melakukan penggambilan data barang yang tersedia dari Single Service API yang kemudian akan ditampilkan. Pengguna dapat memilih salah satu barang untuk melihat detail barang tersebut.
* Pembelian Barang  
Di dalam page detail barang, pengguna dapat memilih jumlah barang yang ingin dibeli. Tentunya kuantitas yang akan dibeli tidak boleh melebihi stok barang (iyalah:v). Setelah memasukan jumlah barang, pengguna dapat menekan tombol buy untuk membeli barang tersebut. Untuk menggunakan fitur membeli, seorang pengguna harus login terlebih dahulu!
* Riwayat Pembelian  
Setiap pembelian yang sudah dilakukan oleh pengguna akan masuk ke dalam riwayat pembelian. Menu riwayat akan menunjukan seluruh transaksi pembelian yang telah dilakukan oleh pengguna. Untuk melihat riwayat pembelian, seorang pengguna harus login terlebih dahulu!

## Bonuses
1. Dokumentasi API  
Dibuat dokumentasi API backend monolith menggunakan Swagger. Dokumentasi API dapat dilihat dengan mengunjungi route `/api/docs`. Jika ingin menggunakan endpoint yang protected, anda harus menyertakan JWT token yang diberikan ketika login di authorize.
2. Responsive Layout  
Website dibuat dengan menggunakan Bootstrap sebagai framework CSS. Bootstrap menyediakan class-class plug and play yang bersifat responsive dan mobile-first. Sehingga, seluruh page website bersifat responsive dan dapat digunakan pada device mobile.
    - Desktop View
    ![Desktop view of website](/images/responsive-desktop.png)
    - Mobile View
    ![Mobile view of website](/images/responsive-mobile.png)
3. Search bar  
Untuk mencari barang yang diinginkan, pengguna dapat menggunakan search bar. Pengguna dapat mencari berdasarkan nama suatu barang dan dapat juga mensortir barang berdasarkan nama, stok, dan harga secara menaik atau menurun.
4. Google Lighthouse  
Google Lighthouse digunakan untuk mengukur kualitas satu website. Disini saya mengetes kualitas website dalam segi performa, aksesibilitas, SEO dan best practices. Seluruh page mendapatkan nilai >95.
    - Main Page
    ![Lighthouse result for main page](/images/lighthouse-main-page.png)
    - Single Listing / Buy Page
    ![Lighthouse result for single listing page](/images/lighthouse-single-listing-page.png)
    - Login Page
    ![Lighthouse result for login page](/images/lighthouse-login-page.png)
    - Register Page
    ![Lighthouse result for register page](/images/lighthouse-register-page.png)
    - History Page
    ![Lighthouse result for history page](/images/lighthouse-history-page.png)

## Appendix
* Docker menggunakan WSL2 sebagai alat untuk menyimpan dan menjalankan container. Ternyata WSL2 memiliki performa I/O yang sangat lambat ketika melakukan mounting ([source](https://github.com/microsoft/WSL/issues/4197)). Karena source code ditempatkan di filesystem Windows, Docker akan melakukan mounting ke drive tempat kode berada. Hal ini menyebabkan transaksi antar filesystem yang sangat lambat. Ditambah lagi, PHP sangat inefisien dalam melakukan loading dependency ([source](https://dev.to/tylerlwsmith/speed-up-laravel-in-docker-by-moving-vendor-directory-19b9)). Jika source code tetap ditempatkan di Windows, dari testing saya, saya mendapatkan average load time selama ~10s. Jika source code ditempatkan langsung di dalam WSL 2, average load time turun menjadi **~100ms**.

## Created by
Fawwaz Abrial Saffa
18221067