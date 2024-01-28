<?php
function get_execute_query($input_query, $input_argument = null)
{
    include "../asset_default/koneksi.php";
    $stmt = $pdo->prepare($input_query);
    if (!empty($input_argument)) {
        $stmt->bindParam(':input', $input_argument);
    }
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}
