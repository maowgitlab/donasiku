<?php
session_start();
session_destroy();
session_unset();
echo "<script>alert('Anda sudah logout'); window.location.href='../login.php';</script>";
