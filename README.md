## SI-Lapor

SI-Lapor adalah aplikasi web untuk pelaporan dan manajemen data. Berikut adalah beberapa fitur utama:

![erd](erd_silapor.png)

| No | Nama Tabel            | Deskripsi                                                                                         | Atribut Penting / Relasi                                                                                   |
|----|-----------------------|--------------------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------|
| 1  | **users**             | Menyimpan data akun pengguna.                                                                    | **Atribut:** name, email, password, nik, role (admin/user), is_verified.<br>**Relasi:**<br>- 1 user bisa membuat banyak pengaduan.<br>- 1 admin bisa memberikan banyak tanggapan.<br>- 1 user bisa menulis banyak komentar. |
| 2  | **warga_terdaftar**   | Data warga yang terdaftar di kelurahan (untuk validasi saat register).                          | **Atribut:** nik, alamat, kelurahan.<br>**Relasi:** Tidak terhubung langsung, hanya sebagai referensi validasi sebelum user bisa daftar. |
| 3  | **pengaduans**        | Data inti pengaduan yang dibuat oleh user.                                                      | **Atribut:** judul, isi, gambar, status (menunggu, diproses, dll).<br>**Relasi:**<br>- Dimiliki oleh 1 user.<br>- Bisa punya 1 kategori.<br>- Bisa punya banyak lampiran, komentar, dan tanggapan. |
| 4  | **kategori_pengaduans**| Menyimpan daftar kategori pengaduan (misal: jalan rusak, lampu mati).                          | **Relasi:** Satu kategori bisa digunakan oleh banyak pengaduan.                                            |
| 5  | **tanggapans**        | Diisi oleh admin untuk merespons pengaduan.                                                     | **Relasi:**<br>- 1 tanggapan milik 1 pengaduan.<br>- Diberikan oleh 1 admin (user dengan role admin).      |
| 6  | **komentar**          | Komentar tambahan dari user terhadap pengaduan.                                                 | **Relasi:**<br>- 1 user bisa memberi banyak komentar.<br>- 1 pengaduan bisa punya banyak komentar.         |
| 7  | **lampiran_pengaduan**| Lampiran tambahan selain gambar utama di pengaduan.                                             | **Atribut:** Menyimpan file dan keterangan lampiran.<br>**Relasi:** 1 pengaduan bisa punya banyak lampiran.|

---

### Fitur yang Sudah Dibangun

#### 🔐 Autentikasi & Registrasi
- Form login dan register dengan Laravel Breeze
- Validasi NIK dan nama dari tabel warga_terdaftar saat register
- Role-based access (admin vs user)
- Middleware VerifiedUser untuk mencegah user yang belum diverifikasi login
- Auto login setelah register (hanya bisa akses jika sudah diverifikasi)

#### 👤 Manajemen Pengguna
**Untuk Admin:**
- Melihat daftar seluruh user
- Melihat status verifikasi user
- Memverifikasi user secara manual
- Filter user berdasarkan status verifikasi

**Untuk User:**
- Melihat dan edit profil sendiri

#### 📢 Pengaduan Masyarakat
**Untuk User:**
- Membuat pengaduan (judul, isi, kategori)
- Melihat daftar pengaduan miliknya
- Upload lampiran (opsional)
- Edit/hapus pengaduan (opsional)

**Untuk Admin:**
- Melihat semua pengaduan
- Filter berdasarkan status atau kategori
- Mengubah status pengaduan (pending → proses → selesai)
- Menambahkan tanggapan atas pengaduan

---

### Fitur yang Akan Dibangun

#### 🗂️ Kategori Pengaduan
- CRUD kategori (admin)
- User memilih kategori saat membuat pengaduan
- Filter pengaduan berdasarkan kategori (admin)

#### 📎 Lampiran Pengaduan
- Upload satu atau lebih file saat buat pengaduan
- Admin/user bisa lihat lampiran di detail pengaduan

#### 💬 Komentar pada Pengaduan
- User bisa memberi komentar pada pengaduan
- Admin bisa membalas/menanggapi komentar

#### 🛠️ Tanggapan Admin
- Admin memberi tanggapan pada pengaduan (1 pengaduan = 1 tanggapan)
- Tanggapan muncul di detail pengaduan user

#### 📊 Dashboard Admin
- Jumlah user terdaftar & terverifikasi
- Statistik jumlah pengaduan per kategori
- Statistik pengaduan berdasarkan status
- Grafik tren pengaduan bulanan
