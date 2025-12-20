<?php
if (!isset($_SESSION['login'])) {
    header("Location:" . BASEURL . "Login");
    exit;
}
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2>Peminjaman</h2>
                </div>
                <div class="col-md-4 robot-container d-none d-md-block">
                    <svg class="robot-img" viewBox="0 0 200 240" xmlns="http://www.w3.org/2000/svg">
                        <!-- Robot Body -->
                        <ellipse cx="100" cy="140" rx="60" ry="70" fill="#e2e8f0" />
                        <!-- Robot Head -->
                        <rect x="70" y="40" width="60" height="60" rx="15" fill="#2d3748" />
                        <!-- Eyes -->
                        <rect x="80" y="60" width="15" height="10" rx="2" fill="#4fd1c5" />
                        <rect x="105" y="60" width="15" height="10" rx="2" fill="#4fd1c5" />
                        <!-- Antenna -->
                        <circle cx="85" cy="35" r="8" fill="#e2e8f0" />
                        <line x1="85" y1="40" x2="85" y2="43" stroke="#cbd5e0" stroke-width="3" />
                        <circle cx="115" cy="35" r="8" fill="#e2e8f0" />
                        <line x1="115" y1="40" x2="115" y2="43" stroke="#cbd5e0" stroke-width="3" />
                        <!-- Arms -->
                        <rect x="35" y="120" width="15" height="40" rx="7" fill="#cbd5e0" />
                        <rect x="150" y="120" width="15" height="40" rx="7" fill="#cbd5e0" />
                        <!-- Power Button -->
                        <circle cx="100" cy="145" r="12" fill="white" />
                        <path d="M 100 138 L 100 145 M 97 142 A 5 5 0 0 1 103 142" stroke="#667eea" stroke-width="2" fill="none" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="process_peminjaman.php">
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="judul_kegiatan">Judul kegiatan</label>
                        <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="tanggal_pengajuan">Tanggal pengajuan</label>
                        <div class="date-wrapper">
                            <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="mulai_tanggal">Mulai dari tanggal</label>
                        <div class="date-wrapper">
                            <input type="date" class="form-control" id="mulai_tanggal" name="mulai_tanggal" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="sampai_tanggal">Sampai tanggal</label>
                        <div class="date-wrapper">
                            <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="jenis_barang">Jenis barang</label>
                        <select name="sub_barang" id="sub_barang" onchange="this.form.submit()" class="dropdown-filter">
                            <option value="">Pilih Jenis Barang</option>
                            <?php foreach ($data['sub_barang'] ?? [] as $sub): ?>
                                <option value="<?= $sub['id_jenis_barang'] ?>"
                                    <?= isset($_SESSION['selected_sub_barang']) && $_SESSION['selected_sub_barang'] == $sub['id_jenis_barang'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($sub['sub_barang']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Informasi tambahan">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="info-icon">
                        <i class="bi bi-info-lg"></i>
                    </div>
                    <button type="submit" class="btn btn-submit" style="width: auto; padding: 0.75rem 3rem;">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>