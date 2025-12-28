<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Pengaturan karakter dan tampilan responsif -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Judul halaman -->
    <title>Penilaian Mahasiswa</title>

    <!-- Menghubungkan Bootstrap CSS untuk tampilan yang rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Menghubungkan Bootstrap JS untuk komponen interaktif -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Warna latar belakang halaman */
        body {
            background-color: #f8f9fa;
        }

        /* Warna header card */
        .card-header {
            background-color: #007bff;
            color: white;
        }

        /* Hasil penilaian disembunyikan di awal */
        #hasilPenilaian {
            display: none;
            animation: fadeIn 0.6s ease-in-out;
        }

        /* Animasi saat hasil penilaian muncul */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Container utama -->
    <div class="container mt-4 mb-5 px-5">
        <div class="card shadow-sm">

            <!-- Header form -->
            <div class="card-header text-center">
                <h1 class="h4 mb-0">Form Penilaian Mahasiswa</h1>
            </div>

            <div class="card-body">

                <!-- Form input data mahasiswa -->
                <form method="post">

                    <!-- Input nama mahasiswa -->
                    <div class="mb-3">
                        <label class="form-label">Masukkan Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Agus">
                    </div>

                    <!-- Input NIM mahasiswa -->
                    <div class="mb-3">
                        <label class="form-label">Masukkan NIM</label>
                        <input type="text" class="form-control" name="nim" placeholder="202332xxx">
                    </div>

                    <!-- Input nilai kehadiran -->
                    <div class="mb-3">
                        <label class="form-label">Nilai Kehadiran (10%)</label>
                        <input type="number" class="form-control" name="kehadiran" min="0" max="100">
                    </div>

                    <!-- Input nilai tugas -->
                    <div class="mb-3">
                        <label class="form-label">Nilai Tugas (20%)</label>
                        <input type="number" class="form-control" name="tugas" min="0" max="100">
                    </div>

                    <!-- Input nilai UTS -->
                    <div class="mb-3">
                        <label class="form-label">Nilai UTS (30%)</label>
                        <input type="number" class="form-control" name="uts" min="0" max="100">
                    </div>

                    <!-- Input nilai UAS -->
                    <div class="mb-3">
                        <label class="form-label">Nilai UAS (40%)</label>
                        <input type="number" class="form-control" name="uas" min="0" max="100">
                    </div>

                    <!-- Tombol proses -->
                    <div class="d-grid gap-2">
                        <button type="submit" name="proses" class="btn btn-primary">
                            Proses
                        </button>
                    </div>
                </form>

                <?php
                // Menghubungkan ke database
                include "conn/conect.php";

                // Mengambil data yang dikirim dari form
                $nama = $_POST['nama'];
                $nim = $_POST['nim'];
                $kehadiran = $_POST['kehadiran'];
                $tugas = $_POST['tugas'];
                $uts = $_POST['uts'];
                $uas = $_POST['uas'];

                // Menghitung nilai akhir berdasarkan bobot
                $total = ($kehadiran * 0.1) +
                         ($tugas * 0.2) +
                         ($uts * 0.3) +
                         ($uas * 0.4);

                // Menentukan grade berdasarkan nilai akhir
                if ($total >= 85) {
                    $grade = "A";
                } elseif ($total >= 70) {
                    $grade = "B";
                } elseif ($total >= 55) {
                    $grade = "C";
                } elseif ($total >= 40) {
                    $grade = "D";
                } else {
                    $grade = "E";
                }

                // Menentukan status kelulusan
                if ($grade == "A" || $grade == "B" || $grade == "C") {
                    $status = "LULUS";
                } else {
                    $status = "TIDAK LULUS";
                }

                // Query untuk menyimpan data ke database
                $query = "INSERT INTO idnilai 
                          (nama, nim, kehadiran, tugas, uts, uas, grade, status)
                          VALUES 
                          ('$nama','$nim','$kehadiran','$tugas','$uts','$uas','$grade','$status')";

                // Mengecek apakah data berhasil disimpan
                if (mysqli_query($conn, $query)) {
                    $sukses = true;
                }
                ?>

                <!-- Tampilan hasil penilaian -->
                <div id="hasilPenilaian" class="card mt-4 border-success">
                    <div class="card-header bg-success text-white">
                        Hasil Penilaian
                    </div>

                    <div class="card-body">
                        <p><strong>Nama:</strong> <span id="outNama"></span></p>
                        <p><strong>NIM:</strong> <span id="outNim"></span></p>
                        <p>Nilai Kehadiran: <span id="outKehadiran"></span></p>
                        <p>Nilai Tugas: <span id="outTugas"></span></p>
                        <p>Nilai UTS: <span id="outUTS"></span></p>
                        <p>Nilai UAS: <span id="outUAS"></span></p>
                        <p><strong>Nilai Akhir:</strong> <span id="outTotal"></span></p>
                        <p><strong>Grade:</strong> <span id="outGrade"></span></p>
                        <p><strong>Status:</strong> <span id="outStatus"></span></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Script untuk menampilkan hasil jika data berhasil diproses -->
    <script>
        <?php if (isset($sukses)) { ?>
            document.getElementById("hasilPenilaian").style.display = "block";
            document.getElementById("outNama").innerText = "<?= $nama ?>";
            document.getElementById("outNim").innerText = "<?= $nim ?>";
            document.getElementById("outKehadiran").innerText = "<?= $kehadiran ?>";
            document.getElementById("outTugas").innerText = "<?= $tugas ?>";
            document.getElementById("outUTS").innerText = "<?= $uts ?>";
            document.getElementById("outUAS").innerText = "<?= $uas ?>";
            document.getElementById("outTotal").innerText = "<?= number_format($total, 2) ?>";
            document.getElementById("outGrade").innerText = "<?= $grade ?>";
            document.getElementById("outStatus").innerText = "<?= $status ?>";
        <?php } ?>
    </script>

</body>
</html>
