<?php
$Loader = new josegonzalez\Dotenv\Loader('../.env');
// Parse .env file
$Loader->parse();
// Send the parsed .env file to the $_ENV variable
$Loader->toEnv();
?>
