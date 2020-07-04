<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
  <head>
    <title>EQ2 Logcleaner</title>
    <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
    </script>
    <script type="text/javascript">
      _uacct = "UA-3038629-3";
      urchinTracker();
    </script>
    <link rel="stylesheet" type="text/css" href="/css/eq2progs.css" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  </head>
  <body>
    <table class="main">
    <tr>
    <td id="left">
    <h1>EQ2 Logcleaner</h1>
    <h2>What is EQ2 Logcleaner?</h2>
    <p>EQ2 Logcleaner is an filter for your Everquest II log files.
    It strips out the numeric date and all link information and copies
    the text to a new file.  It will filter on chat type and on date
    and time.  It has the option to set your favourite viewer or text
    editor and to open the resulting file.</p>
    <h2>What does EQ2 Logcleaner do for me?</h2>
    Have you ever wanted to post a group or tell conversation to a forum
    or mail it to a friend?  EQ2 Logcleaner will filter out all the other
    conversations and battlespam, leaving you just what you need.<p>
    Do you want to see what you sold and at what price?  Simply tick the
    <em>Sales</em> box and you will get a list of all your broker
    transactions. </p>
    <p>Under the File menu, click <em>Set Viewer</em> and navigate to your
    preferred text viewer or text editor.  The default is Notepad but I
    recommend changing this as Notepad copes very badly with large files.
    Personally I use
    <a href="http://www.vim.org/download.php#pc" target="_blank">gvim</a>
    which can load a 300 Mb file in about 6 seconds.  Having set the
    viewer, <em>File -&gt; View File</em> will display it or,
    even easier, click on the link near the bottom of the form.</p>
    <p>You may wish to see everything but if you are looking for something
    specific, you can narrow it down to a specific time period. Who was it
    who was selling masters in the tradeskill channel yesterday? Set
    your start and end date and tick channels and you will have a minimal
    amount of data to look through.</p>
    <p>Finally, you can search on key words.  If the <em>Keywords</em>
    box is ticked, only lines containing the words chosen will be
    output.</p>
    <p>Starting with version 1.1, you can select Raidmembers and Loot. The
    former will include the output from a /whoraid command, the latter will
    show loot drops.  The Loot option includes both guild messages and those
    produced by the <i>Extended Chat Window Output</i>.</p>
    <h2>Where can I get EQ2 Logcleaner?</h2>
    <p>The EQ2 Logcleaner application can be downloaded here:
    <a href="LogcleanerInstaller.exe">LogcleanerInstaller.exe</a>.
    It simply downloads and runs.</p>
    <p>The installer checks that you
    have <b>.</b>NET version 2.0 installed and, if not, it will download it from
    Microsoft's site.  It will then install Logcleaner.exe.  It makes use of
    Microsoft's new <em>ClickOnce</em> technology and will appear in your Start
    Menu under <em>May.BE -&gt; EQ2Logcleaner</em>.</p>
    <p>Every time you run the
    program, it will check this server for updates and install the latest
    version.  No information is uploaded to the server.</p>
    <p>The current version is <?php echo get_version(); ?> and so
    I suppose it can be considered to be out of beta. I
    would be very grateful for any feedback you may have.  Expect to see 
    new features being added as time goes on.
    </p>
    <h2>Where does EQ2 Logcleaner store my personal data?</h2>
    <p>The only data stored is in the registry under <em>HKEY_CURRENT_USER
    -&gt; Software -&gt; May.BE -&gt; Logcleaner</em>.  Only your last-used
    options are stored so that they become your default settings for next
    time you run the program.  No information is sent onto the Internet.</p>
    <h2>Source Code</h2>
    <p>May.BE runs a <a href="http://subversion.tigris.org/"
    target="svn">Subversion</a> Server with public access for the code to
    this project.  The current source to EQ2 Logcleaner can be found at <a
    href="http://svn.may.be/svn/Cleanlog/trunk/" target="svn">
    http://svn.may.be/svn/Cleanlog/trunk/</a>.  If you make
    any changes, please feed these back to me via
    <a href="mailto:cliff@may.be?subject=EQ2 Logcleaner">email</a>.</p>
    <h2>Other Utilities</h2>
    <p>See also my <a href="/eq2login/">EQ2 Login</a> utility which
    simplifies switching around characters and accounts.</p>
    <h2>Contact Details</h2>
    <p>If you like EQ2 Logcleaner, please let me know.  Ditto if you hate it or find
    a bug in it or want to make a suggestion for it.  I'm Cliff Stanford
    and you can mail me as
    <a href="mailto:cliff@may.be?subject=EQ2 Logcleaner">cliff@may.be</a>.  On
    EQ2 I'm Sixes on Blackburrow, a member of
    <a href="http://www.britlore.co.uk" target="bl">Britannic Lore</a>
    and you can mail me there in-game or as
    <a href="mailto:sixes@britlore.co.uk?subject=EQ2 Logcleaner">sixes@britlore.co.uk</a>.
    </p>
    </td>
    <td>
    <div class="logo">
      <a href="/"><img src="/images/maybe.gif" alt="www.may.be" title="www.may.be" /></a>
    </div>
    <img src="images/EQ2Logcleaner.jpg" alt="EQ2 Log Cleaner" />
    </td>
    </tr>
    </table>
    <div class="w3c">
      <a href="http://validator.w3.org/check?uri=referer" target="w3c"><img
	src="http://www.w3.org/Icons/valid-xhtml10"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
    </div>
  </body>
</html>

<?php

function get_version()
{
  $xml = simplexml_load_file("Logcleaner.application");
  $path = "//asmv2:assemblyIdentity[@name='Logcleaner.exe']/@version";
  $version = $xml->xpath($path);
  return $version[0];
}

?>
