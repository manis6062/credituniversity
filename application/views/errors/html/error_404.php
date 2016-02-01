<?php
$message = preg_replace('/(<\/?p>)+/', ' ', $message);
throw new Exception("404 : {$message}");
?>