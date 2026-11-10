//BAHASA INGGRIS
# WEB ESKUL SENI MULTIKALTER
Seni Multikalter Extracurricular Website of SMKN 2 Purwakarta.
This website was developed as an information and data management platform for the Seni Multikalter extracurricular. The website consists of a user page (frontend) and an admin page (backend) used to manage various information such as profiles, members, news, achievements, agendas, and galleries.

---

## 📌 About the Project

Seni Multikalter is an arts extracurricular activity at SMKN 2 Purwakarta that serves as a platform for students to develop their talents, creativity, and skills in the arts.

This website was created to make information about Seni Multikalter activities easier to access and to help administrators manage website data and content.

### Objectives

* Provide information about Seni Multikalter.
* Display the latest news and activities.
* Display achievements that have been accomplished.
* Display activity schedules and agendas.
* Display activity documentation through the gallery.
* Display member information.
* Make it easier for administrators to manage website data.
* Organize extracurricular information in a structured and accessible way.

---

# ✨ Website Features

## 👤 Frontend

### 1. Home

The main page of the website that displays brief information about Seni Multikalter along with the latest information and activities.

### 2. Profile

Displays information about Seni Multikalter, including:

* Description
* History
* Vision
* Mission
* Extracurricular information

### 3. News

Displays news and information about Seni Multikalter activities.

News data includes:

* News title
* News description
* Photo
* Upload date

### 4. Achievements

Displays various achievements accomplished by Seni Multikalter.

### 5. Agenda

Displays the schedules and activities of Seni Multikalter.

Examples of activities:

* Traditional Dance Practice
* Modern Dance Practice
* Kabaret Practice
* Other activities

### 6. Gallery

Displays photo documentation of Seni Multikalter activities.

The gallery may contain documentation of:

* Traditional Dance
* Modern Dance
* Art Performances
* School Events
* Extracurricular Activities

### 7. Members

Displays information about Seni Multikalter members.

### 8. Login & Registration

Users can:

* Register
* Log in
* Log out

---

# 🔐 Admin / Backend

The admin page is used to manage website data and content.

The admin menu consists of:

* Dashboard
* Profile
* Organigram
* Members
* News
* Achievements
* Agenda
* Gallery

### Dashboard

Displays a summary of website data, such as:

* Total Members
* Total News
* Total Achievements
* Total Agenda
* Total Gallery

### Profile Management

Administrators can manage Seni Multikalter profile information.

### Member Management

Administrators can manage member data, including:

* Add data
* View data
* Edit data
* Delete data

### News Management

Administrators can manage news that will be displayed on the frontend.

News data structure:

| Field              | Description      |
| ------------------ | ---------------- |
| `id_berita`        | News ID          |
| `judul_berita`     | News title       |
| `deskripsi_berita` | News description |
| `foto`             | News photo       |
| `tanggal_upload`   | Upload date      |

### Achievement Management

Administrators can manage Seni Multikalter achievement data.

### Agenda Management

Administrators can manage activity agendas and schedules.

### Gallery Management

Administrators can manage activity photo documentation.

---

# 🛠️ Technologies Used

This project was developed using:

* **Laravel**
* **PHP**
* **MySQL**
* **HTML**
* **CSS**
* **JavaScript**
* **Blade**
* **Tailwind CSS**
* **Alpine.js**
* **Figma**
* **Laragon**
* **phpMyAdmin**

---

# 📂 Project Structure

Main project structure:

```text
belajarLaravel/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   ├── css/
│   │   ├── admin/
│   │   └── frontend/
│   │
│   ├── js/
│   │   └── admin/
│   │
│   └── images/
│
├── resources/
│   └── views/
│       ├── admin/
│       ├── components/
│       └── user/
│
├── routes/
│   └── web.php
│
├── .env
├── artisan
├── composer.json
└── README.md
```

---

# 🗄️ Database

The website uses **MySQL** as its database.

The database is used to store various website data, such as:

* User data
* Member data
* News data
* Achievement data
* Agenda data
* Gallery data
* Profile data

One of the tables used is the `berita` table.

### `berita` Table Structure

```text
berita
│
├── id_berita
├── judul_berita
├── deskripsi_berita
├── foto
└── tanggal_upload
```

The database can be managed using **phpMyAdmin**.

---

# 🔗 Website Routes

Main frontend routes:

```text
/
├── /profile
├── /galeri
├── /berita
├── /prestasi
├── /agenda
└── /anggota
```

Authentication routes:

```text
/login
/register
/logout
/dashboard
```

Admin routes:

```text
/admin
/admin/profile
/admin/organigram
/admin/anggota
/admin/berita
/admin/prestasi
/admin/agenda
/admin/galeri
```

---

# ⚙️ How to Run the Project

## 1. Prepare the Project

Make sure the Laravel project is located inside the Laragon directory:

```text
C:\laragon\www\belajarLaravel
```

---

## 2. Open the Terminal

Open a terminal in the project directory.

```bash
cd C:\laragon\www\belajarLaravel
```

---

## 3. Install Dependencies

Run:

```bash
composer install
```

---

## 4. Create the `.env` File

Copy:

```text
.env.example
```

and rename it to:

```text
.env
```

Then configure the database:

```env
APP_NAME="Seni Multikalter"
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=
```

Replace `database_name` with the name of the database being used.

---

## 5. Generate the Application Key

Run:

```bash
php artisan key:generate
```

---

## 6. Set Up the Database

Create a database using phpMyAdmin.

Then make sure the database name in the `.env` file matches the database being used.

If Laravel migrations are used, run:

```bash
php artisan migrate
```

---

## 7. Run the Project

Run:

```bash
php artisan serve
```

Then open:

```text
http://127.0.0.1:8000
```

If using the Laragon Virtual Host:

```text
http://belajarLaravel.test
```

---

# 🔄 System Flow

The basic website flow:

```text
User
 │
 ▼
Frontend
 │
 ├── Home
 ├── Profile
 ├── News
 ├── Achievements
 ├── Agenda
 ├── Gallery
 └── Members
 │
 ▼
Database
 ▲
 │
Admin
 │
 ├── Dashboard
 ├── Profile
 ├── Organigram
 ├── Members
 ├── News
 ├── Achievements
 ├── Agenda
 └── Gallery
```

Administrators manage the data through the backend.

The data managed by administrators is stored in the database and then displayed on the frontend.

---

# 🧩 MVC Concept

This project uses the **MVC (Model, View, Controller)** architecture provided by Laravel.

### Model

The Model is used to interact with the database.

Example:

```php
$berita = Berita::all();
```

### View

The View is used to display website pages using Blade.

Example:

```text
resources/views/user/berita.blade.php
```

### Controller

The Controller is used to manage the application logic and connect the Model with the View.

Example:

```php
public function index()
{
    $berita = Berita::all();

    return view('admin.berita', compact('berita'));
}
```

MVC flow:

```text
Database
   ↓
Model
   ↓
Controller
   ↓
View
   ↓
Website
```

---

# 🎨 UI/UX

The website design was created using **Figma**.

The website uses a design concept that represents the identity of Seni Multikalter.

### Main Colors

```text
Brown  : #481D08
Green  : #087849
Cream  : #F8F3EC
Maroon : #560101
```

### Fonts

The website uses:

* DM Sans
* Playfair Display

---

# 📱 Responsive Design

The website is designed to work on various screen sizes:

* Desktop
* Laptop
* Tablet
* Mobile

The frontend navbar and admin sidebar are also designed to remain usable on smaller screens.

---

# 🧱 Components

The website uses Blade Includes to create reusable components.

### Navbar

```blade
@include('components.navbar')
```

### Footer

```blade
@include('components.footer')
```

Using reusable components helps reduce repeated code across different pages.

---

# 🖼️ Assets

Website assets are stored in the following folders:

```text
public/
├── css/
├── js/
└── images/
```

Examples:

```text
public/css/admin/
public/css/frontend/
public/js/admin/
public/images/berita/
public/images/galeri/
```

---

# 🚀 Future Development

Several features can still be developed in the future:

* Admin role management.
* Direct image upload from the dashboard.
* Search and data filtering.
* Pagination for all data.
* More complete form validation.
* Notifications after CRUD operations.
* Real-time dashboard statistics.
* Admin account management.
* Deployment to a hosting server.

---

# 👩‍💻 Developer

**Nayara Khansa Zenina**

**SMKN 2 Purwakarta**

Major: **Software Engineering (RPL)**

### Skills

* HTML
* CSS
* JavaScript
* PHP
* Laravel
* MySQL
* Figma
* Tailwind CSS
* Alpine.js

---

# 📌 Project Status

**Status:** Development / School Project

This project was created for the development of the **Seni Multikalter Extracurricular Website at SMKN 2 Purwakarta**.

---

# ❤️ Seni Multikalter

> **A Place for Artists**

This website was created as a platform for information, documentation, and activity management for the Seni Multikalter Extracurricular at SMKN 2 Purwakarta.

//BAHASA INDONESIA
# WEB ESKUL SENI MULTIKALTER

Website Ekstrakurikuler Seni Multikalter SMKN 2 Purwakarta.

Website ini dibuat sebagai media informasi dan pengelolaan data ekstrakurikuler Seni Multikalter. Website terdiri dari halaman pengguna (frontend) dan halaman admin (backend) yang digunakan untuk mengelola berbagai informasi seperti profil, anggota, berita, prestasi, agenda, dan galeri.

---

## 📌 Tentang Project

Seni Multikalter merupakan ekstrakurikuler seni di SMKN 2 Purwakarta yang menjadi wadah bagi siswa untuk mengembangkan bakat, kreativitas, dan kemampuan di bidang seni.

Website ini dibuat untuk mempermudah penyampaian informasi mengenai kegiatan Seni Multikalter serta membantu admin dalam mengelola data dan konten website.

### Tujuan

- Menyediakan informasi mengenai Seni Multikalter.
- Menampilkan berita dan kegiatan terbaru.
- Menampilkan prestasi yang telah diraih.
- Menampilkan agenda kegiatan.
- Menampilkan dokumentasi kegiatan melalui galeri.
- Menampilkan data anggota.
- Memudahkan admin dalam mengelola data website.
- Membuat informasi ekstrakurikuler lebih terstruktur dan mudah diakses.

---

# ✨ Fitur Website

## 👤 Frontend

### 1. Beranda

Halaman utama website yang menampilkan informasi singkat mengenai Seni Multikalter serta beberapa informasi terbaru.

### 2. Profile

Menampilkan informasi mengenai Seni Multikalter, seperti:

- Deskripsi
- Sejarah
- Visi
- Misi
- Informasi ekstrakurikuler

### 3. Berita

Menampilkan berita dan informasi kegiatan Seni Multikalter.

Data berita meliputi:

- Judul berita
- Deskripsi berita
- Foto
- Tanggal upload

### 4. Prestasi

Menampilkan berbagai prestasi yang telah diraih oleh Seni Multikalter.

### 5. Agenda

Menampilkan jadwal dan kegiatan Seni Multikalter.

Contoh kegiatan:

- Latihan Tari Tradisi
- Latihan Modern Dance
- Latihan Kabaret
- Kegiatan lainnya

### 6. Galeri

Menampilkan dokumentasi foto kegiatan Seni Multikalter.

Galeri dapat berisi dokumentasi:

- Tari Tradisi
- Modern Dance
- Pentas Seni
- Event sekolah
- Kegiatan ekstrakurikuler

### 7. Anggota

Menampilkan data anggota Seni Multikalter.

### 8. Login & Register

Pengguna dapat melakukan:

- Register
- Login
- Logout

---

# 🔐 Admin / Backend

Halaman admin digunakan untuk mengelola data dan konten website.

Menu admin terdiri dari:

- Dashboard
- Profile
- Organigram
- Anggota
- Berita
- Prestasi
- Agenda
- Galeri

### Dashboard

Menampilkan ringkasan data website, seperti:

- Total Anggota
- Total Berita
- Total Prestasi
- Total Agenda
- Total Galeri

### Kelola Profile

Admin dapat mengelola informasi profil Seni Multikalter.

### Kelola Anggota

Admin dapat mengelola data anggota, seperti:

- Menambah data
- Melihat data
- Mengubah data
- Menghapus data

### Kelola Berita

Admin dapat mengelola berita yang akan ditampilkan pada halaman frontend.

Struktur data berita:

| Field | Keterangan |
|---|---|
| `id_berita` | ID berita |
| `judul_berita` | Judul berita |
| `deskripsi_berita` | Deskripsi berita |
| `foto` | Foto berita |
| `tanggal_upload` | Tanggal upload |

### Kelola Prestasi

Admin dapat mengelola data prestasi Seni Multikalter.

### Kelola Agenda

Admin dapat mengelola agenda dan jadwal kegiatan.

### Kelola Galeri

Admin dapat mengelola dokumentasi foto kegiatan.

---

# 🛠️ Teknologi yang Digunakan

Project ini dibuat menggunakan:

- **Laravel**
- **PHP**
- **MySQL**
- **HTML**
- **CSS**
- **JavaScript**
- **Blade**
- **Tailwind CSS**
- **Alpine.js**
- **Figma**
- **Laragon**
- **phpMyAdmin**

---

# 📂 Struktur Folder

Struktur utama project:

```text
belajarLaravel/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   ├── css/
│   │   ├── admin/
│   │   └── frontend/
│   │
│   ├── js/
│   │   └── admin/
│   │
│   └── images/
│
├── resources/
│   └── views/
│       ├── admin/
│       ├── components/
│       └── user/
│
├── routes/
│   └── web.php
│
├── .env
├── artisan
├── composer.json
└── README.md
```

---

# 🗄️ Database

Website menggunakan **MySQL** sebagai database.

Database digunakan untuk menyimpan berbagai data website, seperti:

- Data user
- Data anggota
- Data berita
- Data prestasi
- Data agenda
- Data galeri
- Data profile

Salah satu tabel yang digunakan adalah tabel `berita`.

Struktur tabel `berita`:

```text
berita
│
├── id_berita
├── judul_berita
├── deskripsi_berita
├── foto
└── tanggal_upload
```

Database dapat dikelola menggunakan **phpMyAdmin**.

---

# 🔗 Route Website

Beberapa route utama frontend:

```text
/
├── /profile
├── /galeri
├── /berita
├── /prestasi
├── /agenda
└── /anggota
```

Route autentikasi:

```text
/login
/register
/logout
/dashboard
```

Route admin:

```text
/admin
/admin/profile
/admin/organigram
/admin/anggota
/admin/berita
/admin/prestasi
/admin/agenda
/admin/galeri
```

---

# ⚙️ Cara Menjalankan Project

## 1. Menyiapkan Project

Pastikan project Laravel berada di dalam folder Laragon:

```text
C:\laragon\www\belajarLaravel
```

---

## 2. Membuka Terminal

Buka terminal pada folder project.

```bash
cd C:\laragon\www\belajarLaravel
```

---

## 3. Install Dependency

Jalankan:

```bash
composer install
```

---

## 4. Membuat File `.env`

Salin file:

```text
.env.example
```

menjadi:

```text
.env
```

Kemudian atur konfigurasi database:

```env
APP_NAME="Seni Multikalter"
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan `DB_DATABASE` dengan nama database yang digunakan.

---

## 5. Generate Application Key

Jalankan:

```bash
php artisan key:generate
```

---

## 6. Menyiapkan Database

Buat database melalui phpMyAdmin.

Kemudian pastikan nama database pada file `.env` sudah sesuai.

Jika menggunakan migration Laravel, jalankan:

```bash
php artisan migrate
```

---

## 7. Menjalankan Project

Jalankan:

```bash
php artisan serve
```

Kemudian buka:

```text
http://127.0.0.1:8000
```

Jika menggunakan Laragon Virtual Host:

```text
http://belajarLaravel.test 
``` 
 
--- 
 
# 🔄 Alur Sistem 
 
Alur sederhana website: 
 
```text 
User 
 │ 
 ▼ 
Frontend 
 │ 
 ├── Beranda 
 ├── Profile 
 ├── Berita 
 ├── Prestasi 
 ├── Agenda 
 ├── Galeri 
 └── Anggota 
 │ 
 ▼ 
Database 
 ▲ 
 │ 
Admin 
 │ 
 ├── Dashboard 
 ├── Profile 
 ├── Organigram 
 ├── Anggota 
 ├── Berita 
 ├── Prestasi 
 ├── Agenda 
 └── Galeri 
``` 
 
Admin mengelola data melalui halaman backend. 
 
Data yang dikelola admin disimpan ke database dan kemudian ditampilkan pada halaman frontend. 
 
--- 
 
# 🧩 Konsep MVC 
 
Project ini menggunakan konsep **MVC (Model, View, Controller)** dari Laravel. 
 
### Model 
 
Model digunakan untuk berinteraksi dengan database. 
 
Contoh: 
 
```php 
$berita = Berita::all(); 
``` 
 
### View 
 
View digunakan untuk menampilkan halaman website menggunakan Blade. 
 
Contoh: 
 
```text 
resources/views/user/berita.blade.php 
``` 
 
### Controller 
 
Controller digunakan untuk mengatur proses dan menghubungkan Model dengan View. 
 
Contoh: 
 
```php 
public function index() 
{ 
    $berita = Berita::all(); 
 
    return view('admin.berita', compact('berita')); 
} 
``` 
 
Alur MVC: 
 
```text 
Database 
   ↓ 
Model 
   ↓ 
Controller 
   ↓ 
View 
   ↓ 
Website 
``` 
 
--- 
 
# 🎨 UI/UX 
 
Desain website dibuat menggunakan Figma. 
 
Website menggunakan konsep desain yang menyesuaikan identitas Seni Multikalter. 
 
### Warna Utama 
 
```text 
Brown  : #481D08 
Green  : #087849 
Cream  : #F8F3EC 
Maroon : #560101 
``` 
 
### Font 
 
Website menggunakan: 
 
- DM Sans 
- Playfair Display 
 
--- 
 
# 📱 Responsive Design 
 
Website dibuat agar dapat digunakan pada berbagai ukuran layar: 
 
- Desktop 
- Laptop 
- Tablet 
- Mobile 
 
Navbar frontend dan sidebar admin juga disesuaikan agar tetap dapat digunakan pada layar yang lebih kecil. 
 
--- 
 
# 🧱 Components 
 
Website menggunakan Blade Include untuk membuat komponen yang dapat digunakan kembali. 
 
Contoh Navbar: 
 
```blade 
@include('components.navbar') 
``` 
 
Contoh Footer: 
 
```blade 
@include('components.footer') 
``` 
 
Penggunaan component membantu mengurangi penulisan kode yang sama pada setiap halaman. 
 
--- 
 
# 🖼️ Asset 
 
Asset website disimpan di dalam folder: 
 
```text 
public/ 
├── css/ 
├── js/ 
└── images/ 
``` 
 
Contoh: 
 
```text 
public/css/admin/ 
public/css/frontend/ 
public/js/admin/ 
public/images/berita/ 
public/images/galeri/ 
``` 
 
--- 
 
# 🚀 Pengembangan Selanjutnya 
 
Beberapa fitur yang masih dapat dikembangkan: 
 
- Sistem role admin. 
- Upload gambar langsung dari dashboard. 
- Search dan filter data. 
- Pagination pada seluruh data. 
- Validasi form yang lebih lengkap. 
- Notifikasi setelah CRUD. 
- Statistik dashboard secara real-time. 
- Pengelolaan akun admin. 
- Deployment ke hosting. 
 
--- 
 
# 👩‍💻 Developer 
 
**Nayara Khansa Zenina** 
 
**SMKN 2 Purwakarta** 
 
Jurusan **Rekayasa Perangkat Lunak (RPL)** 
 
### Skills 
 
- HTML 
- CSS 
- JavaScript 
- PHP 
- Laravel 
- MySQL 
- Figma 
- Tailwind CSS 
- Alpine.js 
 
--- 
 
# 📌 Status Project 
 
**Status:** Development / School Project 
 
Project ini dibuat untuk kebutuhan pengembangan website Ekstrakurikuler **Seni Multikalter SMKN 2 Purwakarta**. 
 
--- 
 
# ❤️ Seni Multikalter 
 
> **Wadahnya Para Seniman** 
 
Website ini dibuat sebagai media informasi, dokumentasi, dan pengelolaan kegiatan Ekstrakurikuler Seni Multikalter SMKN 2 Purwakarta. nah yang ini ubah ke b.inggris