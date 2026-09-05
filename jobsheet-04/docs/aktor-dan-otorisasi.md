# Aktor dan Otorisasi
## 1. Aktor Sistem

Sistem SIMPUS-Mini memiliki dua aktor utama, yaitu Tamu dan Petugas.

### Tamu
Tamu merupakan pengguna yang mengakses sistem tanpa melakukan login. Akses Tamu dibatasi pada fitur yang bersifat umum.

Tamu dapat:
- Melihat Beranda.
- Melihat Daftar Buku.

Tamu tidak dapat:
- Mengelola data buku.
- Mengelola data anggota.
- Melakukan peminjaman.
- Melakukan pengembalian.
- Melihat transaksi.

### Petugas
Petugas merupakan pengguna internal yang bertanggung jawab dalam mengelola data dan transaksi perpustakaan. Petugas harus melakukan login terlebih dahulu sebelum dapat mengakses fitur internal sistem.

Petugas dapat:
- Mengelola data buku.
- Mengelola data anggota.
- Melakukan peminjaman.
- Melakukan pengembalian.
- Melihat transaksi.

---

## 2. Otorisasi
Otorisasi digunakan untuk membatasi akses pengguna berdasarkan peran masing-masing. Tamu dapat mengakses informasi umum seperti Beranda dan Daftar Buku tanpa melakukan login, tetapi tidak dapat mengakses fitur pengelolaan data maupun transaksi. Sementara itu, Petugas harus melakukan login terlebih dahulu untuk mengakses fitur internal SIMPUS-Mini. Setelah login berhasil, Petugas dapat menggunakan fitur pengelolaan data dan transaksi sesuai dengan hak akses yang telah ditentukan. Pembagian hak akses ini bertujuan untuk menjaga keamanan sistem dan memastikan setiap fitur hanya dapat digunakan oleh pengguna yang memiliki kewenangan.