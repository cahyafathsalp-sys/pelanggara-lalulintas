# TODO - Role Petugas & Menu Dashboard

## Plan Implementation
1. Tambahkan route Dashboard khusus role `petugas` (mis. `/petugas/dashboard`) yang menampilkan view dashboard petugas.
2. Buat view `resources/views/petugas/dashboard.blade.php` berisi menu: 
   - Data Pengendara
   - Data Kendaraan
   - Pelanggaran
   - Laporan PD
3. Update `resources/views/layouts/app.blade.php` agar menu Dashboard + item petugas hanya muncul untuk user dengan role `petugas`.
4. Batasi akses data CRUD (`pengendara`, `kendaraan`, `pelanggaran`, `laporan`) agar hanya bisa diakses oleh role `petugas` (gunakan middleware `role:petugas` di routes).
5. Pastikan route `Laporan PD` mengarah ke `/laporan` atau route laporan yang sudah ada.
6. Update file `TODO.md` setelah langkah selesai.

