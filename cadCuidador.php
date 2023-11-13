<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = '127.0.0.1:3306';
$username = 'root';
$password = 'Luis1234';
$dbname = 'cuidadoridoso';

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Retrieve the JSON parameter from the POST request
$jsonParam = json_decode(file_get_contents('php://input'), true);

if (!empty($jsonParam)) {
    // Prepare the data for insertion
    $nome = isset($jsonParam['nome']) ? $jsonParam['nome'] : '';
    $email = isset($jsonParam['email']) ? $jsonParam['email'] : '';
    $celular = isset($jsonParam['celular']) ? $jsonParam['celular'] : '';
    $temCurso = isset($jsonParam['temCurso']) ? $jsonParam['temCurso'] : '';
    $cursos = isset($jsonParam['cursos']) ? $jsonParam['cursos'] : '';
    $cdEscolaridade = isset($jsonParam['Escolaridade_idEscolaridade']) ? $jsonParam['Escolaridade_idEscolaridade'] : '';


    // Prepare the SQL statement for insertion
    $insertQuery = "INSERT INTO cuidador (nome, email, celular, temCurso, cursos, Escolaridade_idEscolaridade) 
		VALUES ('$nome', '$email', '$celular', '$temCurso', '$cursos', '$cdEscolaridade')";

    if ($con->query($insertQuery) === true) {
        // Insertion successful
        $response = array(
            'success' => true,
            'message' => 'Cuidador inserido com sucesso!'
        );
        echo json_encode($response);
    } else {
        // Error in insertion
        $response = array(
            'success' => false,
            'message' => 'Erro no registro do cuidador: ' . $con->error
        );
        echo json_encode($response);
    }
} else {
    // No data provided
    $response = array(
        'success' => false,
        'message' => 'Dados insuficientes para o registro do cuidador!'
    );
    echo json_encode($response);
}

$con->close();

?>