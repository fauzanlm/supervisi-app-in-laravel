# School Academic Supervision Information System (Supervisi App)

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<p align="center">
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-8.75-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Version"></a>
  <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-%5E8.0-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version"></a>
  <a href="https://getbootstrap.com"><img src="https://img.shields.io/badge/Bootstrap-5.1.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap Version"></a>
  <a href="https://www.mysql.com"><img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge" alt="License MIT"></a>
</p>

---

## 📌 Problem Statement & Overview

In educational institutions, **academic supervision** is a foundational process for quality assurance, teacher professional development, and curriculum compliance. Traditional school supervision workflows often encounter severe operational challenges:

* **Fragmented Document Management**: Lesson plans (*Rencana Pelaksanaan Pembelajaran* / RPP) and instructional syllabi are physically submitted on paper or dispersed across unmanaged email threads and chat groups.
* **Manual and Unsynchronized Scheduling**: Matching available peer supervisors with target teachers leads to timetable conflicts, missed observation windows, and lack of accountability.
* **Lack of Centralized Learning Artifacts**: Video recordings of classroom teaching practices and pedagogical evidence are rarely archived or paired directly with evaluation notes.
* **Delayed Decision-Making**: Principals and curriculum coordinators lack real-time visibility into school-wide supervision progress, impeding data-driven teacher evaluations and semester-end accreditations.

### 💡 The Solution

**Supervisi App** is a centralized web-based Academic Supervision Information System developed with **Laravel 8** and **Bootstrap 5 (SB Admin 2)**. It provides a secure, role-governed environment connecting **Curriculum Directors**, **Teachers (Supervisees)**, **Peer Supervisors**, and **School Principals** to automate and track the entire supervision lifecycle from scheduling to evaluation and reporting.

---

## 🔄 Supervision Workflow Architecture

The academic supervision process follows a sequential, multi-stakeholder operational loop:

```mermaid
sequenceDiagram
    autonumber
    actor Kurikulum as Bagian Kurikulum
    actor Guru as Guru (Supervisee)
    actor Supervisor as Guru Penilai (Supervisor)
    actor Kepsek as Kepala Sekolah

    Note over Kurikulum: Inisialisasi Data & Kalender
    Kurikulum->>Kurikulum: Daftarkan akun Guru & tetapkan hak akses Supervisor
    Kurikulum->>Supervisor: Plotting Jadwal Supervisi (Tanggal, Jam, Target Guru)
    
    Note over Guru: Persiapan & Unggah Berkas
    Guru->>Guru: Cek jadwal supervisi di Dashboard
    Guru->>Supervisor: Unggah berkas RPP (PDF) & tautan video pembelajaran
    
    Note over Supervisor: Pelaksanaan & Penilaian
    Supervisor->>Supervisor: Review dokumen RPP & telaah video micro-teaching
    alt Memenuhi Standar Kompetensi
        Supervisor->>Guru: Tetapkan status "Lulus" + Catatan rekomendasi
    else Butuh Perbaikan Pedagogis
        Supervisor->>Guru: Tetapkan status "Tidak Lulus" + Catatan evaluasi
    end

    Note over Kurikulum,Kepsek: Monitoring & Rekapitulasi Eksekutif
    Supervisor->>Kurikulum: Sinkronisasi data hasil supervisi
    Kurikulum->>Kepsek: Akses rekap laporan hasil supervisi guru per periode
    Kepsek->>Kepsek: Audit mutu pembelajaran & tindak lanjut akreditasi
```

### Flowchart Proses Bisnis

```mermaid
flowchart TD
    Start([Mulai]) --> A[Kurikulum input master Guru & Supervisor]
    A --> B[Kurikulum buat Jadwal Supervisi]
    B --> C[Guru cek Jadwal & Unggah RPP + Link Video]
    C --> D{Supervisor Review Berkas & Observasi}
    D -- Memenuhi Syarat --> E[Status: LULUS + Catatan Penguatan]
    D -- Perlu Remedial/Revisi --> F[Status: TIDAK LULUS + Catatan Evaluasi]
    E --> G[Rekapitulasi Laporan Supervisi]
    F --> G
    G --> H[Monitoring Kepala Sekolah & Arsip Mutu]
    H --> End([Selesai])
```

---

## 👥 Role-Based Access Control (RBAC) Matrix

The system implements a role hierarchy combined with a dynamic supervisory privilege flag (`supervisor = 1`):

| Fitur / Modul | Guru (`guru`) | Supervisor (`supervisor = 1`) | Kurikulum (`kurikulum`) | Kepala Sekolah (`kepsek`) |
| :--- | :---: | :---: | :---: | :---: |
| **Login & Dashboard Profil** | ✅ | ✅ | ✅ | ✅ |
| **Lihat Jadwal Supervisi Mandiri** | ✅ | ✅ | ❌ | ❌ |
| **Unggah RPP (PDF) & Tautan Video** | ✅ | ❌ | ❌ | ❌ |
| **Pantau Status Kelulusan & Catatan** | ✅ | ❌ | ❌ | ❌ |
| **Daftar Tugas Supervisi & Target Guru** | ❌ | ✅ | ❌ | ❌ |
| **Review RPP & Streaming Video Guru** | ❌ | ✅ | ✅ | ✅ |
| **Input Nilai & Rekomendasi (Lulus/Tidak)** | ❌ | ✅ | ❌ | ❌ |
| **Manajemen Master Guru (Tambah Akun)** | ❌ | ❌ | ✅ | ❌ |
| **Promosi / Cabut Hak Supervisor** | ❌ | ❌ | ✅ | ❌ |
| **Atur & Hapus Kalender Jadwal Supervisi** | ❌ | ❌ | ✅ | ❌ |
| **Rekapitulasi Laporan Hasil Supervisi** | ❌ | ❌ | ✅ | ✅ |
| **Eksekutif Dashboard Monitoring** | ❌ | ❌ | ❌ | ✅ |

> [!NOTE]
> Seorang Guru yang ditunjuk oleh Kurikulum sebagai Supervisor (`supervisor = 1`) memperoleh akses ganda: portal guru untuk kewajiban mengajarnya sendiri dan portal supervisor untuk mengevaluasi guru sejawat.

---

## 🗄️ Skema Database Relasional (ERD)

Sistem menggunakan identifikasi unik berbasis **NIP** (*Nomor Induk Pegawai*) untuk menghubungkan entitas pengguna dengan agenda jadwal dan dokumen supervisi.

```mermaid
erDiagram
    USERS ||--o{ JADWALS : "target (nip)"
    USERS ||--o{ JADWALS : "supervisor (id_supervisor)"
    USERS ||--o{ DOCUMENTS : "owns (nip)"
    USERS ||--o{ DOCUMENTS : "evaluated_by (id_supervisor)"
    JADWALS ||--o| DOCUMENTS : "verified_via (nip)"

    USERS {
        bigint id PK
        string name "Nama Lengkap"
        string nip UK "Nomor Induk Pegawai"
        string alamat "Alamat Rumah"
        string role "kurikulum | kepsek | guru"
        tinyint supervisor "0 = Biasa, 1 = Supervisor"
        string email UK "Alamat Email"
        string password "Hashed Password"
        timestamp email_verified_at
        timestamps timestamps
    }

    JADWALS {
        bigint id PK
        string nip FK "NIP Guru Target"
        string id_supervisor FK "NIP Guru Supervisor"
        date tanggal_supervisi "Tanggal Observasi"
        time jam_dari "Waktu Mulai"
        time jam_sampai "Waktu Selesai"
        timestamps timestamps
    }

    DOCUMENTS {
        bigint id PK
        string nip FK "NIP Pemilik RPP"
        string id_supervisor FK "NIP Supervisor Penilai"
        string mapel "Mata Pelajaran"
        string rpp "Nama File PDF di public/rpp"
        string embed "URL Tautan Video Praktik"
        string status "belum lulus | lulus | tidak lulus"
        string catatan "Ulasan & Masukan Supervisor"
        timestamps timestamps
    }

    SUPERVISIS {
        bigint id PK
        string nip FK
        string id_supervisor FK
        string id_jadwal FK
        string id_document FK
        string rpp_status
        string video_status
        string catatan
        timestamps timestamps
    }
```

---

## 🔑 Kredensial Pengujian (Seeder Default)

Setelah menjalankan seeder bawaan (`php artisan db:seed` atau `UsersSeeder`), akun default berikut tersedia untuk pengujian:

| Role | Nama Pengguna | NIP (Username / Password Default) | Email | Hak Supervisor |
| :--- | :--- | :--- | :--- | :---: |
| **Kurikulum** | Kurikulum Supervisor | `1101` | `kurikulumsupervisor@abc.com` | `1` (Aktif) |
| **Kepala Sekolah** | Kepsek | `1102` | `kepsek@abc.com` | `1` (Aktif) |
| **Guru Baru** | *(Didaftarkan Kurikulum)* | Ditetapkan saat input | Ditetapkan saat input | `0` (Dapat dipromosikan) |

> [!TIP]
> Pada sistem ini, akun Guru baru yang didaftarkan melalui menu **Kurikulum > Tambah Guru** secara otomatis menggunakan nilai **NIP** sebagai password awal default (`Hash::make($request->nip)`).

---

## 🚀 Panduan Instalasi & Setup Lokal

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi pada lingkungan pengembangan lokal:

### Prasyarat
* PHP `>= 8.0` (disarankan PHP 8.0 - 8.2)
* Composer `>= 2.0`
* Node.js `>= 14.x` & NPM
* Database Server (MySQL / MariaDB)

### 1. Clone Repository
```bash
git clone https://github.com/fauzanlm/supervisi-app-in-laravel.git
cd supervisi-app-in-laravel
```

### 2. Pasang Dependensi Backend & Frontend
```bash
# Dependensi PHP
composer install

# Dependensi JavaScript & Kompilasi Aset
npm install
npm run dev
```

### 3. Konfigurasi Environment (`.env`)
Salin file template `.env.example` ke `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

Sesuaikan parameter koneksi database pada file `.env`:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=supervisi_app
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Eksekusi Migrasi & Seeding Database
Jalankan migrasi skema tabel beserta data awal:
```bash
# Pastikan database telah dibuat di MySQL
php artisan migrate --seed
```

### 5. Pastikan Izin Direktori Upload Dokumen
Aplikasi menyimpan file RPP berformat PDF pada direktori `public/rpp/`. Pastikan direktori memiliki izin tulis:
```bash
mkdir -p public/rpp storage/framework/views storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache public/rpp
```

### 6. Jalankan Server Pengembangan
```bash
php artisan serve
```
Aplikasi dapat diakses melalui browser pada: **`http://127.0.0.1:8000`** (otomatis dialihkan ke halaman `/login`).

---

## 📁 Struktur Direktori Utama

```text
supervisi-app-in-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── GuruController.php         # Handler unggah RPP & jadwal guru
│   │   │   ├── SupervisorController.php   # Penilaian & evaluasi berkas supervisi
│   │   │   ├── KurikulumController.php    # Manajemen guru, supervisor & jadwal
│   │   │   ├── KepsekController.php       # Monitoring laporan eksekutif
│   │   │   └── HomeController.php         # Redirection dashboard berbasis role
│   │   └── Middleware/
│   │       ├── Kurikulum.php              # Guard hak akses role kurikulum
│   │       ├── Supervisor.php             # Guard hak akses flag supervisor (1)
│   │       ├── Kepsek.php                 # Guard hak akses role kepala sekolah
│   │       └── PreventBackHistory.php     # Cache-control penghalang back-history browser
│   └── Models/
│       ├── User.php                       # Entitas pengguna & autentikasi
│       ├── Jadwal.php                     # Model relasi jadwal supervisi
│       ├── Documents.php                  # Model berkas RPP & video pembelajaran
│       └── Supervisi.php                  # Model rincian hasil observasi
├── database/
│   ├── migrations/                        # Definisi skema tabel database
│   └── seeders/                           # Seeder akun default (UsersSeeder)
├── public/
│   └── rpp/                               # Penyimpanan berkas PDF RPP guru
├── resources/
│   └── views/
│       ├── guru/                          # Tampilan dashboard & form upload guru
│       ├── supervisor/                    # Tampilan jadwal & form penilaian supervisor
│       ├── kurikulum/                     # Tampilan manajemen guru, jadwal & laporan
│       ├── kepsek/                        # Tampilan dashboard & laporan kepala sekolah
│       └── layouts/                       # Master template (SB Admin 2)
└── routes/
    └── web.php                            # Routing web & proteksi middleware
```

---

## 🛡️ Keamanan & Integritas Data

* **CSRF Protection**: Seluruh request state-changing (`POST`, `PATCH`, `DELETE`) dilindungi token CSRF Laravel.
* **Prevent Back History**: Middleware `PreventBackHistory` memastikan browser tidak memuat ulang halaman sensitif dari cache setelah pengguna logout.
* **MIME-Type & Size Validation**: Unggahan RPP dibatasi khusus dokumen berkas PDF dengan batas kapasitas maksimal 2048 KB (2 MB).
* **Hash Password**: Sandi akun dienkripsi menggunakan algoritma `Bcrypt` bawaan Laravel.

---

## 📄 Lisensi

Proyek ini didistribusikan di bawah lisensi **[MIT License](LICENSE)**.
