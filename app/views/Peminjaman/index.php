<?php
if (!isset($_SESSION['login'])) {
    header("Location:" . BASEURL . "Login");
    exit;
}
?>
<!-- modal keluar -->
<div class="modal fade modal-custom" id="konfirmasiKeluar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <lottie-player 
                    src="https://lottie.host/48c004f8-57cd-4acb-a04a-de46793ba7dc/jUGVFL9qIO.json"
                    background="##FFFFFF" 
                    speed="1" 
                    style="width: 250px; height: 250px; margin: 0 auto;" 
                    loop 
                    autoplay>
                </lottie-player>
                <p class="mt-3 mb-0" style="color: #64748b; font-weight: 500;">
                    Apakah anda yakin ingin keluar?
                </p>
            </div>
            <div class="modal-footer d-flex justify-content-end gap-2">
                <button type="button" class="btn-secondary-custom" data-dismiss="modal">Batal</button>
                <button type="button" class="btn-danger-custom" onclick="location.href='<?= BASEURL; ?>Logout'">
                    Keluar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="content">
    <div class="content-beranda" style="overflow: hidden;">
        <!-- Header -->
        <h3 id="title" class="mb-4" style="font-weight: 700; color: #1e293b;">Peminjaman</h3>
        
        <!-- Flash Message -->
        <div class="flash mb-4" style="width: 40%; margin-left: 15px;">
            <?php Flasher::flash(); ?>
        </div>
        
        <!-- Button & Filter Section -->
        <div class="mb-4 d-flex gap-3 align-items-center">
            <!-- Tambah Button -->
            <button data-toggle="modal" 
                    class="btn-primary-custom tombolTambahData" 
                    data-target="#exampleModal">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah</span>
            </button>
            
            <!-- Filters -->
            <form method="POST" action="" class="d-flex gap-3">
                <!-- Filter Jenis Barang -->
                <select name="sub_barang" id="sub_barang" onchange="this.form.submit()" class="dropdown-filter">
                    <option value="">Pilih Jenis Barang</option>
                    <?php foreach ($data['sub_barang'] ?? [] as $sub): ?>
                        <option value="<?= $sub['id_jenis_barang'] ?>" 
                                <?= isset($_SESSION['selected_sub_barang']) && $_SESSION['selected_sub_barang'] == $sub['id_jenis_barang'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($sub['sub_barang']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Filter Status -->
                <select name="status" id="status" onchange="this.form.submit()" class="dropdown-filter">
                    <option value="">Pilih Status</option>
                    <option value="diproses" <?= isset($_SESSION['selected_status']) && $_SESSION['selected_status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                    <option value="disetujui" <?= isset($_SESSION['selected_status']) && $_SESSION['selected_status'] == 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
                    <option value="ditolak" <?= isset($_SESSION['selected_status']) && $_SESSION['selected_status'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                </select>
            </form>
        </div>
        
        <!-- Table Container -->
        <div class="table-container">
            <!-- Table Header Controls -->
            <div class="table-header-sticky">
                <!-- Entries Dropdown -->
                <div class="entries-container">
                    <span>Show</span>
                    <select name="entries_length" class="entries-select form-control-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entries</span>
                </div>

                <!-- Search Box -->
                <div class="search-box-container">
                    <button class="search-button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="20" height="20">
                            <path d="M10 2a8 8 0 016.32 12.9l5.38 5.38a1 1 0 01-1.42 1.42l-5.38-5.38A8 8 0 1110 2zm0 2a6 6 0 100 12 6 6 0 000-12z"></path>
                        </svg>
                    </button>
                    <input type="text" 
                           id="customSearch" 
                           class="search-input form-control" 
                           placeholder="Cari peminjaman...">
                </div>
            </div>

            <!-- Table -->
            <table id="myTable" class="table table-hover table-sm table-custom">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Peminjam</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col">Jenis Barang</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($data['peminjaman'] as $peminjaman): ?>
                        <tr data-id="<?= $peminjaman['id_peminjaman'] ?>">
                            <td class="font-weight-medium"><?= $no++ ?></td>
                            <td><?= $peminjaman['nama_peminjam'] ?></td>
                            <td><?= date('d-m-Y', strtotime($peminjaman['tanggal_peminjaman'])) ?></td>
                            <td><?= date('d-m-Y', strtotime($peminjaman['tanggal_pengembalian'])) ?></td>
                            <td><?= $peminjaman['sub_barang']; ?></td>
                            <td>
                                <span class="badge badge-<?= $peminjaman['status'] == 'disetujui' ? 'success' : ($peminjaman['status'] == 'ditolak' ? 'danger' : 'warning') ?>">
                                    <?= ucfirst($peminjaman['status']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <?php if (isset($_SESSION['login']) && in_array($_SESSION['id_role'], ['1', '2', '3', '4'])): ?>
                                        <!-- Edit Button -->
                                        <a href="<?= BASEURL; ?>Peminjaman/ubahPeminjaman/<?= $peminjaman['id_peminjaman']; ?>"
                                           class="action-btn-custom action-btn-edit tampilModalPeminjaman"
                                           data-toggle="modal" 
                                           data-target="#exampleModal"
                                           data-id="<?= $peminjaman['id_peminjaman']; ?>">
                                            <i class="fa-solid fa-pen-to-square fa-lg" style="color: #059669;"></i>
                                        </a>
                                        
                                        <!-- Delete Button -->
                                        <a class="action-btn-custom action-btn-delete" 
                                           data-toggle="modal"
                                           data-target="#konfirmasiHapus<?= $peminjaman['id_peminjaman']; ?>">
                                            <i class="fa-solid fa-trash-can fa-lg" style="color: #dc2626;"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <!-- Detail Button -->
                                    <a href="<?= BASEURL; ?>Peminjaman/detail/<?= $peminjaman['id_peminjaman']; ?>"
                                       data-toggle="modal" 
                                       data-target="#modalPeminjaman<?= $peminjaman['id_peminjaman']; ?>"
                                       class="action-btn-custom action-btn-info">
                                        <i class="fa-solid fa-circle-info fa-lg" style="color: #2563eb;"></i>
                                    </a>
                                </div>

                                <!-- Modal Konfirmasi Hapus -->
                                <div class="modal fade modal-custom" id="konfirmasiHapus<?= $peminjaman['id_peminjaman']; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center py-4">
                                                <lottie-player
                                                    src="https://lottie.host/482b772b-9f0c-4065-b54d-dcc81da3b212/Dmb3I1o98u.json"
                                                    background="##FFFFFF" 
                                                    speed="1" 
                                                    style="width: 250px; height: 250px; margin: 0 auto;" 
                                                    loop 
                                                    autoplay>
                                                </lottie-player>
                                                <p class="mt-3 mb-0" style="color: #64748b; font-weight: 500;">
                                                    Apakah anda yakin ingin menghapus item ini?
                                                </p>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-end gap-2">
                                                <button type="button" class="btn-secondary-custom" data-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="button" class="btn-danger-custom"
                                                        onclick="location.href='<?= BASEURL; ?>Peminjaman/hapusPeminjaman/<?= $peminjaman['id_peminjaman']; ?>'">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Detail Peminjaman -->
                                <div class="modal fade modal-custom" id="modalPeminjaman<?= $peminjaman['id_peminjaman']; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Peminjaman</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span style="font-size: 1.5rem;">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <h6 class="detail-label">Nama Peminjam</h6>
                                                            <p class="detail-value"><?= $peminjaman['nama_peminjam']; ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <h6 class="detail-label">Judul Kegiatan</h6>
                                                            <p class="detail-value text-capitalize"><?= $peminjaman['judul_kegiatan']; ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <h6 class="detail-label">Tanggal Pengajuan</h6>
                                                            <p class="detail-value"><?= $peminjaman['tanggal_pengajuan']; ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <h6 class="detail-label">Tanggal Mulai Peminjaman</h6>
                                                            <p class="detail-value"><?= $peminjaman['tanggal_peminjaman']; ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <h6 class="detail-label">Tanggal Pengembalian</h6>
                                                            <p class="detail-value"><?= $peminjaman['tanggal_pengembalian']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <h6 class="detail-label">Jenis Barang</h6>
                                                            <p class="detail-value"><?= $peminjaman['sub_barang']; ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <h6 class="detail-label">Jumlah Peminjaman</h6>
                                                            <p class="detail-value"><?= $peminjaman['jumlah_peminjaman']; ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <h6 class="detail-label">Keterangan</h6>
                                                            <p class="detail-value"><?= $peminjaman['keterangan_peminjaman']; ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <h6 class="detail-label">Status</h6>
                                                            <span class="badge badge-<?= $peminjaman['status'] == 'disetujui' ? 'success' : ($peminjaman['status'] == 'ditolak' ? 'danger' : 'warning') ?>">
                                                                <?= ucfirst($peminjaman['status']) ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah/Edit Peminjaman -->
        <div class="modal fade modal-custom" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPeminjaman">Tambah Data Peminjaman</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span style="font-size: 1.5rem;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= BASEURL ?>peminjaman/tambahPeminjaman" method="post">
                            <input type="hidden" name="id_peminjaman" id="id_peminjaman">
                            
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-5">
                                    <div class="form-group-custom">
                                        <label for="judul_kegiatan">Judul Kegiatan</label>
                                        <input type="text" 
                                               name="judul_kegiatan" 
                                               id="judul_kegiatan"
                                               class="form-control-custom"
                                               placeholder="Masukkan judul kegiatan"
                                               required>
                                    </div>
                                    
                                    <div class="form-group-custom">
                                        <label for="nama_peminjam">Nama Peminjam</label>
                                        <input type="text" 
                                               name="nama_peminjam" 
                                               id="nama_peminjam"
                                               class="form-control-custom"
                                               placeholder="Masukkan nama peminjam"
                                               required>
                                    </div>
                                    
                                    <div class="form-group-custom">
                                        <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                                        <input type="date" 
                                               name="tanggal_pengajuan" 
                                               id="tanggal_pengajuan"
                                               value="<?= date('Y-m-d'); ?>"
                                               readonly
                                               class="form-control-custom">
                                    </div>
                                    
                                    <div class="form-group-custom">
                                        <label for="tanggal_peminjaman">Mulai Dari Tanggal</label>
                                        <input type="date" 
                                               name="tanggal_peminjaman" 
                                               id="tanggal_peminjaman"
                                               class="form-control-custom"
                                               required>
                                    </div>
                                </div>
                                
                                <!-- Center Image -->
                                <div class="col-md-2 d-flex align-items-center justify-content-center">
                                    <img src="<?= BASEURL ?>img/happy robot assistant.svg" 
                                         alt="Assistant" 
                                         style="max-width: 140px; opacity: 0.8;">
                                </div>
                                
                                <!-- Right Column -->
                                <div class="col-md-5">
                                    <div class="form-group-custom">
                                        <label for="tanggal_pengembalian">Sampai Tanggal</label>
                                        <input type="date" 
                                               name="tanggal_pengembalian" 
                                               id="tanggal_pengembalian"
                                               class="form-control-custom"
                                               required>
                                    </div>
                                    
                                    <div class="form-group-custom">
                                        <label for="id_jenis_barang">Jenis Barang</label>
                                        <select name="id_jenis_barang" 
                                                id="id_jenis_barang"
                                                class="form-select-custom jenis_barang_select" 
                                                required>
                                            <option value="">-- Pilih Jenis Barang --</option>
                                            <?php foreach ($data['sub_barang'] as $option): ?>
                                                <option value="<?= $option['id_jenis_barang'] ?>">
                                                    <?= $option['sub_barang'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group-custom">
                                        <label for="status">Status</label>
                                        <select name="status" 
                                                id="status"
                                                class="form-select-custom status_select" 
                                                required>
                                            <option value="">-- Pilih Status --</option>
                                            <?php
                                            $status_options = ["diproses", "disetujui", "ditolak"];
                                            $selected_status = $data['status'] ?? '';
                                            foreach ($status_options as $status) {
                                                $selected = ($selected_status == $status) ? 'selected' : '';
                                                echo "<option value='$status' $selected>" . ucfirst($status) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <label for="jumlah_peminjaman">Jumlah</label>
                                                <input type="number" 
                                                       id="jumlah_peminjaman" 
                                                       name="jumlah_peminjaman"
                                                       class="form-control-custom jumlah_input"
                                                       min="1"
                                                       placeholder="0"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group-custom">
                                                <label for="keterangan_peminjaman">Keterangan</label>
                                                <input type="text" 
                                                       id="keterangan_peminjaman" 
                                                       name="keterangan_peminjaman"
                                                       class="form-control-custom keterangan_input"
                                                       placeholder="Keterangan peminjaman">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn-submit-custom">
                                    <i class="fa-solid fa-paper-plane mr-2"></i>
                                    Kirim Pengajuan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>