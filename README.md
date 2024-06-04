# Tugas Besar PPLJ - Digital Parking System

Alur Kerja Sistem

Proses register dan login untuk user dan loket
Enter username dan password
Jika berhasil, akun dapat diakses. Bisa reset credentials

## Proses Pembayaran
1. Scan Barcode/QR untuk melakukan pembayaran (GET)
2. Server mengirim informasi parkir (time, place(fixed), harga, jenis kendaraan), client menerima data dan memilih metode pembayaran
3. GET metode pembayaran yang disupport dari server
4. Client memutuskan untuk bayar sekarang atau tidak. Jika ya, POST ingin bayar. Jika tidak, exit
5. Jika dana cukup, lanjut. Jika tidak, ulang state dan ubah metode pembayaran. Asumsi saldo langsung terpotong
6. Digital ticket berhasil dicetak. Kadaluarsa 30 menit. Semua loket PUBLISH ke server 
7. Jika lewat 30 menit, server POST ke client bahwa digital ticket kadaluwarsa. Saldo yang dipotong dikembalikan.

## Server (PHP + MySQL, Windows)
- Clock utama dari seluruh sistem
- Menyimpan waktu masuk dan keluar, fixed place, rate, jenis kendaraan
- Memiliki database
- Menerima credentials yang terenkripsi

## Client 1: User (HTTP, PHP)

## Client 2: Loket Parkir (Socket, Python)

## Network
- Komunikasi lewat Wi-Fi
- Network Addressing: IP address, port number
- Transport Layer: TCP
- Application Layer: HTTP, Socket

## Security
- Enkripsi dengan TLS
