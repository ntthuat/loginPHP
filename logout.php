<?php

session_start();

session_destroy();

echo "You've been logged out. <a href='index.php'>Click here</a> to return.";

?>