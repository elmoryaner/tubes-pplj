import socket
import json
import random
import re
import datetime

def generate_random_ticket_number():
  random_ticket_number = ''
  for _ in range(8):
    random_char = chr(random.randint(65, 90)) if random.random() < 0.5 else str(random.randint(0, 9))
    random_ticket_number += random_char
  return random_ticket_number

def validate_plat_number(nomor_plat):
  valid_format = re.compile(r"^[A-Z]{1}-\d{1,4}-[A-Z]{1,2}$")
  return valid_format.match(nomor_plat) is not None

def get_parking_data():
  nomor_tiket = generate_random_ticket_number()
  nomor_plat = input("Masukkan Nomor Plat Kendaraan (format A-1-XY atau AB-1999-XYY): ")

  while not validate_plat_number(nomor_plat):
    print("Format plat kendaraan tidak valid. Silakan masukkan kembali.")
    nomor_plat = input("Masukkan Nomor Plat Kendaraan (format A-1-XY atau AB-1999-XYY): ")

  waktu_masuk = datetime.datetime.now().strftime("%H:%M")
  jenis_kendaraan = input("Masukkan Jenis Kendaraan: ")

  data = {
    "nomor_tiket": nomor_tiket,
    "nomor_plat": nomor_plat,
    "waktu_masuk": waktu_masuk,
    "jenis_kendaraan": jenis_kendaraan
  }

  return data

def main():
  client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

  host = '127.0.0.1'
  port = 8080
  client_socket.connect((host, port))

  parking_data = get_parking_data()
  message = json.dumps(parking_data)
  client_socket.send(message.encode('utf-8'))

  data = client_socket.recv(1024).decode('utf-8')
  print("Received from server:", data)

  client_socket.close()

if __name__ == "__main__":
  main()
