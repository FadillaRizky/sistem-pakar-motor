# Sistem Pakar Diagnosa Motor 🏍️

Sistem Pakar untuk diagnosa kerusakan motor menggunakan metode **Forward Chaining** dan **Certainty Factor** (CF). Aplikasi ini membantu pengguna mengidentifikasi kerusakan motor berdasarkan gejala yang dialami.

## 🎯 Fitur Utama

✅ **Diagnosa Berbasis Gejala** - Pengguna memilih gejala yang dialami motor  
✅ **Forward Chaining Algorithm** - Proses inferensi otomatis untuk menentukan kerusakan  
✅ **Confidence Scoring** - Menampilkan tingkat keyakinan diagnosa dalam persentase (0-100%)  
✅ **Multiple Results** - Menampilkan diagnosa utama dan alternatif  
✅ **Solusi Rekomendasi** - Memberikan saran perbaikan untuk setiap kerusakan  
✅ **History Tracking** - Menyimpan riwayat konsultasi user  
✅ **Admin Panel** - Kelola gejala, kerusakan, dan rules  
✅ **User Authentication** - Login/Register untuk tracking history  

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12.44.0 (PHP Framework)
- **Database**: MySQL 5.7+
- **Frontend**: Blade Templates + Tailwind CSS
- **PHP Version**: 8.5.0
- **Additional**: Laravel Breeze (Authentication)

## 📋 Struktur Database

### Tabel Utama

1. **gejalas** - Daftar gejala motor (15 items)
2. **kerusakans** - Daftar kerusakan motor (10 items)
3. **rules** - Aturan inferensi (menghubungkan gejala ke kerusakan)
4. **konsultasis** - Riwayat konsultasi user
5. **rule_gejala** - Junction table untuk relasi many-to-many
6. **users** - Data user untuk authentication

## 🚀 Cara Instalasi

### Prerequisites
- PHP 8.0+ dengan extensions: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON
- MySQL 5.7 atau MariaDB 10.2+
- Composer (untuk install PHP dependencies)
- Node.js & npm (untuk build frontend assets)
- Git

### Step-by-Step Installation

#### 1. Clone Repository
```bash
git clone https://github.com/FadillaRizky/sistem-pakar-motor.git
cd sistem-pakar-motor
```

#### 2. Install PHP Dependencies
```bash
composer install
```

#### 3. Setup Environment File
```bash
cp .env.example .env
php artisan key:generate
```

#### 4. Konfigurasi Database

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_pakar_motor
DB_USERNAME=root
DB_PASSWORD=
```

Buat database di MySQL:
```sql
CREATE DATABASE sistem_pakar_motor;
```

#### 5. Install Node Dependencies
```bash
npm install
```

#### 6. Migrasi Database & Seed Data
```bash
php artisan migrate
php artisan db:seed
```

#### 7. Build Frontend Assets
```bash
npm run build
```

Atau untuk development dengan live reload:
```bash
npm run dev
```

#### 8. Jalankan Development Server
```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://127.0.0.1:8000**

---

## 🧪 Testing Instructions

### User Flow Testing

#### 1. **Test Landing Page**
- Buka http://127.0.0.1:8000
- Verifikasi:
  - ✅ Heading "Sistem Pakar Diagnosa Motor" tampil
  - ✅ Deskripsi sistem lengkap
  - ✅ Tombol "Mulai Konsultasi Sekarang" ada dan clickable
  - ✅ Info about, features, dan cara penggunaan terlihat

#### 2. **Test Konsultasi (User)**
- Klik tombol "Mulai Konsultasi Sekarang"
- Halaman `/konsultasi` terbuka
- **Validasi:**
  - ✅ 15 gejala motor tampil dengan checkbox
  - ✅ Deskripsi gejala lengkap
  - ✅ Tombol "Mulai Diagnosa" dan "Kembali" ada

- **Pilih 3 gejala** (contoh):
  - G001: Mesin Tidak Bisa Dihidupkan
  - G003: Busi Menyala Lemah
  - G007: Baterai Lemah

- **Klik "Mulai Diagnosa"**
- **Verifikasi hasil:**
  - ✅ Halaman `/konsultasi/proses` terbuka
  - ✅ Menampilkan diagnosa utama dengan confidence score
  - ✅ Progress bar menunjukkan persentase
  - ✅ Solusi rekomendasi ditampilkan
  - ✅ Gejala yang cocok terdaftar
  - ✅ Diagnosa alternatif tersedia

#### 3. **Test Error Validation**
- Kembali ke form konsultasi
- **Klik "Mulai Diagnosa" tanpa pilih gejala apapun**
- **Verifikasi:**
  - ✅ Error message: "Silakan pilih minimal satu gejala"
  - ✅ Form tidak submit

#### 4. **Test History Tracking**
- Register/Login dengan akun baru
- Lakukan 2-3 konsultasi berbeda
- Akses `/dashboard`
- **Verifikasi:**
  - ✅ Riwayat konsultasi tersimpan
  - ✅ Timestamp terlihat

### Admin Testing

#### 5. **Test Admin Login**
- Buka http://127.0.0.1:8000/login
- Login dengan default Laravel user (jalankan: `php artisan tinker` kemudian `User::first()`)
- Verifikasi redirect ke dashboard

#### 6. **Test Admin Panel - CRUD Gejala**
- Akses `/gejala`
- **Test Create:**
  - Klik "Add Gejala"
  - Isi: Kode (G016), Nama, Deskripsi
  - Click Save
  - ✅ Gejala baru terlihat di list

- **Test Read:**
  - ✅ Semua 15 gejala original terlihat
  - ✅ Data lengkap (kode, nama, deskripsi)

- **Test Update:**
  - Klik Edit pada satu gejala
  - Ubah deskripsi
  - Click Update
  - ✅ Perubahan tersimpan

- **Test Delete:**
  - Klik Delete pada gejala yang baru dibuat
  - ✅ Gejala terhapus dari list

#### 7. **Test Admin Panel - CRUD Kerusakan**
- Akses `/kerusakan`
- Lakukan test yang sama seperti gejala (Create, Read, Update, Delete)

#### 8. **Test Admin Panel - CRUD Rules**
- Akses `/rule`
- **Verifikasi:**
  - ✅ 10 rules original terlihat
  - ✅ Setiap rule menampilkan kerusakan + gejala yang terlibat
  - ✅ Bisa create, edit, delete rules

### API/Algorithm Testing

#### 9. **Test Forward Chaining Logic**
Gunakan Postman atau curl untuk test:

```bash
curl -X POST http://127.0.0.1:8000/konsultasi/proses \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "gejala_ids[]=1&gejala_ids[]=2&gejala_ids[]=3"
```

**Verifikasi:**
- ✅ Response JSON valid
- ✅ Confidence score calculated correctly
- ✅ Result sorted by confidence descending

#### 10. **Test Confidence Score Calculation**

Contoh skenario:
- Rule: Baterai Lemah memerlukan gejala [1, 7] dengan CF 0.95
- User pilih gejala [1, 7, 8]
- Perhitungan: (2/2) × 0.95 × 100 = **95%**

---

## 🐛 Troubleshooting

### Error: "Class 'App\Models\Gejala' not found"

**Penyebab:** Autoload Composer belum di-generate

**Solusi:**
```bash
composer dump-autoload
```

---

### Error: "SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'"

**Penyebab:** Database username/password salah di `.env`

**Solusi:**
1. Cek kredensial MySQL Anda
2. Edit `.env`:
```env
DB_USERNAME=root
DB_PASSWORD=your_password
```
3. Jalankan ulang migration:
```bash
php artisan migrate
```

---

### Error: "Class 'PDO' not found"

**Penyebab:** PHP PDO extension tidak ter-install

**Solusi:**
- **Windows (XAMPP):** Uncomment di `php.ini`:
```ini
extension=pdo_mysql
```
- **Linux:** Install PDO:
```bash
sudo apt-get install php-mysql
```
- **MacOS (Homebrew):**
```bash
brew install php@8.2 --with-pdo-mysql
```

---

### Error: "Key does not have a corresponding action"

**Penyebab:** `.env` APP_KEY belum di-generate

**Solusi:**
```bash
php artisan key:generate
```

---

### Error: "The project dependencies could not be resolved"

**Penyebab:** Versi PHP tidak sesuai dengan requirement

**Solusi:**
1. Check PHP version:
```bash
php --version
```
2. Harus PHP 8.0+
3. Update Composer dan dependencies:
```bash
composer update --with-dependencies
```

---

### Error: Halaman 404 di `/konsultasi`

**Penyebab:** Route belum di-register atau view tidak ada

**Solusi:**
1. Verifikasi routes di `routes/web.php`:
```php
Route::get('/konsultasi', [KonsultasiController::class, 'index'])
    ->name('konsultasi.index');
```
2. Verifikasi view ada di: `resources/views/konsultasi/index.blade.php`

---

### Error: "View [konsultasi.hasil] not found"

**Penyebab:** File hasil.blade.php tidak ada atau path salah

**Solusi:**
```bash
# Cek file ada
ls resources/views/konsultasi/

# Pastikan folder structure benar:
resources/
  └── views/
      └── konsultasi/
          ├── index.blade.php
          └── hasil.blade.php
```

---

### Error: "CSRF token mismatch"

**Penyebab:** Form tidak include CSRF token

**Solusi:** Pastikan form include:
```blade
@csrf
```

---

### Error: "Symfony\Component\HttpKernel\Exception\HttpException"

**Penyebab:** Authentication/authorization gagal

**Solusi:**
```bash
# Clear cache
php artisan config:clear
php artisan cache:clear
```

---

### Database Seeding Gagal

**Penyebab:** Constraint error atau data duplikat

**Solusi:**
```bash
# Refresh database (hapus semua + create baru)
php artisan migrate:refresh

# Atau bersihkan terlebih dahulu
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

---

### Frontend Assets Tidak Load (CSS/JS Tidak Jalan)

**Penyebab:** Build assets belum di-compile

**Solusi:**
```bash
# Development mode with auto-reload
npm run dev

# Production mode
npm run build

# Clear cache
php artisan view:clear
php artisan cache:clear
```

---

### Port 8000 Sudah Terpakai

**Penyebab:** Aplikasi lain menggunakan port 8000

**Solusi:**
```bash
# Ganti port
php artisan serve --port=8080
```

---

## 📞 Contact Info & Support

### Tim Development

| Nama | Role | GitHub | Email |
|------|------|--------|-------|
| Fadilla Rizky | Lead Developer | [@FadillaRizky](https://github.com/FadillaRizky) | [Email](mailto:fadilla.rizky@email.com) |
| [Kolaborator] | Contributor | [@Username](https://github.com/username) | [Email](mailto:email@email.com) |

### Contact & Support

- **GitHub Issues:** [Create Issue](https://github.com/FadillaRizky/sistem-pakar-motor/issues)
- **Email:** fadilla.rizky@email.com
- **Project:** Sistem Pakar - Expert System untuk Diagnosa Motor
- **Course:** INF2165 - Sistem Pakar
- **Institution:** Universitas Mercu Buana Yogyakarta

### Report Bug atau Request Feature

Jika menemukan bug atau ada ide feature baru:

1. Buka [Issues](https://github.com/FadillaRizky/sistem-pakar-motor/issues)
2. Klik "New Issue"
3. Jelaskan detail bug/feature request
4. Sertakan screenshot (jika ada)
5. Submit

### Contributing

Kami welcome pull requests! Steps:

1. Fork repository
2. Buat branch baru (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push ke branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

---

## 📁 Struktur Folder

```
sistem-pakar-motor/
├── app/
│   ├── Models/
│   │   ├── Gejala.php              ← Symptom model
│   │   ├── Kerusakan.php           ← Fault model
│   │   ├── Rule.php                ← Inference rule model
│   │   ├── Konsultasi.php          ← Consultation history
│   │   └── User.php
│   └── Http/Controllers/
│       ├── KonsultasiController.php ← Main logic
│       ├── GejalaController.php
│       ├── KerusakanController.php
│       ├── RuleController.php
│       └── DashboardController.php
├── database/
│   ├── migrations/
│   │   ├── *_create_gejalas_table.php
│   │   ├── *_create_kerusakans_table.php
│   │   ├── *_create_rules_table.php
│   │   ├── *_create_rule_gejala_table.php
│   │   └── *_create_konsultasis_table.php
│   └── seeders/
│       ├── GejalaSeeder.php
│       ├── KerusakanSeeder.php
│       ├── RuleSeeder.php
│       └── DatabaseSeeder.php
├── resources/views/
│   ├── konsultasi/
│   │   ├── index.blade.php         ← Form konsultasi
│   │   └── hasil.blade.php         ← Hasil diagnosa
│   ├── user/
│   │   └── home.blade.php          ← Landing page
│   ├── dashboard.blade.php
│   └── layouts/
│       └── app.blade.php
├── routes/
│   ├── web.php
│   └── auth.php
├── .env.example
├── .gitignore
├── composer.json
├── package.json
└── README.md (file ini)
```

---

## 📊 Bagaimana Algoritma Bekerja

### Forward Chaining Process

1. **User memilih gejala** - Checklist gejala yang dialami motor
2. **Sistem menganalisis rules** - Setiap rule dibandingkan dengan gejala user
3. **Hitung confidence** 
   ```
   Formula: (Gejala Cocok / Total Gejala Rule) × Certainty Factor × 100
   ```
4. **Urutkan hasil** - Hasil diurutkan dari confidence tertinggi ke terendah
5. **Tampilkan diagnosa** - Hasil utama + alternatif + solusi

### Contoh Perhitungan

**Rule: Baterai Lemah**
- Gejala yang diperlukan: [Mesin Tidak Bisa Dihidupkan, Baterai Lemah]
- Certainty Factor: 0.95
- User memilih: [Mesin Tidak Bisa Dihidupkan, Baterai Lemah, Koil Rusak]
- Gejala cocok: 2 dari 2
- **Perhitungan:** (2/2) × 0.95 × 100 = **95%** ✅

---

## 🔐 Authentication

Sistem menggunakan Laravel Breeze untuk authentication.

### Default Routes (Authenticated)
- `/dashboard` - Admin dashboard
- `/gejala` - CRUD gejala
- `/kerusakan` - CRUD kerusakan  
- `/rule` - CRUD rules

### Public Routes
- `/` - Landing page
- `/konsultasi` - Form konsultasi
- `/konsultasi/proses` - Process diagnosis
- `/login` - Login page
- `/register` - Register page

---

## 📄 Lisensi

MIT License - Bebas digunakan untuk keperluan akademik dan non-komersial.

Untuk penggunaan komersial, hubungi tim development.

---

## 🎓 Referensi

### Jurnal yang Digunakan

1. Artificial Intelligence and Expert Systems dalam Diagnosis Medis
2. Forward Chaining dan Backward Chaining dalam Knowledge Representation
3. Certainty Factor dalam Sistem Pakar Medis
4. Design Patterns dalam Laravel Web Development
5. Best Practices untuk Expert System Implementation

---

## 🗓️ Changelog

### v1.0.0 (01 Januari 2026)
- ✅ Initial release
- ✅ Forward Chaining algorithm implemented
- ✅ 15 symptoms + 10 faults database
- ✅ Admin panel dengan CRUD operations
- ✅ User authentication system
- ✅ Consultation history tracking
- ✅ Comprehensive README documentation

---

**Terakhir diupdate:** 01 Januari 2026  
**Status:** Production Ready ✅
