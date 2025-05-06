<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['files'])) {
        echo json_encode(["error" => "Form-data 'files' belum dikirim."]);
        exit;
    }

    $uploaded_files = $_FILES['files'];
    $upload_dir = __DIR__ . "/uploads/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
    $saved_paths = [];

    // Simpan file
    for ($i = 0; $i < count($uploaded_files['name']); $i++) {
        $filename = basename($uploaded_files['name'][$i]);
        $target_path = $upload_dir . $filename;
        if (move_uploaded_file($uploaded_files['tmp_name'][$i], $target_path)) {
            $saved_paths[] = "uploads/" . $filename;
        }
    }

    // Simpan input.json
    file_put_contents("input.json", json_encode($saved_paths, JSON_PRETTY_PRINT));

    // Jalankan python
 $python_path = "C:\\Users\\Administrator\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";
$command = escapeshellcmd("$python_path main.py input.json") . " 2>&1";
//$command = escapeshellcmd("python main.py input.json");
$output = shell_exec($command);
file_put_contents("debug.txt", $output);


    // Cek apakah output tercipta
    $hasil_file = "output/hasil_gabungan.pdf";
    if (file_exists($hasil_file)) {
        echo json_encode([
            "message" => "Berhasil digabung",
            "output_file" => $hasil_file,
            "url_download" => "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/$hasil_file"
        ]);
    } else {
        echo json_encode([
            "error" => "Gagal membuat file PDF.",
            "debug" => $output
        ]);
    }
}
?>
