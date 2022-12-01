
<?php 

/**
 Check out ajax.php for comments
 */
require "./db.php";

$id = $_POST['visitorId'];
$status = $_POST['status'];

try{
    $stmt=$pdo->prepare("UPDATE visitor SET status=:status WHERE id=:id");
    $stmt->execute([$status,$id]);



    echo json_encode([ 
        'ok' => true,
        'new_status' => $status,
        ]);
    }
catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>