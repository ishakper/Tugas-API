<?php
// Mengambil data dari API JSON
$jsonData = file_get_contents('http://localhost/PRAK API/json-api/api.php');

// Decode JSON menjadi array
$books = json_decode($jsonData, true);

// Membuat XML dari data JSON
$xml = new SimpleXMLElement('<books/>');

foreach ($books as $book) {
    $bookElement = $xml->addChild('book');
    $bookElement->addChild('id', $book['id']);
    $bookElement->addChild('judul', $book['judul']);
    $bookElement->addChild('penulis', $book['penulis']);
    $bookElement->addChild('tahun', $book['tahun']);
}

// Mengatur header XML dan menampilkan hasil
header('Content-Type: application/xml');
echo $xml->asXML();
?>
