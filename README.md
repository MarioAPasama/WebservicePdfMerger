# WebservicePdfMerger

Untuk menggabungkan file gambar dan file PDF menjadi satu file PDF dalam Python, kamu bisa menggunakan pustaka Pillow untuk membaca gambar dan PyPDF2 atau reportlab/fitz (PyMuPDF) untuk menyusun file PDF. Berikut contoh script sederhana yang menggunakan Pillow dan PyPDF2:


pip install pillow PyPDF2

Penjelasan:
Gambar dikonversi ke PDF dulu karena PyPDF2 hanya bisa menggabungkan file berformat PDF.
PdfMerger digunakan untuk menggabungkan semua file.
File PDF sementara bisa dihapus setelah proses selesai.