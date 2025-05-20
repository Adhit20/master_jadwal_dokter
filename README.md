# Aplikasi Jadwal Dokter

Aplikasi manajemen jadwal dokter dengan RESTful API menggunakan Laravel dan Sanctum untuk autentikasi.

## Daftar Isi
- [Persyaratan](#persyaratan)
- [Instalasi](#instalasi)
- [Cara Menjalankan](#cara-menjalankan)
- [Struktur Database](#struktur-database)
- [Endpoint API](#endpoint-api)
- [Penggunaan API](#penggunaan-api)
- [Contoh Request dan Response](#contoh-request-dan-response)

## Persyaratan

- PHP >= 8.1
- Composer
- MySQL 
- Laragon / XAMPP
- Node.js & NPM (untuk frontend)
- Git

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/jadwal_dokter.git
cd jadwal_dokter
```

### 2. Instalasi Dependencies

```bash
composer install
npm install
```

### 3. Setup Lingkungan

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan pengaturan database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jadwal_dokter
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi dan Seeding Database

```bash
php artisan migrate
php artisan db:seed --class=DoctorSeeder
php artisan db:seed --class=UserSeeder
```

## Cara Menjalankan

### Menjalankan dengan Laragon/XAMPP

Anda dapat menjalankan aplikasi ini menggunakan Laragon atau XAMPP:

1. Letakkan folder project di direktori `www` Laragon atau `htdocs` XAMPP
2. Nyalakan web server dan MySQL
3. Buka terminal di direktori project dan jalankan `php artisan serve` untuk menjalankan aplikasi di `http://localhost:8000`

### Menjalankan Server Pengembangan

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`.

### Menjalankan Frontend (opsional)

```bash
npm run dev
```

## Struktur Database

Aplikasi menggunakan beberapa tabel utama:

1. `users` - Menyimpan data pengguna aplikasi
2. `doctors` - Menyimpan data dokter
3. `schedules` - Menyimpan jadwal praktek dokter

## Endpoint API

### Autentikasi

| Metode | Endpoint | Deskripsi |
|--------|----------|-----------|
| POST | `/api/register` | Registrasi pengguna baru |
| POST | `/api/login` | Login pengguna |
| POST | `/api/logout` | Logout pengguna |
| GET | `/api/user` | Mendapatkan data pengguna yang login |
| GET | `/api/users` | Mendapatkan daftar semua pengguna (publik) |

### Dokter

| Metode | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/doctors` | Mendapatkan semua data dokter |
| POST | `/api/doctors` | Menambahkan dokter baru |
| GET | `/api/doctors/{id}` | Mendapatkan detail dokter |
| PUT | `/api/doctors/{id}` | Mengupdate data dokter |
| DELETE | `/api/doctors/{id}` | Menghapus data dokter |

### Jadwal

| Metode | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/schedules` | Mendapatkan semua jadwal dokter |
| POST | `/api/schedules` | Membuat jadwal dokter baru |

## Penggunaan API

### Autentikasi

Semua endpoint API (kecuali `/api/register`, `/api/login`, dan `/api/users`) memerlukan token autentikasi yang dikirimkan melalui header:

```
Authorization: Bearer {token}
```

Token didapatkan saat melakukan login.

### Format Request dan Response

Semua request dan response menggunakan format JSON.

## Contoh Request dan Response

### Registrasi Pengguna

**Request:**
```http
POST /api/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "message": "Registrasi berhasil, silakan login untuk melanjutkan",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2023-10-12T12:34:56.000000Z",
    "updated_at": "2023-10-12T12:34:56.000000Z"
  }
}
```

### Login

**Request:**
```http
POST /api/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "message": "Login berhasil",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2023-10-12T12:34:56.000000Z",
    "updated_at": "2023-10-12T12:34:56.000000Z"
  },
  "token": "1|laravel_sanctum_token..."
}
```

### Membuat Jadwal Dokter

**Request:**
```http
POST /api/schedules
Content-Type: application/json
Authorization: Bearer {token}

{
  "doctor_id": 1,
  "days": ["Senin", "Selasa", "Rabu"],
  "start_time": "08:00",
  "end_time": "12:00",
  "quota": 20
}
```

**Response:**
```json
{
  "message": "Jadwal berhasil dibuat",
  "schedules": [
    {
      "id": 1,
      "doctor_id": 1,
      "day": "Senin",
      "start_time": "08:00",
      "end_time": "12:00",
      "quota": 20,
      "status": true,
      "created_at": "2023-10-12T12:34:56.000000Z",
      "updated_at": "2023-10-12T12:34:56.000000Z"
    },
    {
      "id": 2,
      "doctor_id": 1,
      "day": "Selasa",
      "start_time": "08:00",
      "end_time": "12:00",
      "quota": 20,
      "status": true,
      "created_at": "2023-10-12T12:34:56.000000Z",
      "updated_at": "2023-10-12T12:34:56.000000Z"
    },
    {
      "id": 3,
      "doctor_id": 1,
      "day": "Rabu",
      "start_time": "08:00",
      "end_time": "12:00",
      "quota": 20,
      "status": true,
      "created_at": "2023-10-12T12:34:56.000000Z",
      "updated_at": "2023-10-12T12:34:56.000000Z"
    }
  ]
}
```

### Tampilan API Tester

Aplikasi juga menyediakan halaman API Tester untuk mencoba API secara langsung dari browser di endpoint:

```
http://localhost:8000/api-tester
```
