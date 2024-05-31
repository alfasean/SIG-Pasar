<?php
require_once "connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$queryMap = "SELECT * FROM pasar";
$resultMap = $conn->query($queryMap);

$markers = array();

if ($resultMap->num_rows > 0) {
    while ($rowMap = $resultMap->fetch_assoc()) {
        $markers[] = array(
            'lat' => $rowMap['latitude'],
            'lng' => $rowMap['longitude'],
            'name' => $rowMap['nama'],
            'id_pasar' => $rowMap['id_pasar']
        );
    }
}

$conn->close();

echo json_encode($markers);
?>
