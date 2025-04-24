# Laravel Microservices Setup

Proyek ini terdiri dari tiga microservice terpisah menggunakan Laravel:

- 🧑 **User Service** — `localhost:8001`
- 📦 **Product Service** — `localhost:8002`
- 🛒 **Order Service** — `localhost:8003`

Setiap service berjalan secara independen, dapat dikembangkan, di-deploy, dan diskalakan secara terpisah.

---

## 🔧 Prasyarat

- PHP 8.x atau lebih baru
- Composer
- Laravel 9.x atau lebih baru
- Database (MySQL / MariaDB)
- Node.js (untuk frontend jika diperlukan)
- Postman atau cURL (untuk testing API)

---

## 📁 Struktur Proyek

laravel-microservices/ ├── user-service/ ← Menangani manajemen user ├── product-service/ ← Menangani data produk └── order-service/ ← Menangani pemesanan

yaml
Copy
Edit

---
