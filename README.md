# Website Bioskop

Website ini adalah aplikasi sederhana untuk menampilkan daftar film dan memesan tiket bioskop. Proyek ini menggunakan SQL sebagai basis data dan Tailwind CSS untuk styling.

## Fitur Utama
- Menampilkan daftar film yang sedang tayang.
- Menampilkan jadwal penayangan film.
- Pemesanan tiket secara online.

## Teknologi yang Digunakan
- **Backend**: SQL untuk database.
- **Frontend**: HTML, JavaScript, dan Tailwind CSS untuk styling.

## Cara Instalasi
1. Clone repositori ini:
   ```bash
   git clone https://github.com/yawwnann/website-bioskop.git
   cd website-bioskop
   ```
2. Instal dependensi (jika menggunakan framework tertentu):
   ```bash
   npm install
   ```
3. Konfigurasi database:
   - Buat database baru di server database Anda.
   - Tambahkan detail koneksi database di file konfigurasi.
4. Jalankan aplikasi:
   ```bash
   npm start
   ```
5. Buka browser dan akses:
   ```
   http://localhost:3000
   ```

## Struktur Database
- **Movies**: Menyimpan informasi film.
- **Schedules**: Menyimpan jadwal penayangan.
- **Tickets**: Menyimpan data pemesanan tiket.

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).
