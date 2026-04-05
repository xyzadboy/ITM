# 🚨 Incident & Ticket Management System

<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<p align="center">
Sistem manajemen insiden dan tiket berbasis web untuk meningkatkan efisiensi penanganan masalah IT secara terstruktur, terukur, dan terdokumentasi.
</p>

---

## 📌 Deskripsi

**Incident and Ticket Management System** adalah aplikasi berbasis web yang dirancang untuk membantu organisasi dalam:

- Mencatat setiap insiden yang terjadi pada sistem
- Mengelola tiket secara sistematis
- Memantau proses penyelesaian masalah
- Meningkatkan respons dan akuntabilitas tim IT

Sistem ini mengadopsi praktik terbaik dari framework IT Service Management seperti ITIL.

---

## 🎯 Tujuan

- Mempercepat penanganan insiden  
- Menghindari kehilangan laporan masalah  
- Memberikan transparansi kepada user  
- Menyediakan data historis untuk analisis  

---

## ⚙️ Fitur Utama

### 🧾 Manajemen Tiket
- Pembuatan tiket otomatis  
- Tracking status (Open, In Progress, Resolved, Closed)  
- Assign tiket ke teknisi  

### 🚨 Manajemen Insiden
- Kategorisasi insiden  
- Penentuan prioritas (Low, Medium, High)  
- SLA monitoring  

### 👥 Role Management
- Admin  
- User / Pelapor  
- Teknisi  

### 📊 Dashboard & Monitoring
- Statistik tiket  
- Performa penyelesaian  
- Monitoring real-time  

### 🔔 Notifikasi
- Update status tiket  
- Reminder penanganan  

---

## 🏗️ Teknologi yang Digunakan

- **Framework**: Laravel  
- **Backend**: PHP  
- **Database**: MySQL / PostgreSQL  
- **Frontend**: Blade / Livewire / (opsional Vue/React)  
- **Authentication**: Laravel Auth / Multi Auth  

---

## 🔄 Alur Sistem

1. User melaporkan insiden  
2. Sistem membuat tiket  
3. Admin mengkategorikan & menentukan prioritas  
4. Tiket ditugaskan ke teknisi  
5. Teknisi melakukan penanganan  
6. Status diperbarui hingga selesai  
7. Tiket ditutup dan didokumentasikan  

---

## 🧩 Struktur Modul

- Manajemen User  
- Manajemen Tiket  
- Kategori & Prioritas  
- Departemen  
- Laporan & Analitik  

---

## 🚀 Instalasi

```bash
git clone https://github.com/username/incident-ticket-management.git
cd incident-ticket-management

composer install
cp .env.example .env
php artisan key:generate

# konfigurasi database di file .env

php artisan migrate
php artisan serve
```

---

## 🔐 Akun Default (Opsional)

| Role   | Email            | Password |
|--------|----------------|----------|
| Admin  | admin@mail.com | password |
| User   | user@mail.com  | password |

---

## 📈 Pengembangan Selanjutnya

- Integrasi email & WhatsApp notification  
- API untuk mobile app  
- Machine learning untuk prediksi incident  
- Integrasi dengan monitoring tools  

---

## 🤝 Kontribusi

Kontribusi sangat terbuka untuk pengembangan lebih lanjut.  
Silakan fork repository ini dan ajukan pull request.

---

## 📄 Lisensi

Project ini menggunakan lisensi MIT.
