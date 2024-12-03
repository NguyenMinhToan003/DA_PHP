<?php
    include '../views/navAdmin.php';
    require_once '../class/Db.php';

    $db = new Db();

    $sql = "SELECT od.detail_id, o.order_id, 
            FROM order_detail od 
            INNER JOIN order o ON od.order_id = o.order_id";
?>
<div>

</div>