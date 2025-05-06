<?php
// webservice.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $files = $_POST['files']; // Misalnya: ["uploads/image1.jpg", "uploads/file1.pdf"]
    $jsonInput = json_encode($files);

    // Simpan input ke file sementara (bisa juga kirim via argumen)
    file_put_contents('input.json', $jsonInput);

    // Jalankan Python
    $command = escapeshellcmd("python main.py input.json");
    $output = shell_exec($command);

    echo $output;
}
