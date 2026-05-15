<?php  require_once 'connection.php'; ?>
<?php  require_once 'verify.php'; ?>
<?php  
    if(isset($_GET['delete'])){
        $query=$conn->prepare("DELETE FROM transactions WHERE id=?");
        $query->bind_param("s", $_GET['delete']);
        $query->execute();
        $_SESSION['message']="Transaction deleted";
        $_SESSION['msg_type']="danger";
        header('location: ../index.php');
    }

?>