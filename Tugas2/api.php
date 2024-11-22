<?php
require 'db.php';

// Menambahkan header untuk CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Metode HTTP yang diizinkan.
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Header yang diizinkan.
header("Content-Type: application/json");

// Tangani permintaan OPTIONS (preflight request)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// GET METHOD - Read Products
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM products");
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
    exit();
}

// POST METHOD - Create Product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $price = $data['price'];
    $image = $data['image']; // Base64 image
    $product_code = 'PRD-' . uniqid();

    // Simpan produk ke database
    $stmt = $conn->prepare("INSERT INTO products (product_code, name, price, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $product_code, $name, $price, $image);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Product created successfully', 'product_code' => $product_code]);
    } else {
        echo json_encode(['error' => 'Failed to create product']);
    }
    exit();
}


// PUT METHOD - Update Product
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $product_code = $data['product_code'];
    $name = $data['name'];
    $price = $data['price'];
    $image = $data['image'];

    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ? WHERE product_code = ?");
    $stmt->bind_param("sdss", $name, $price, $image, $product_code);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Product updated successfully']);
    } else {
        echo json_encode(['error' => 'Failed to update product']);
    }
    exit();
}

// DELETE METHOD - Delete Product
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    $product_code = $data['product_code'];

    if (empty($product_code)) {
        echo json_encode(['error' => 'Product Code is required']);
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM products WHERE product_code = ?");
    $stmt->bind_param("s", $product_code);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Product deleted successfully']);
    } else {
        echo json_encode(['error' => 'Failed to delete product']);
    }
    exit();
}


// Default response for invalid methods
echo json_encode(['error' => 'Invalid request method']);
?>
