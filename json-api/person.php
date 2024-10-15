<?php
header('Content-Type: application/xml');

// Daftar awal buku
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

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Endpoint GET untuk mengembalikan daftar buku dalam XML
        $xml = new SimpleXMLElement('<books/>');
        foreach ($books as $book) {
            $bookElement = $xml->addChild('book');
            $bookElement->addChild('id', $book['id']);
            $bookElement->addChild('judul', $book['judul']);
            $bookElement->addChild('penulis', $book['penulis']);
            $bookElement->addChild('tahun', $book['tahun']);
        }
        echo $xml->asXML();
        break;

    case 'POST':
        // Endpoint POST untuk menambah buku baru ke dalam XML
        $input = json_decode(file_get_contents('php://input'), true);
        $newBook = [
            "id" => end($books)['id'] + 1,
            "judul" => $input['judul'],
            "penulis" => $input['penulis'],
            "tahun" => $input['tahun']
        ];
        $books[] = $newBook;

        // Buat respons dalam XML
        $xml = new SimpleXMLElement('<book/>');
        $xml->addChild('id', $newBook['id']);
        $xml->addChild('judul', $newBook['judul']);
        $xml->addChild('penulis', $newBook['penulis']);
        $xml->addChild('tahun', $newBook['tahun']);
        
        echo $xml->asXML();
        break;

    default:
        http_response_code(405);
        echo "Metode HTTP tidak didukung";
        break;
}
?>
