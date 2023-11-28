<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "200.98.129.120:3306";
$username = 'marcosvir_luis';
$password = 'fuSa%8G]6T9S';
$database = 'marcosvir_luis';

// $servername = '127.0.0.1:3306';
// $username = 'root';
// $password = 'Luis1234';
// $database = 'cuidadoridoso';

// Add the following lines to set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow requests from any origin (you can restrict this in a production environment)
header("Access-Control-Allow-Methods: POST"); // Allow POST requests
header("Access-Control-Allow-Methods: GET"); // Allow POST requests
header("Access-Control-Allow-Headers: Content-Type"); // Allow Content-Type header

try {
    $conn = new PDO("mysql:host=$servername; dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

$inputFile = file_get_contents('php://input');
if ($data = json_decode($inputFile, true)) {


    if (json_last_error() === JSON_ERROR_NONE) {

        // Prepare the SQL statement for insertion
        $stmt = $conn->prepare("INSERT INTO cuidador (nome, email, celular, temCurso, cursos, Escolaridade_idEscolaridade) 
            VALUES (:nome, :email, :celular, :temCurso, :cursos, :Escolaridade_idEscolaridade)");

        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':celular', $data['celular']);
        $stmt->bindParam(':temCurso', $data['temCurso'],  PDO::PARAM_INT);
        $stmt->bindParam(':cursos', $data['cursos']);
        $stmt->bindParam(':Escolaridade_idEscolaridade', $data['idEscolaridade'],  PDO::PARAM_INT);

        if ($stmt->execute()) {
            $response = [
                "success" => true,
                "message" => "Data saved successfully."
            ];
        } else {
            $response = [
                "success" => false,
                "message" => "Failed to save data."
            ];
        }
    } else {
        $response = [
            "success" => false,
            "message" => "Invalid JSON format."
        ];
    }
    

  
} else {
    // No data provided
    $response = [
        "success" => false,
        "message" => "Input JSON file not found."
    ];
    
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);

// Close the database connection
$conn = null;

?>