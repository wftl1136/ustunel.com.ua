<?php
// logout.php - Destroys session and redirects to login

require_once __DIR__ . '/includes/auth.php';

logout_user();
header("Location: login.php?notice=logged_out");
exit;
