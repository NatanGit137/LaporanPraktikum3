<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .form-label {
            font-weight: bold;
        }

        #hasilPenilaian {
        display: none;
        animation: fadeIn 0.6s ease-in-out;
        }

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
    <div class="container mt-4 mb-5 px-5">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1 class="h4 mb-0">Form Penilaian Mahasiswa</h1>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Masukkan Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Agus">
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">Masukkan NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="202332xxx">
                    </div>
                    <div class="mb-3">
                        <label for="kehadiran" class="form-label">Nilai Kehadiran (10%)</label>
                        <input type="number" class="form-control" id="kehadiran" name="kehadiran" placeholder="Untuk Lulus minimal 70%" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="tugas" class="form-label">Nilai Tugas (20%)</label>
                        <input type="number" class="form-control" id="tugas" name="tugas" placeholder="0 - 100" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="uts" class="form-label">Nilai UTS (30%)</label>
                        <input type="number" class="form-control" id="uts" name="uts" placeholder="0 - 100" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="uas" class="form-label">Nilai UAS (40%)</label>
                        <input type="number" class="form-control" id="uas" name="uas" placeholder="0 - 100" min="0" max="100">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="proses" class="btn btn-primary">Proses</button>
                    </div>
                </form>

                <?php
                 include "conn/conect.php";

                 $nama = $_POST['nama']; 
                 $nim = $_POST['nim']; 
                 $kehadiran = $_POST['kehadiran']; 
                 $tugas = $_POST['tugas']; 
                 $uts = $_POST['uts']; 
                 $uas = $_POST['uas']; 
                 $grade = "";

                 $total = $kehadiran * 0.1 + $tugas * 0.2 + $uts * 0.3 +  $uas * 0.4;
                
                 if($total >= 85){
                    $grade = "A";
                 }else if($total >= 70 && $total < 85){
                    $grade = "B";
                 }else if($total >= 55 && $total < 70){
                    $grade = "C";
                 }else if($total >= 40 && $total < 55){
                    $grade = "D";
                 }else if($total < 40){
                    $grade = "E";
                 }

                 if($grade == "A" || $grade == "B" || $grade == "C"){
                    $status = "LULUS...";
                 }else if($grade == "D" || $grade == "E"){
                    $status = "TIDAK LULUS";
                 }

                 $query = "INSERT INTO idnilai (nama, nim, kehadiran, tugas, uts, uas, grade, status) VALUES ('$nama', '$nim', '$kehadiran', '$tugas', '$uts', '$uas', '$grade', '$status')";


                 if(mysqli_query($conn, $query)){
                    $sukses = true;
                 }else{
                    $sukses = false;
                 }
                ?>

                <div id="hasilPenilaian" class="card mt-4 border-success">
                <div class="card-header bg-success text-white fw-bold">
                    Hasil Penilaian
                </div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col"><strong>Nama:</strong> <span id="outNama"></span></div>
                        <div class="col text-end"><strong>NIM:</strong> <span id="outNim"></span></div>
                </div>

                <p>Nilai Kehadiran: <span id="outKehadiran"></span>%</p>
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
        <script>
            <?php if(isset($sukses) && $sukses == true){ ?>
                document.getElementById("hasilPenilaian").style.display = "block";

                document.getElementById("outNama").innerText = "<?= $nama ?>";
                document.getElementById("outNim").innerText = "<?= $nim ?>";
                document.getElementById("outKehadiran").innerText = "<?= $kehadiran ?>";
                document.getElementById("outTugas").innerText = "<?= $tugas ?>";
                document.getElementById("outUTS").innerText = "<?= $uts ?>";
                document.getElementById("outUAS").innerText = "<?= $uas ?>";
                document.getElementById("outTotal").innerText = "<?= number_format($total,2) ?>";
                document.getElementById("outGrade").innerText = "<?= $grade ?>";
                document.getElementById("outStatus").innerText = "<?= $status ?>";
            <?php } ?>
        </script>
</body>
</html>