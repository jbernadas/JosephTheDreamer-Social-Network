<?php
// This prevents user from seeing the index.php (essentially going back in to logged in areas) page when clicking the backbutton of browser
session_start();
session_destroy();
header("Location: ../../register.php")
?>