<?php
session_start();
unset($_SESSION['last_contact_submission']);
echo "Rate limiting session cleared! You can now test the contact form.";
?>
