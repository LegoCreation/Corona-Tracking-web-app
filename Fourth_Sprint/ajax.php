
<?php 

/**
 Simply update the status for a certain hospital given the Id of the 
 hospital as well as the new status
 */

require "./db.php";
 
$id = $_POST['hospitalId'];
$status = $_POST['status'];

try {
    $stmt=$pdo->prepare("UPDATE hospital SET status=:status WHERE id=:id");
$stmt->execute([$status,$id]);

echo json_encode([
    //send back some json to make sure everything went ok
    'ok' => true,
    'new_status' => $status,
]);
    }
    catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}



?>