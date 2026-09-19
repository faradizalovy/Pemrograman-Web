<?php
require __DIR__ . '/../includes/koneksi.php';
$fileJson = __DIR__ . '/../../jobsheet-06/data/buku.json';

        if (!file_exists($fileJson)) {
            die("File buku.json tidak ditemukan.");
        }

        $json = file_get_contents($fileJson);
        $dataBuku = json_decode($json, true);

        if (!is_array($dataBuku)) {
            die("Data JSON tidak valid.");
        }

        $stmt = $pdo->prepare(
            "INSERT INTO buku (judul, pengarang, tahun, stok)
            VALUES (:judul, :pengarang, :tahun, :stok)"
        );

        $jumlahBerhasil = 0;

        foreach ($dataBuku as $buku) {
            $stmt->execute([
                'judul' => $buku['judul'],
                'pengarang' => $buku['pengarang'],
                'tahun' => (int) $buku['tahun'],
                'stok' => (int) $buku['stok'],
            ]);

            $jumlahBerhasil++;
        }

        echo "Migrasi selesai. ";
        echo $jumlahBerhasil . " data buku berhasil dimasukkan.";