<?php
// Fungsi Dasar
function hitung_total_anggota($list) { return count($list); }

function hitung_anggota_aktif($list) {
    return count(array_filter($list, fn($agt) => $agt['status'] === "Aktif"));
}

function hitung_rata_rata_pinjaman($list) {
    if (empty($list)) return 0;
    return array_sum(array_column($list, 'total_pinjaman')) / count($list);
}

function cari_anggota_teraktif($list) {
    if (empty($list)) return null;
    usort($list, fn($a, $b) => $b['total_pinjaman'] <=> $a['total_pinjaman']);
    return $list[0];
}

function filter_by_status($list, $status) {
    return array_filter($list, fn($agt) => $agt['status'] === $status);
}

function format_tanggal_indo($tanggal) {
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}

// --- BONUS FUNCTIONS ---

// Bonus: Sort by Nama (A-Z)
function sort_anggota_by_nama(&$list) {
    usort($list, fn($a, $b) => strcmp($a['nama'], $b['nama']));
}

// Bonus: Search by Nama (Partial Match)
function search_anggota_by_nama($list, $keyword) {
    if (empty($keyword)) return $list;
    return array_filter($list, function($agt) use ($keyword) {
        return str_contains(strtolower($agt['nama']), strtolower($keyword));
    });
}
?>