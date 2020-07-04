<?php
// Necessary header information.
session_start();
ob_start();
header("Content-type:text/html; charset=utf-8");
putenv('TZ=Europe/London');

// Error reporting.
ini_set('display_errors', E_ALL);
ini_set('log_errors', 0);
error_reporting(E_ALL);

// Include necessary files and settings.
include '_settings.php';
include 'includes/Request.class.php';

// Has the user entered in the required information?
if (empty($apiId) || empty($apiKey)) {
    header('Location: install.php'); exit();
}

// Create a new Request object.
$request = new Request($apiId, $apiKey, $returnFormat);

// Work out item start
if (! isset($_GET['page'])) {
    $page = 1;
    $pageStart = 0;
} else {
    $page = (int)$_GET['page'];
    $pageStart = ($page - 1) * $perPage;
}

// Function to output the bottom page navigation.
function outputNavigation($pageUrl, $page) {
    // Start the output.
    $output = 'You are currently on page ' . $page . '.';
    
    // Do we need a previous button?
    if ($page > 1) {
        $output .= ' <a href="' . $pageUrl . '?page=' . ($page - 1) . '">Previous page</a> | ';
    }
    
    // Add the next button.
    $output .= ' <a href="' . $pageUrl . '?page=' . ($page + 1) . '">Next page</a>';
    
    // Return the output.
    return '<p>' . $output . '</p>';
}
?>

 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"> 
<head> 
    <meta http-equiv="Content-Language" content="en-gb" /> 
    <title>Signable | Your API Application</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    <link rel="stylesheet" type="text/css" href="<?php echo $base; ?>styles/layout.css" media="screen" />  
</head> 
<body>
    <h1><a href="<?php echo $base; ?>">Your API Application</a></h1>