<?php

  // Error reporting
  ini_set('display_errors', 'On');
  error_reporting('E_ALL');

  // Check if Session user isset
  $sessionUser = (isset($_SESSION['user'])) ? ucwords($_SESSION['user']) : "";


  // Routes
  $lang      = "includes/languages/"; // Languages Directory
  $tpl       = "includes/templates/"; // Template Directory
  $func      = "includes/functions/"; // Functions Directory
  $css       = "layout/css/";         // css Directory
  $cssvendor = "layout/css/vendor/";  // css Vendor Directory
  $js        = "layout/js/";          // js Directory
  $jsvendor = "layout/js/vendor/";    // js Vendor Directory


  // Incluse The Important Files
  include $func . "functions.php";
  include $lang . "english.php";
  include $tpl . "header.php";
