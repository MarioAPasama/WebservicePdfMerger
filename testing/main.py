from PyPDF2 import PdfMerger
from PIL import Image
import os

# Ubah sesuai lokasi file
image_files = ['gambar1.jpg', 'gambar2.jpg']  # Gambar yang ingin digabung
pdf_files = ['file1.pdf', 'file2.pdf']        # PDF yang ingin digabung

# Konversi gambar menjadi PDF sementara
converted_images = []
for img_file in image_files:
    image = Image.open(img_file).convert('RGB')
    temp_pdf = f"{os.path.splitext(img_file)[0]}.temp.pdf"
    image.save(temp_pdf)
    converted_images.append(temp_pdf)

# Gabungkan semua PDF
merger = PdfMerger()
for pdf in pdf_files + converted_images:
    merger.append(pdf)

# Simpan sebagai file PDF akhir
merger.write("hasil_gabungan.pdf")
merger.close()

# (Opsional) Hapus file PDF sementara dari gambar
for temp_pdf in converted_images:
    os.remove(temp_pdf)
