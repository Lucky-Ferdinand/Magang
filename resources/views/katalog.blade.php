<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku & Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container-fluid mt-4 mb-5 px-4">
    <h2 class="text-center mb-4">Manajemen Katalog Buku</h2>

    <div class="row">
        <!-- Kolom Kiri: Form -->
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">Tambah Kategori</div>
                <div class="card-body">
                    <form id="form-tambah-kategori">
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" id="nama_kategori" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Kategori</button>
                    </form>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-success text-white">Tambah Buku</div>
                <div class="card-body">
                    <form id="form-tambah-buku">
                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" id="judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Kategori</label>
                            <select id="kategori_id" class="form-select" required></select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" id="harga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok (Jumlah)</label>
                            <input type="number" id="jumlah_produk" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Simpan Buku</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Tabel -->
        <div class="col-md-9">
            <!-- Tabel Kategori -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">Daftar Kategori</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Kategori</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabel-kategori"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tabel Buku -->
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">Daftar Buku</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul Buku</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabel-buku"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL EDIT BUKU ================= -->
<div class="modal fade" id="modalEditBuku" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-edit-buku">
          <div class="modal-body">
              <input type="hidden" id="edit_buku_id">
              <div class="mb-3">
                  <label class="form-label">Judul Buku</label>
                  <input type="text" id="edit_judul" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label class="form-label">Pilih Kategori</label>
                  <select id="edit_kategori_id" class="form-select" required></select>
              </div>
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label">Harga (Rp)</label>
                      <input type="number" id="edit_harga" class="form-control" required>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label class="form-label">Stok</label>
                      <input type="number" id="edit_jumlah_produk" class="form-control" required>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan Buku</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- ================= MODAL EDIT KATEGORI ================= -->
<div class="modal fade" id="modalEditKategori" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-edit-kategori">
          <div class="modal-body">
              <!-- ID Kategori yang disembunyikan -->
              <input type="hidden" id="edit_kategori_id_hidden">
              <div class="mb-3">
                  <label class="form-label">Nama Kategori</label>
                  <input type="text" id="edit_nama_kategori" class="form-control" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-info text-white">Simpan Perubahan Kategori</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const API_KATEGORI = '/api/kategori';
    const API_BUKU = '/api/buku';

    let globalKategori = [];
    let modalEditBuku;
    let modalEditKategori; // Deklarasi variabel untuk Modal Kategori

    document.addEventListener('DOMContentLoaded', () => {
        // Inisialisasi Modal
        modalEditBuku = new bootstrap.Modal(document.getElementById('modalEditBuku'));
        modalEditKategori = new bootstrap.Modal(document.getElementById('modalEditKategori'));

        loadKategori();
        loadBuku();
    });

    const formatRupiah = (angka) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    }

    // ================== FUNGSI READ (LOAD) ==================
    async function loadKategori() {
        try {
            const response = await fetch(API_KATEGORI);
            globalKategori = await response.json();

            const selectKategori = document.getElementById('kategori_id');
            const selectEditKategori = document.getElementById('edit_kategori_id');
            const tbodyKategori = document.getElementById('tabel-kategori');

            let optionsHTML = '<option value="" disabled selected>-- Pilih Kategori --</option>';
            tbodyKategori.innerHTML = '';

            if (globalKategori.length === 0) {
                tbodyKategori.innerHTML = '<tr><td colspan="3" class="text-center">Belum ada kategori.</td></tr>';
            } else {
                globalKategori.forEach((kategori, index) => {
                    optionsHTML += `<option value="${kategori.id}">${kategori.nama_kategori}</option>`;

                    // Tambahan: Tombol Edit Kategori di Tabel
                    tbodyKategori.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${kategori.nama_kategori}</td>
                            <td>
                                <button class="btn btn-sm btn-info text-white me-1" onclick="siapkanEditKategori('${kategori.id}')">Edit</button>
                                <button class="btn btn-sm btn-outline-danger" onclick="hapusKategori('${kategori.id}')">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            }

            selectKategori.innerHTML = optionsHTML;
            selectEditKategori.innerHTML = optionsHTML;
        } catch (error) {}
    }

    async function loadBuku() {
        try {
            const response = await fetch(API_BUKU);
            const data = await response.json();

            const tbodyData = document.getElementById('tabel-buku');
            tbodyData.innerHTML = '';

            if (data.length === 0) {
                tbodyData.innerHTML = '<tr><td colspan="6" class="text-center">Belum ada data buku.</td></tr>';
                return;
            }

            data.forEach((buku, index) => {
                const namaKategori = buku.kategori ? buku.kategori.nama_kategori : '<span class="text-danger">Kategori Terhapus</span>';

                tbodyData.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${buku.judul}</td>
                        <td><span class="badge bg-secondary">${namaKategori}</span></td>
                        <td>${formatRupiah(buku.harga)}</td>
                        <td>${buku.jumlah_produk} Pcs</td>
                        <td>
                            <button class="btn btn-sm btn-warning me-1" onclick="siapkanEditBuku('${buku.id}')">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="hapusBuku('${buku.id}')">Hapus</button>
                        </td>
                    </tr>
                `;
            });
        } catch (error) {}
    }

    // ================== FUNGSI DELETE ==================
    async function hapusKategori(id) {
        if(!confirm('Yakin ingin menghapus kategori ini?')) return;
        await fetch(`${API_KATEGORI}/${id}`, { method: 'DELETE', headers: { 'Accept': 'application/json' } });
        loadKategori();
        loadBuku();
    }

    async function hapusBuku(id) {
        if(!confirm('Yakin ingin menghapus buku ini?')) return;
        await fetch(`${API_BUKU}/${id}`, { method: 'DELETE', headers: { 'Accept': 'application/json' } });
        loadBuku();
    }

    // ================== FUNGSI CREATE (TAMBAH) ==================
    document.getElementById('form-tambah-kategori').addEventListener('submit', async function(e) {
        e.preventDefault();
        const namaKategori = document.getElementById('nama_kategori').value;
        await fetch(API_KATEGORI, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ nama_kategori: namaKategori })
        });
        this.reset();
        loadKategori();
    });

    document.getElementById('form-tambah-buku').addEventListener('submit', async function(e) {
        e.preventDefault();
        await fetch(API_BUKU, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({
                judul: document.getElementById('judul').value,
                kategori_id: document.getElementById('kategori_id').value,
                harga: document.getElementById('harga').value,
                jumlah_produk: document.getElementById('jumlah_produk').value
            })
        });
        this.reset();
        loadBuku();
    });

    // ================== FUNGSI UPDATE BUKU ==================
    async function siapkanEditBuku(id) {
        const response = await fetch(`${API_BUKU}/${id}`);
        const buku = await response.json();

        if (globalKategori.length === 0) await loadKategori();

        document.getElementById('edit_buku_id').value = buku.id;
        document.getElementById('edit_judul').value = buku.judul;
        document.getElementById('edit_kategori_id').value = buku.kategori_id;
        document.getElementById('edit_harga').value = buku.harga;
        document.getElementById('edit_jumlah_produk').value = buku.jumlah_produk;

        modalEditBuku.show();
    }

    document.getElementById('form-edit-buku').addEventListener('submit', async function(e) {
        e.preventDefault();
        const idBuku = document.getElementById('edit_buku_id').value;
        await fetch(`${API_BUKU}/${idBuku}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({
                judul: document.getElementById('edit_judul').value,
                kategori_id: document.getElementById('edit_kategori_id').value,
                harga: document.getElementById('edit_harga').value,
                jumlah_produk: document.getElementById('edit_jumlah_produk').value
            })
        });
        modalEditBuku.hide();
        loadBuku();
    });

    // ================== FUNGSI UPDATE KATEGORI (BARU) ==================

    // 1. Membuka Modal & Mengambil Data Kategori
    async function siapkanEditKategori(id) {
        try {
            const response = await fetch(`${API_KATEGORI}/${id}`);
            const kategori = await response.json();

            document.getElementById('edit_kategori_id_hidden').value = kategori.id;
            document.getElementById('edit_nama_kategori').value = kategori.nama_kategori;

            modalEditKategori.show();
        } catch (error) {
            console.error("Gagal mengambil data kategori");
        }
    }

    // 2. Mengirim Data Perubahan Kategori ke API
    document.getElementById('form-edit-kategori').addEventListener('submit', async function(e) {
        e.preventDefault();
        const idKategori = document.getElementById('edit_kategori_id_hidden').value;
        const namaKategoriBaru = document.getElementById('edit_nama_kategori').value;

        try {
            const response = await fetch(`${API_KATEGORI}/${idKategori}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({
                    nama_kategori: namaKategoriBaru
                })
            });

            if(response.ok) {
                modalEditKategori.hide();
                loadKategori(); // Refresh tabel kategori dan dropdown
                loadBuku();     // Refresh tabel buku agar nama kategori di situ ikut berubah (Reactive)
            }
        } catch (error) {
            console.error("Gagal menyimpan perubahan kategori");
        }
    });

</script>

</body>
</html>
