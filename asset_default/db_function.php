<?php
function get_execute_query($input_query)
{
    include "../asset_default/koneksi.php";
    $stmt = $pdo->prepare($input_query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}