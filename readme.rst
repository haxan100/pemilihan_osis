
Pemilihan Calon Osis Dengan Web
bisa juga untuk pemilihan / votting lain misal RT/ RW, ketua kelas , dll.
dari 0 banget ini
menggunakan :
php framework Codeigniter
-Datatable serverside
-Ajax Jquery
-Admin LTE
-Sweetalert
Fitur:
-responsive,
- countimer
- quickcount
- pie cart
role: Super Admin ,  Admin  , Calon Ketua(bisa untuk calon voting lain), dan user (pemilih)

#Admin :
- crud Admin
- crud calon,
- crud user
- setting waktu untuk pemilihan di mulai dan berakhirnya waktu pemilihan
- import user(nis siswa bisa di ganti dengan ktp atau nomor unik lain), 
	ketika gagal import , maka akan di rollback
-cron pemilih ( untuk menghitung atau menghentikan pemilihan)
- export User


#Admin :
- crud calon,
- crud user
- setting waktu untuk pemilihan di mulai dan berakhirnya waktu pemilihan
- import user(nis siswa bisa di ganti dengan ktp atau nomor unik lain), ketika gagal import , maka akan di rollback
-cron pemilih ( untuk menghitung atau menghentikan pemilihan)
- export User

#Calon :
-melihat siapa saja yang memilih calon
-lihat quick count

#User:
- bisa melakukan votting sekali saja
- lihat quickcount
- ketika user memilih sebelum tanggal di tetapkan untuk memilih , maka akan warning
- ketika user memilih setelah tanggal di tetapkan untuk memilih/ lewat dari tanggal , maka akan warning
- Edit Profil , (tidak bisa edit  NISN, Hanya Admin yang dapat meng-edit NISN)
