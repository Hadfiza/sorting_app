# Media Pembelajaran Interaktif Berbasis Web pada Materi Sorting Algorithms

Media pembelajaran interaktif berbasis web yang dikembangkan menggunakan Laravel dengan integrasi Docker, MySQL, dan Pyodide. Aplikasi ini mendukung proses pembelajaran materi **Sorting Algorithms** melalui penyajian materi, simulasi, latihan, praktikum, dan evaluasi.

---

## Teknologi

- Laravel
- PHP 8.3
- MySQL 8.4
- Nginx
- Docker & Docker Compose
- Bootstrap
- JavaScript
- Pyodide

---

## Persyaratan

- Docker Desktop
- Git

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/USERNAME/REPOSITORY.git
cd REPOSITORY
```

### 2. Salin File Environment

Windows

```powershell
Copy-Item .env.example .env
```

Linux/macOS

```bash
cp .env.example .env
```

### 3. Jalankan Docker

```bash
docker compose up -d --build
```

### 4. Generate Application Key

```bash
docker compose exec app php artisan key:generate
```

### 5. (Opsional) Storage Link

```bash
docker compose exec app php artisan storage:link
```

---

## Akses Aplikasi

```
http://localhost:8000
```

---

## Database

Database telah disertakan dalam project dan akan diimpor secara otomatis saat container MySQL pertama kali dijalankan.

Lokasi file:

```
docker/mysql/init/database.sql
```

Tidak diperlukan menjalankan perintah:

```bash
php artisan migrate
php artisan db:seed
```

---

## Docker

Menjalankan aplikasi

```bash
docker compose up -d
```

Menghentikan aplikasi

```bash
docker compose down
```

Membangun ulang image

```bash
docker compose up -d --build
```

---

## Struktur Project

```
sorting/
├── app/
├── config/
├── docker/
│   ├── nginx/
│   └── mysql/
├── public/
├── resources/
├── routes/
├── storage/
├── Dockerfile
├── docker-compose.yml
├── .env.example
└── README.md
```

---

## Docker Hub

```
https://hub.docker.com/r/fiza019/sortlearn
```

---

## Pengembang

Hadfiza

Program Studi Pendidikan Komputer  
Fakultas Keguruan dan Ilmu Pendidikan  
Universitas Lambung Mangkurat