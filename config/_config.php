<?php
// En fonction des routes utilisées, il est possible d'avoir besoin de la session ; on la démarre dans tous les cas.
session_start();

define('TEMPLATE_VIEW_PATH', './views/templates/'); // Le chemin vers les templates de vues.
define('MAIN_VIEW_PATH', TEMPLATE_VIEW_PATH . 'main.php'); // Le chemin vers le template principal.

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'tomtroc');
define('DB_USER', 'root');
define('DB_PASS', '');
