<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan - Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Sistem Peminjaman Perpustakaan</h4>
                </div>
                
                <div class="card-body p-4">
                    <?php
                    // 1. Data Anggota
                    $nama_anggota = "Budi Santoso";
                    $total_pinjaman = 2;
                    $buku_terlambat = 1;
                    $hari_keterlambatan = 5;

                    // 2. Business Logic menggunakan SWITCH untuk Level Member
                    $level_member = "";
                    $badge_color = ""; // Tambahan untuk warna badge Bootstrap
                    
                    switch (true) {
                        case ($total_pinjaman >= 0 && $total_pinjaman <= 5):
                            $level_member = "Bronze";
                            $badge_color = "bg-secondary";
                            break;
                        case ($total_pinjaman >= 6 && $total_pinjaman <= 15):
                            $level_member = "Silver";
                            $badge_color = "bg-info text-dark";
                            break;
                        case ($total_pinjaman > 15):
                            $level_member = "Gold";
                            $badge_color = "bg-warning text-dark";
                            break;
                        default:
                            $level_member = "Tidak Diketahui";
                            $badge_color = "bg-dark";
                            break;
                    }

                    // 3. Business Logic menggunakan IF-ELSEIF-ELSE untuk Status Pinjam
                    $status_pinjam = "";
                    if ($buku_terlambat > 0) {
                        $status_pinjam = "<span class='text-danger fw-bold'>Ditolak (Ada buku terlambat)</span>";
                    } elseif ($total_pinjaman >= 3) {
                        $status_pinjam = "<span class='text-danger fw-bold'>Ditolak (Batas maksimal 3 buku)</span>";
                    } else {
                        $status_pinjam = "<span class='text-success fw-bold'>Diizinkan</span>";
                    }

                    // 4. Hitung Denda
                    $total_denda = 0;
                    if ($buku_terlambat > 0) {
                        $total_denda = 1000 * $hari_keterlambatan * $buku_terlambat;
                        if ($total_denda > 50000) {
                            $total_denda = 50000;
                        }
                    }
                    ?>

                    <h5 class="card-title text-muted mb-3">Informasi Anggota</h5>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <strong>Nama Anggota</strong>
                            <span><?php echo $nama_anggota; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <strong>Level Member</strong>
                            <span class="badge <?php echo $badge_color; ?> rounded-pill px-3 py-2">
                                <?php echo $level_member; ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <strong>Buku Dipinjam Saat Ini</strong>
                            <span><?php echo $total_pinjaman; ?> Buku</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <strong>Status Peminjaman Baru</strong>
                            <span><?php echo $status_pinjam; ?></span>
                        </li>
                    </ul>

                    <h5 class="card-title text-muted mb-3">Status Keterlambatan</h5>
                    
                    <?php if ($buku_terlambat > 0): ?>
                        <div class="alert alert-danger mb-0" role="alert">
                            <h6 class="alert-heading fw-bold">⚠️ Peringatan Keterlambatan!</h6>
                            <p class="mb-1">Anda memiliki <strong><?php echo $buku_terlambat; ?></strong> buku yang terlambat selama <strong><?php echo $hari_keterlambatan; ?></strong> hari.</p>
                            <hr>
                            <p class="mb-0"><strong>Total Denda:</strong> Rp <?php echo number_format($total_denda, 0, ',', '.'); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-success mb-0" role="alert">
                            <span class="fw-bold">✅ Aman!</span> Tidak ada catatan keterlambatan buku.
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>