import socket
import json
import random
import re
import tkinter as tk
from tkinter import messagebox

def generate_random_ticket_number():
    random_ticket_number = ''
    for _ in range(8):
        random_char = chr(random.randint(65, 90)) if random.random() < 0.5 else str(random.randint(0, 9))
        random_ticket_number += random_char
    return random_ticket_number

def validate_plat_number(nomor_plat):
    valid_format = re.compile(r"^[A-Z]{1}-\d{1,4}-[A-Z]{1,2}$")
    return valid_format.match(nomor_plat) is not None

def get_parking_data(nomor_plat, jenis_kendaraan):
    nomor_tiket = generate_random_ticket_number()

    data = {
        "action": 'in',
        "data": {
            "ticketNumber": nomor_tiket,
            "nomor_plat": nomor_plat,
            "jenis_kendaraan": jenis_kendaraan
        }
    }

    return data

def get_out_data(nomor_tiket_digital, nomor_plat):
    data = {
        "action": 'out',
        "data": {
            "digitalTicket": nomor_tiket_digital,
            "nomor_plat": nomor_plat
        }
    }

    return data

def submit_data():
    nomor_plat = plat_entry.get()
    jenis_kendaraan = kendaraan_entry.get()

    if not validate_plat_number(nomor_plat):
        messagebox.showerror("Error", "Format plat kendaraan tidak valid. Silakan masukkan kembali.")
        return

    parking_data = get_parking_data(nomor_plat, jenis_kendaraan)

    try:
        client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        host = '127.0.0.1'
        port = 8080
        client_socket.connect((host, port))

        message = json.dumps(parking_data)
        client_socket.send(message.encode('utf-8'))

        data = client_socket.recv(1024).decode('utf-8')
        messagebox.showinfo("Server Response", f"Received from server: {data}")

        client_socket.close()
    except Exception as e:
        messagebox.showerror("Error", f"Failed to connect to server: {e}")

def submit_out_data():
    nomor_tiket_digital = ticket_entry.get()
    nomor_plat = plat_entry_out.get()

    if not nomor_tiket_digital or not nomor_plat:
        messagebox.showerror("Error", "Nomor tiket dan plat tidak boleh kosong.")
        return

    parking_data = get_out_data(nomor_tiket_digital, nomor_plat)

    try:
        client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        host = '127.0.0.1'
        port = 8080
        client_socket.connect((host, port))

        message = json.dumps(parking_data)
        client_socket.send(message.encode('utf-8'))

        data = client_socket.recv(1024).decode('utf-8')
        messagebox.showinfo("Server Response", f"Received from server: {data}")

        client_socket.close()
    except Exception as e:
        messagebox.showerror("Error", f"Failed to connect to server: {e}")

def show_in_menu():
    for widget in root.winfo_children():
        widget.pack_forget()

    tk.Label(root, text="Masukkan Nomor Plat Kendaraan (format A-1-XY atau AB-1999-XYY):").pack()
    global plat_entry
    plat_entry = tk.Entry(root)
    plat_entry.pack()

    tk.Label(root, text="Masukkan Jenis Kendaraan:").pack()
    global kendaraan_entry
    kendaraan_entry = tk.Entry(root)
    kendaraan_entry.pack()

    submit_button = tk.Button(root, text="Submit", command=submit_data)
    submit_button.pack()

def show_out_menu():
    for widget in root.winfo_children():
        widget.pack_forget()

    tk.Label(root, text="Masukkan tiket digital:").pack()
    global ticket_entry
    ticket_entry = tk.Entry(root)
    ticket_entry.pack()

    tk.Label(root, text="Masukkan Nomor Plat Kendaraan:").pack()
    global plat_entry_out
    plat_entry_out = tk.Entry(root)
    plat_entry_out.pack()

    submit_out_button = tk.Button(root, text="Submit", command=submit_out_data)
    submit_out_button.pack()

# Set up Tkinter window
root = tk.Tk()
root.title("Parking Management System")

tk.Label(root, text="Select an option:").pack()

in_button = tk.Button(root, text="In", command=show_in_menu)
in_button.pack()

out_button = tk.Button(root, text="Out", command=show_out_menu)
out_button.pack()

root.mainloop()
