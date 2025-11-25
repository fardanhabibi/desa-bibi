Testing Checklist — Admin 'Simpan' Flows

Priority: Manual end-to-end checks to confirm Create/Edit/Delete work and persist to DB.

How to use:
- Log in to admin panel locally.
- For each module below follow the steps: Create a new record (fill all required fields), Save, verify success message and database row; Edit the record, change a field, Save, verify database changed; Delete the record, confirm removal.
- Note any validation errors or server errors (500) and capture the exception trace (laravel.log).

Modules & Test Cases

1) Penduduk
- Create: Fill NIK (unique), Nama, Tanggal Lahir, Alamat, etc; Save.
- Edit: Change alamat; Save.
- Delete: Delete the created record.
- Edge: Submit missing required fields; submit duplicate NIK.

2) Kelahiran
- Create: Pilih/masukkan Nama Anak, Tanggal Lahir, Tempat Lahir, Orang Tua (nama/nik depending on UI); Save.
- Edit: Update tempat_lahir; Save.
- Delete: Remove the record.
- Edge: Submit nama orang tua sebagai teks (if UI allows) and ensure DB accepts.

3) Kematian
- Create: Nama almarhum, tanggal, keterangan; Save.
- Edit: Update keterangan; Save.
- Delete: Remove.
- Edge: Attempt to create with missing tanggal.

4) Migrasi
- Create: Isi asal/tujuan, nama penduduk, tanggal; Save.
- Edit: Ubah tujuan; Save.
- Delete: Remove.

5) Kegiatan (KegiatanDesa)
- Create: Judul kegiatan, tanggal mulai/selesai, deskripsi; Save.
- Edit: Ubah tanggal; Save.
- Delete: Remove.

6) Berita
- Create: Judul, isi, publish status; Upload thumbnail (if available); Save.
- Edit: Update isi; Save.
- Delete: Remove.

7) Surat / Pengajuan Surat (admin flows)
- Create if applicable (admin create surat templates), Save.
- For pengajuan: process a pengajuan (change status) and ensure persistence.

8) Kontak Desa, FAQ, Download Formulir, Forum Diskusi (basic)
- For each: Create, Edit, Delete, check persistence.

9) Cross-check removed modules
- Verify Program Desa and Permohonan Layanan do not appear in sidebar.
- Visit old URLs:
  - /admin/program
  - /admin/permohonan_layanan
  Ensure they redirect to /admin/kegiatan.

Notes & Troubleshooting
- If any 500/exception: check storage/logs/laravel.log for stacktrace, capture route/form that triggered it, and notify the dev.
- For DB FK errors: check the migrated schema and run php artisan migrate:status locally.

When done: report back with any failing cases (module, action, error message, stack trace).
