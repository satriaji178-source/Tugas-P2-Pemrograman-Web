<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <?php
    require_once 'functions_anggota_tugas.php';

    $anggota_list = [
        ["id" => "AGT-001", "nama" => "Budi Santoso", "email" => "budi@email.com", "telepon" => "0812345", "alamat" => "Jakarta", "tanggal_daftar" => "2024-01-15", "status" => "Aktif", "total_pinjaman" => 5],
        ["id" => "AGT-002", "nama" => "Siti Aminah", "email" => "siti@email.com", "telepon" => "0812999", "alamat" => "Bandung", "tanggal_daftar" => "2024-02-10", "status" => "Non-Aktif", "total_pinjaman" => 2],
        ["id" => "AGT-003", "nama" => "Andi Wijaya", "email" => "andi@email.com", "telepon" => "0857112", "alamat" => "Surabaya", "tanggal_daftar" => "2024-02-20", "status" => "Aktif", "total_pinjaman" => 12],
        ["id" => "AGT-004", "nama" => "Dewi Lestari", "email" => "dewi@email.com", "telepon" => "0813445", "alamat" => "Jogja", "tanggal_daftar" => "2024-03-05", "status" => "Aktif", "total_pinjaman" => 8],
        ["id" => "AGT-005", "nama" => "Eko Prasetyo", "email" => "eko@email.com", "telepon" => "0898776", "alamat" => "Medan", "tanggal_daftar" => "2024-03-12", "status" => "Non-Aktif", "total_pinjaman" => 0],
    ];

    // Logika Bonus: Search & Sort
    $keyword = $_GET['search'] ?? '';
    $data_tampil = search_anggota_by_nama($anggota_list, $keyword);
    sort_anggota_by_nama($data_tampil);

    // Statistik
    $teraktif = cari_anggota_teraktif($anggota_list);
    $total = hitung_total_anggota($anggota_list);
    $aktif_count = hitung_anggota_aktif($anggota_list);
    ?>

    <div class="container mt-5 pb-5">
        <h1 class="mb-4"><i class="bi bi-book-half text-primary"></i> Sistem Perpustakaan</h1>

        <div class="row mb-4 g-3">
            <div class="col-md-3">
                <div class="card bg-primary text-white border-0 shadow-sm">
                    <div class="card-body">
                        <h6>Total Anggota</h6>
                        <h2 class="mb-0"><?= $total ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white border-0 shadow-sm">
                    <div class="card-body">
                        <h6>Anggota Aktif</h6>
                        <h2 class="mb-0"><?= $aktif_count ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white border-0 shadow-sm">
                    <div class="card-body">
                        <h6>Rata-rata Pinjam</h6>
                        <h2 class="mb-0"><?= number_format(hitung_rata_rata_pinjaman($anggota_list), 1) ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark border-0 shadow-sm">
                    <div class="card-body">
                        <h6>% Aktif</h6>
                        <h2 class="mb-0"><?= ($aktif_count/$total)*100 ?>%</h2>
                    </div>
                </div>
            </div>
        </div>

        <form class="row g-2 mb-4" method="GET">
            <div class="col-auto">
                <input type="text" name="search" class="form-control" placeholder="Cari nama..." value="<?= htmlspecialchars($keyword) ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                <a href="sistem_anggota_tugas.php" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Anggota (A-Z)</h5>
                <span class="badge bg-light text-primary"><?= count($data_tampil) ?> Data</span>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Tgl Daftar</th>
                            <th>Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_tampil as $row): ?>
                        <tr>
                            <td><strong><?= $row['nama'] ?></strong></td>
                            <td><?= $row['email'] ?></td>
                            <td><span class="badge <?= $row['status']=='Aktif'?'bg-success':'bg-danger' ?>"><?= $row['status'] ?></span></td>
                            <td><?= format_tanggal_indo($row['tanggal_daftar']) ?></td>
                            <td><?= $row['total_pinjaman'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-header bg-success text-white"><h5><i class="bi bi-trophy"></i> Teraktif</h5></div>
                    <div class="card-body text-center">
                        <h3 class="text-success"><?= $teraktif['nama'] ?></h3>
                        <p class="text-muted">Dengan total <?= $teraktif['total_pinjaman'] ?> pinjaman buku.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="list-group shadow-sm">
                    <div class="list-group-item active bg-dark border-dark">Anggota Non-Aktif</div>
                    <?php foreach(filter_by_status($anggota_list, 'Non-Aktif') as $na): ?>
                        <div class="list-group-item small"><?= $na['nama'] ?> (<?= $na['id'] ?>)</div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="list-group shadow-sm">
                    <div class="list-group-item active">Anggota Aktif</div>
                    <?php foreach(filter_by_status($anggota_list, 'Aktif') as $a): ?>
                        <div class="list-group-item small"><?= $a['nama'] ?> (<?= $a['id'] ?>)</div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>