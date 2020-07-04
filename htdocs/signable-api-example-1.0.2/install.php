<?php include '_settings.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"> 
<head> 
    <meta http-equiv="Content-Language" content="en-gb" /> 
    <title>Get eSignature | Your API Application</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    <link rel="stylesheet" type="text/css" href="<?php echo $base; ?>styles/layout.css" media="screen" />  
</head> 
<body>
    <h1><a href="<?php echo $base; ?>">Your API Application</a></h1>

    <h2>Step 1. Enter your API information</h2>
    
    <p>Your API information can be found once logged into your Get eSignature account. Click on “&lt;Your company&gt; Profile” in the header and your API information is on the right hand side. Copy this API information into the _settings.php file and you’re almost ready to go.</p>
    
    <h2>Step 2. Complete any other optional settings</h2>
    
    <p>In the _settings.php file there are a couple of other optional settings you can tweak:</p>
    
    <ol>
        <li><strong>$returnFormat</strong> can be either 'json' or 'xml'. These examples use JSON, but you can use XML if you prefer.</li>
        <li><strong>$base</strong> the base location of this application. Simply use '/' if you are using the root directory or '/your/directory/structure/' if placed inside a sub directory.</li>
        <li><strong>$dateFormat</strong> how any dates are outputted. This uses PHP's <tt><a href="http://php.net/manual/en/function.date.php">date</a></tt> characters.</li>
        <li><strong>$perPage</strong> how many items are returned from the API at once (some functions display all or limited results, overriding this variable)</li>
    </ol>
    
    <h2>Step 3. Enjoy!</h2>
    
    <p>Done all that? Cool, <a href="<?php echo $base; ?>">click here</a> to go to your application homepage.</p>
</body>
</html>