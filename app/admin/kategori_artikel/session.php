<?php
session_start();
include_once("../../config.php");
// require_once(__DIR__ . "../../../config.php");

$user_check = $_SESSION['username'];
$sql = "SELECT username FROM tb_admin WHERE username='$user_check'";
$result = mysqli_query($mysqli, $sql);
if ($result->num_rows ==  0) {
    $row = mysqli_fetch_assoc($result);
    $login_session = $row['username'];
}
