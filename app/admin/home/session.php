<?php
// include('../../config.php');
require_once(__DIR__ . "../../../config.php");
// session_start();
$user_check = $_SESSION['username'];
$ses_sql = mysqli_query( $mysqli,"select username from tb_admin where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];
if (!isset($login_session)) {
    mysqli_close($connection);
    header('Location: index.php');
}
