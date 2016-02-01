<?php
$message = preg_replace('/(<\/?p>)+/', ' ', $message);
throw new Exception("Error : {$message}");
?>