<?php
session_start();
session_destroy();
header('Location: index.php?logout_success=Logged out successfully');
exit;
?>