<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Transaksi Peminjaman</h1>
        
        <?php
        // 1. Inisialisasi variabel statistik
        $total_transaksi = 0;
        $total_dipinjam = 0;
        $total_dikembalikan = 0;
        
        // 2. Loop pertama untuk hitung statistik
        // Logika continue dan break harus disertakan di sini agar statistik akurat
        for ($i = 1; $i <= 10; $i++) {
            // Stop di transaksi ke-8 dengan BREAK
            if ($i == 8) {
                break;
            }
            
            // Skip transaksi genap dengan CONTINUE
            if ($i % 2 == 0) {
                continue;
            }

            // Hitung status untuk data yang lolos filter
            $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";
            
            $total_transaksi++;
            if ($status == "Dipinjam") {
                $total_dipinjam++;
            } else {
                $total_dikembalikan++;
            }
        }
        ?>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Total Transaksi</h6>
                        <h2 class="mb-0"><?= $total_transaksi ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-dark shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Masih Dipinjam</h6>
                        <h2 class="mb-0"><?= $total_dipinjam ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Sudah Dikembalikan</h6>
                        <h2 class="mb-0"><?= $total_dikembalikan ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Lama Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Tanggal hari ini untuk patokan perhitungan "Hari sejak pinjam"
                        $tanggal_sekarang = time();

                        // 5. Loop untuk tampilkan data
                        for ($i = 1; $i <= 10; $i++) {
                            
                            // Stop di transaksi ke-8 dengan BREAK
                            if ($i == 8) {
                                break;
                            }
                            
                            // Skip transaksi genap dengan CONTINUE
                            if ($i % 2 == 0) {
                                continue;
                            }

                            // Generate data transaksi
                            $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                            $nama_peminjam = "Anggota " . $i;
                            $judul_buku = "Buku Teknologi Vol. " . $i;
                            
                            // Tanggal pinjam = hari ini dikurangi $i hari
                            $tanggal_pinjam = date('Y-m-d', strtotime("-$i days"));
                            // Tanggal kembali = 7 hari setelah tanggal pinjam
                            $tanggal_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam)));
                            
                            $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

                            // Hitung jumlah hari sejak pinjam
                            $timestamp_pinjam = strtotime($tanggal_pinjam);
                            $selisih_detik = $tanggal_sekarang - $timestamp_pinjam;
                            $hari_sejak_pinjam = floor($selisih_detik / (60 * 60 * 24)); // Konversi detik ke hari

                            // Tentukan warna badge berdasarkan status
                            $badge_color = ($status == "Dikembalikan") ? "bg-success" : "bg-warning text-dark";

                            // Tampilkan baris tabel
                            echo "<tr>";
                            echo "<td>{$i}</td>";
                            echo "<td><strong>{$id_transaksi}</strong></td>";
                            echo "<td>{$nama_peminjam}</td>";
                            echo "<td>{$judul_buku}</td>";
                            echo "<td>{$tanggal_pinjam}</td>";
                            echo "<td>{$tanggal_kembali}</td>";
                            echo "<td>{$hari_sejak_pinjam} hari</td>";
                            echo "<td><span class='badge {$badge_color}'>{$status}</span></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>