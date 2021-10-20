<?php 
  session_start();
  // define error page 
  $error = "/"; 
  // define the path to the download folder 
  $filepath = 'img/';
  $getfile = NULL; 
  // block any attempt to explore the filesystem 
  if ((isset($_GET['file']) && "true" == $_GET['file']) &&(isset($_SESSION['email']) && isset($_SESSION['name']) )) { 
    $getfile = "Young_and_get_rich.pdf"; 
    // recordData($_SESSION['email'],$_SESSION['name']);
  } else { 
    header("Location: $error"); 
    exit; 
  } 
  if ($getfile) {
    $path = $filepath . $getfile; 
    if (file_exists($path) && is_readable($path)) { 
      // get the file's size and send the appropriate headers 
      $size = filesize($path); 
      header('Content-Type: application/octet-stream'); 
      header('Content-Length: '. $size); 
      header('Content-Disposition: attachment; filename=' . $getfile); 
      header('Content-Transfer-Encoding: binary'); 
      // open the file in read-only mode 
      // suppress error messages if the file can't be opened 
      $file = @fopen($path, 'r'); 
      if ($file) { 
        // stream the file and exit the script when complete 
        fpassthru($file); 
        // exit; 
      } else { 
        header("Location: $error"); 
      } 
    } else { 
      header("Location: $error"); 
    }
  }
session_unset();
session_destroy();
exit();

?>