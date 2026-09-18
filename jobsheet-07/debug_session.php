<?php
session_start();

echo "<h1>Debug Session</h1>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";