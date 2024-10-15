<?php
header('Content-Type: application/json');

// Data awal: daftar buku (bisa juga film atau item lainnya)
$books = [
    [
        "id" => 1,
        "judul" => "Buku Sejarah",
        "penulis" => "Jw.Walker",
        "tahun" => 1990
    ],
    [
        "id" => 2,
        "judul" => "Buku Sains",
        "penulis" => "MR.Smith",
        "tahun" => 2000
    ]
];

// Mendapatkan metode HTTP yang digunakan
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Endpoint GET untuk mengembalikan daftar buku
        echo json_encode($books);
        break;

    case 'POST':
        // Endpoint POST untuk menambah buku baru
        $input = json_decode(file_get_contents('php://input'), true);
        $input['id'] = end($books)['id'] + 1; // Memberikan ID baru secara otomatis
        $books[] = $input;
        echo json_encode($input); // Mengembalikan data yang baru ditambahkan
        break;

    default:
        http_response_code(405); // Jika metode tidak didukung
        echo json_encode(["message" => "Metode HTTP tidak didukung"]);
        break;
}
?>
