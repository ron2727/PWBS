<?php

@include 'config.php';
$sql = "DELETE FROM account WHERE id='" . $_GET["id"] . "'";
if(mysqli_query($conn,$sql)) {
    header("location:admin.php");
    echo "Record deleted";
}
else{
    echo "Error deleting: ". mysqli_error($conn);
}

mysqli_close($conn);

?>