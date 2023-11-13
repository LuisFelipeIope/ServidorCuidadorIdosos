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
    // Prepare the data for updating
    $idCuidador = isset($jsonParam['idCuidador']) ? intval($jsonParam['idCuidador']) : 0;
    $nome = isset($jsonParam['nome']) ? $jsonParam['nome'] : '';
    $email = isset($jsonParam['email']) ? $jsonParam['email'] : '';
    $celular = isset($jsonParam['celular']) ? $jsonParam['celular'] : '';
    $temCurso = isset($jsonParam['temCurso']) ? $jsonParam['temCurso'] : '';
    $cursos = isset($jsonParam['cursos']) ? $jsonParam['cursos'] : '';
    $cdEscolaridade = isset($jsonParam['Escolaridade_idEscolaridade']) ? $jsonParam['Escolaridade_idEscolaridade'] : '';

    // Prepare the SQL statement for updating
    $updateQuery = "UPDATE Cuidador SET nome = '$nome', email = '$email', celular = '$celular', temCurso= '$temCurso',
        cursos = '$cursos', Escolaridade_idEscolaridade = '$cdEscolaridade' WHERE idCuidador = '$idCuidador'";

    if ($con->query($updateQuery) === true) {
        // Update successful
        $response = array(
            'success' => true,
            'message' => 'Cuidador atualizado com sucesso!'
        );
        echo json_encode($response);
    } else {
        // Error in update
        $response = array(
            'success' => false,
            'message' => 'Erro ao atualizar o cuidador: ' . $con->error
        );
        echo json_encode($response);
    }
} else {
    // No data provided
    $response = array(
        'success' => false,
        'message' => 'Dados insuficientes para atualizar o cuidador!'
    );
    echo json_encode($response);
}

$con->close();

?>