<?php
// 1. Inisialisasi Data Array (Minimal 5 Data)
$anggota_list = [
    [
        "id" => "AGT-001",
        "nama" => "Budi Santoso",
        "email" => "budi@email.com",
        "telepon" => "081234567890",
        "alamat" => "Jakarta",
        "tanggal_daftar" => "2024-01-15",
        "status" => "Aktif",
        "total_pinjaman" => 5
    ],
    [
        "id" => "AGT-002",
        "nama" => "Siti Aminah",
        "email" => "siti@email.com",
        "telepon" => "081299988877",
        "alamat" => "Bandung",
        "tanggal_daftar" => "2024-02-10",
        "status" => "Non-Aktif",
        "total_pinjaman" => 2
    ],
    [
        "id" => "AGT-003",
        "nama" => "Andi Wijaya",
        "email" => "andi@email.com",
        "telepon" => "085711223344",
        "alamat" => "Surabaya",
        "tanggal_daftar" => "2024-02-20",
        "status" => "Aktif",
        "total_pinjaman" => 12
    ],
    [
        "id" => "AGT-004",
        "nama" => "Dewi Lestari",
        "email" => "dewi@email.com",
        "telepon" => "081344556677",
        "alamat" => "Yogyakarta",
        "tanggal_daftar" => "2024-03-05",
        "status" => "Aktif",
        "total_pinjaman" => 8
    ],
    [
        "id" => "AGT-005",
        "nama" => "Rizky Pratama",
        "email" => "rizky@email.com",
        "telepon" => "089877665544",
        "alamat" => "Medan",
        "tanggal_daftar" => "2024-03-12",
        "status" => "Non-Aktif",
        "total_pinjaman" => 0
    ],
];

// 2. Logika Perhitungan Statistik
$total_anggota = count($anggota_list);
$aktif = 0;
$non_aktif = 0;
$total_seluruh_pinjaman = 0;
$anggota_teraktif = $anggota_list[0];

foreach ($anggota_list as $agt) {
    // Hitung status
    if ($agt['status'] == "Aktif") {
        $aktif++;
    } else {
        $non_aktif++;
    }

    // Hitung rata-rata
    $total_seluruh_pinjaman += $agt['total_pinjaman'];

    // Cari anggota teraktif (pinjaman terbanyak)
    if ($agt['total_pinjaman'] > $anggota_teraktif['total_pinjaman']) {
        $anggota_teraktif = $agt;
    }
}

$persen_aktif = ($aktif / $total_anggota) * 100;
$persen_non_aktif = ($non_aktif / $total_anggota) * 100;
$rata_rata_pinjaman = $total_seluruh_pinjaman / $total_anggota;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Dashboard Statistik Anggota</h2>

    <div class="row mb-5 g-3">
        <div class="col-md-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Anggota</h5>
                    <p class="display-4 fw-bold"><?= $total_anggota ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Anggota Aktif</h5>
                    <p class="display-5 fw-bold"><?= $aktif ?> (<?= $persen_aktif ?>%)</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Anggota Non-Aktif</h5>
                    <p class="display-5 fw-bold"><?= $non_aktif ?> (<?= $persen_non_aktif ?>%)</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">Rata-rata Pinjaman</h5>
                    <p class="display-6"><?= number_format($rata_rata_pinjaman, 1) ?> Pinjaman/Orang</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-warning h-100">
                <div class="card-body">
                    <h5 class="card-title text-warning">Anggota Teraktif</h5>
                    <p class="h4"><?= $anggota_teraktif['nama'] ?></p>
                    <small class="text-muted">Total Pinjaman: <?= $anggota_teraktif['total_pinjaman'] ?></small>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Daftar Seluruh Anggota</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Total Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anggota_list as $agt): ?>
                        <tr>
                            <td><strong><?= $agt['id'] ?></strong></td>
                            <td><?= $agt['nama'] ?></td>
                            <td><?= $agt['email'] ?></td>
                            <td><?= $agt['alamat'] ?></td>
                            <td>
                                <span class="badge <?= $agt['status'] == 'Aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $agt['status'] ?>
                                </span>
                            </td>
                            <td class="text-center"><?= $agt['total_pinjaman'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>