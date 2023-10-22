###################
SITU BILLMANPLNT MNK
###################



********************************************
Progress Aplikasi Version 1.0 Build 23102023 
********************************************

1. Dashboard progres 
2. Hasil import tusbung
2. Pilih Bulan dan Tahun sebelum login
2. Import tanggal lunas excel ke database (ini yang lama)

Untuk lebih jelasnya dapat dilihat dalam link berikut:
[Billman Project](https://docs.google.com/spreadsheets/d/1awP3t7B6ldCpr9AHQaoaL8rsntCMXIMi/edit?rtpof=true&sd=true#gid=534714750)


**********************************
Proses import tusbung dalam sistem
**********************************

Pelanggan input dulu Lalu Tusbung

Jika hanya pelanggan yg duplikat, Berarti masih dapat input tusbung

Jika pelanggan dan tusbung yang duplikat (ada user iseng input id pelanggan, bulan, dan tahun yg sudah ada) maka error 

Jumlah error duplikat dibatasi sampai 100 saja (untuk mengurangi beban server)
lebih dari itu akan di stop

100 data duplikat akan ditampilkan agar dapat dicek 

Dalam melakukan import pelanggan biasanya:

Jika pelanggan bertambah, maka dapat dicek dari jumlah data baru dan data duplikat

Jika pelanggan berkurang, maka dapat dicek dari histori tusbung pelanggan per bulan dan tahun (belum dibuat)

Tanggal harus memiliki tanda single quote ( ' ) di awal tanggal, 
jika tidak ada, maka hasilnya akan terbalik antara bulan dan tanggal

Format import ada pada folder import atau pada link di halaman import tusbung

***************
Update Database
***************

1. no_hp menjadi varchar
2. sudah diisi data tusbung dan pelanggan untuk semua unit pada bulan september 2023 (disesuaikan data di excel) 

*************
Saran Testing
*************

Import data tusbung pada bulan-bulan dan tahun sebelumnya

Cek data pada dashboard apakah valid sesuai dashboard di excel atau tidak