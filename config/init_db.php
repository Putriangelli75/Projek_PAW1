<?php

$db = new PDO("sqlite:../database/splj.db");

$db->exec("

CREATE TABLE IF NOT EXISTS users (

    id_user INTEGER PRIMARY KEY AUTOINCREMENT,

    nama TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    no_hp TEXT,

    password TEXT NOT NULL,

    role TEXT DEFAULT 'pelanggan',

    membership TEXT DEFAULT 'regular',

    poin INTEGER DEFAULT 0,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE IF NOT EXISTS lapangan (

    id_lapangan INTEGER PRIMARY KEY AUTOINCREMENT,

    nama_lapangan TEXT NOT NULL,

    jenis_olahraga TEXT,

    harga_per_jam REAL,

    gambar TEXT,

    status TEXT DEFAULT 'aktif'

);

CREATE TABLE IF NOT EXISTS booking (

    id_booking INTEGER PRIMARY KEY AUTOINCREMENT,

    kode_booking TEXT,

    id_user INTEGER,

    id_lapangan INTEGER,

    tanggal_booking DATE,

    jam_mulai TIME,

    durasi INTEGER,

    total_bayar REAL,

    status TEXT DEFAULT 'pending'

);

CREATE TABLE IF NOT EXISTS pembayaran (

    id_pembayaran INTEGER PRIMARY KEY AUTOINCREMENT,

    id_booking INTEGER,

    nominal REAL,

    bukti_transfer TEXT,

    status TEXT DEFAULT 'pending',

    tanggal_upload DATETIME
    DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE IF NOT EXISTS refund (

    id_refund INTEGER PRIMARY KEY AUTOINCREMENT,

    id_booking INTEGER,

    alasan TEXT,

    status TEXT DEFAULT 'pending'

);

");

$cekAdmin = $db->query(
    "SELECT COUNT(*) FROM users WHERE role='admin'"
)->fetchColumn();

if ($cekAdmin == 0) {

    $password = password_hash(
        "password",
        PASSWORD_DEFAULT
    );

    $stmt = $db->prepare("
    INSERT INTO users
    (
        nama,
        email,
        password,
        role
    )
    VALUES
    (
        ?,
        ?,
        ?,
        ?
    )
    ");

    $stmt->execute([
        "Administrator",
        "admin@splj.com",
        $password,
        "admin"
    ]);
}

echo "Database berhasil dibuat";
