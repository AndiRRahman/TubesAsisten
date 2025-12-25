<?php
if (!isset($_SESSION['login'])) {
    header("Location: " . BASEURL . "Login");
    exit;
}
?>
<div class="content">
    <div class="container-fluid p-4">
        <h1 class="page-title">Validasi Peminjaman</h1>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card primary">
                <div class="stat-label">Total diterima</div>
                <div class="stat-value">120</div>
                <div class="stat-icon">
                    <i class="fas fa-check"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Total diproses</div>
                <div class="stat-value">150</div>
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Total ditolak</div>
                <div class="stat-value">10</div>
                <div class="stat-icon">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Total Pengembalian</div>
                <div class="stat-value">10</div>
                <div class="stat-icon">
                    <i class="far fa-calendar-check"></i>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul kegiatan</th>
                            <th>Tgl pengajuan</th>
                            <th>Tgl mulai peminjaman</th>
                            <th>Tgl akhir peminjaman</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn-detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn-detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn-detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn-detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>