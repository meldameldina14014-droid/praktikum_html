!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu Digital STITEK Bontang</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 30px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 30px;
        }
        header h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 22px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #444;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }
        textarea {
            resize: vertical;
            min-height: 90px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #2c7be5;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #1a5fc4;
        }
        .alert {
            margin-top: 20px;
            padding: 12px 15px;
            border-radius: 6px;
            font-size: 14px;
        }
        .alert-error {
            background-color: #fdecea;
            color: #b71c1c;
            border: 1px solid #f5c2c0;
        }
        .alert-success {
            background-color: #e8f5e9;
            color: #1b5e20;
            border: 1px solid #b7dfb9;
        }
        .hasil {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9fafb;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }
        .hasil p {
            margin: 6px 0;
        }
        .hasil span {
            font-weight: 600;
            color: #2c3e50;
        }
    </style>
</head>
<body>
<div class="container">

    <header>
        <h1>Buku Tamu Digital STITEK Bontang</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>">

        <label for="email">Alamat Email</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

        <label for="pesan">Pesan/Komentar</label>
        <textarea id="pesan" name="pesan"><?php echo isset($_POST['pesan']) ? htmlspecialchars($_POST['pesan']) : ''; ?></textarea>

        <button type="submit" name="submit">Kirim Pesan</button>
    </form>

    <?php
    // Proses form hanya dijalankan jika tombol submit ditekan
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

        // Ambil data mentah dari form
        $nama  = trim($_POST['nama']);
        $email = trim($_POST['email']);
        $pesan = trim($_POST['pesan']);

        $errors = [];

        // Validasi: pastikan tidak ada kolom yang kosong
        if (empty($nama)) {
            $errors[] = "Nama Lengkap tidak boleh kosong.";
        }
        if (empty($email)) {
            $errors[] = "Alamat Email tidak boleh kosong.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format Alamat Email tidak valid.";
        }
        if (empty($pesan)) {
            $errors[] = "Pesan/Komentar tidak boleh kosong.";
        }

        if (count($errors) > 0) {
            // Tampilkan semua pesan kesalahan
            echo '<div class="alert alert-error"><strong>Terjadi kesalahan:</strong><ul>';
            foreach ($errors as $error) {
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul></div>';
        } else {
            // Bersihkan input sebelum ditampilkan untuk mencegah XSS
            $nama_bersih  = htmlspecialchars($nama);
            $email_bersih = htmlspecialchars($email);
            $pesan_bersih = htmlspecialchars($pesan);

            echo '<div class="alert alert-success">Pesan Anda berhasil dikirim. Terima kasih!</div>';

            echo '<div class="hasil">';
            echo '<p><span>Nama:</span> ' . $nama_bersih . '</p>';
            echo '<p><span>Email:</span> ' . $email_bersih . '</p>';
            echo '<p><span>Pesan:</span> ' . nl2br($pesan_bersih) . '</p>';
            echo '</div>';
        }
    }
    ?>

</div>
</body>
</html>
