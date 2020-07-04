<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/css/maybe.css" />
    <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
    </script>
    <script type="text/javascript">
      _uacct = "UA-3038629-3";
      urchinTracker();
    </script>
    <title>USDA Database Searcher</title>
  </head>
  <body>
    <div class="logo">
      <img src="/images/maybe.gif" alt="May.BE Logo" />
    </div>
    <h2>
      Download the <a href="setup.exe">USDA Database Installer</a>.
    </h2>
    <p>Version = <?php echo get_version(); ?>.</p>
  </body>
</html>

<?php

function get_version()
{
  $xml = simplexml_load_file("USDA.application");
  $path = "//asmv2:assemblyIdentity[@name='USDA.exe']/@version";
  $version = $xml->xpath($path);
  return $version[0];
}

?>
