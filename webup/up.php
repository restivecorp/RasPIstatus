<?php
$dir = '';
$fs = $dir . basename($_FILES['f']['name']);

if (move_uploaded_file($_FILES['f']['tmp_name'], $fs)) {
    header("Location: ../network.php?up=OK");
	die();
} else {
    header("Location: ../network.php?up=KO");
	die();
}
?>