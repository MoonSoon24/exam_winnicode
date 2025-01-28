
## About this Magang project

Dalam projek ini kita membuat antarmuka ujian TOEFL berbasis web yang dinamis dengan desain responsif menggunakan Bootstrap 5. Antarmuka ini memiliki navigation tab  di bagian atas untuk menampilkan branding, judul ujian, dan penghitung waktu yang menunjukkan sisa waktu ujian. Halaman ini dibagi menjadi dua bagian utama: area soal dan sidebar untuk navigasi antar soal. Area soal menampilkan soal saat ini beserta pilihan jawaban dalam format multiple choice, dengan fitur untuk menandai soal sebagai "flagged" (ditandai) atau "saved" (disimpan) untuk melacak kemajuan ujian. Di bagian bawah, terdapat bilah kemajuan yang secara visual menunjukkan persentase penyelesaian ujian. Sidebar dilengkapi dengan tombol berbentuk lingkaran yang merepresentasikan nomor soal, memungkinkan pengguna untuk langsung berpindah ke soal tertentu. Fungsionalitas interaktif seperti menyimpan jawaban, menandai soal, dan navigasi antar soal diatur menggunakan JavaScript. Selain itu, terdapat modal untuk konfirmasi penyelesaian ujian, sehingga pengguna tidak bisa menyelesaikan ujian secara tidak sengaja tanpa persetujuan. Tata letak halaman ditingkatkan dengan gaya kustom untuk status soal (misalnya, disimpan atau ditandai) dan transisi yang membuat pengalaman pengguna lebih nyaman. Kode ini juga mengintegrasikan pustaka eksternal seperti Bootstrap untuk gaya dan ikon, memastikan responsivitas serta komponen UI yang modern.



*use .env.example as .env
*use corresponding mysql database "toefl_exam.sql"
