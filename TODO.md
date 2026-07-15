# TODO
- [x] Baca relasi model User-Petugas, migration, dan role middleware.
- [x] Rapikan routes `petugas` yang dobel di `routes/web.php`.
- [x] Perbaiki `RoleMiddleware` supaya case-insensitive (`Petugas` vs `petugas`).
- [x] Jalankan migrasi (tidak ada yang berubah) dan seed ulang.
- [x] Cek relasi: user(role=admin)->petugas -> petugas.user_id terisi.
- [ ] Uji manual: login admin -> create/edit petugas -> pastikan relasi tetap benar.


