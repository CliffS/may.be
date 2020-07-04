<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
  <head>
    <title>EQ2Login</title>
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
    <h1>EQ2Login</h1>
    <h2>What is EQ2Login?</h2>
    <p>EQ2Login is an editor for the front login page of EverQuest&nbsp;II.
    In order to reach this page, you will need to run EverQuest2.exe
    rather than the default shortcut which points to EQ2.exe.
    Fortunately, EQ2Login will
    put a shortcut on your desktop called
    <em>EverQuest&nbsp;II&nbsp;No&nbsp;Patch</em> which points to the
    right place.
    Simply click this shortcut instead of the default <em>EverQuest&nbsp;II</em>
    shortcut.</p>
    <p>If Sony has issued a patch, the login page will ask you to re-run the
    patcher.  Just run the original <em>EverQuest&nbsp;II</em> shortcut and
    it will patch for you.</p>
    <h2>What does EQ2Login do for me?</h2>
    <p>EQ2Login allows you to enter the account information for all accounts
    to which you have access and then to attach the characters and their
    servers to each
    account.  When EverQuest2.exe is run, you will be presented with a login
    screen with all your characters' names in alphabetical order.
    Simply click the one you want and then click
    <em id="connect">Connect</em> and you're
    in.  No Character Select screen, no remembering which password is for which
    account.</p>
    <p>Even if you only have access to one account, EQ2Login enables you to
    save the password so that you do not have to enter it every time
    you log on or switch character.  It also saves the patch time,
    making startup of EQ much faster.</p>
    <p>To switch characters, simply /camp the current one.  The login page will
    re-appear and you can select another character, even if it's on a different
    account.  If you want to go to the original Character Select screen for
    a particular account, there is a button at the bottom for each account.</p>
    <h2>Where can I get EQ2Login?</h2>
    <p>The EQ2Login application can be downloaded here:
    <a href="eq2installer.exe">eq2installer.exe</a>. It simply
    installs and runs. The current version is
  <?php echo get_version(); ?>.
    </p>
    <p>What it does is to check that you
    have <b>.</b>NET version 2.0 installed and, if not, it will download it from
    Microsoft's site.  It will then install EQ2Login.exe.  It makes use of
    Microsoft's new <em>ClickOnce</em> technology and will appear in your Start
    Menu under <code>May.BE -&gt; EQ2Login</code>.</p>
    <p>Every time you run the
    program, it will check this server for updates and install the latest
    version.</p>
    <h2>How do I use the program?</h2>
    <p>Start by adding EQ2 accounts by clicking Add and entering your
    username and password.  Then add characters, typing in the character's
    name and selecting the appropriate account and EQ2 server.  If
    you make a mistake, click edit on the appropriate row and change your
    input.</p>
    <p>If you tick the <i>Show Passwords</i> box, your passwords will
    be visible on the login screen.  Using the View &rarr; Summary option
    will allow you to see all your accounts and characters in a scrollable
    view.</p>
    <h2>Where does EQLogin store my personal data?</h2>
    <p>All the data is stored in and read back from
    <code>eq2ui_loginscene.xml</code> in your current custom UI.  On running
    the program, if EQ2Login detects that you are using the <em>Default</em>
    UI, it will create a custom UI called EQ2Login in your UI folder and
    will store <code>eq2ui_loginscene.xml</code> there.  If, later, you
    decide to download a custom UI, simply move
    <code>eq2ui_loginscene.xml</code> to that UI's folder.  The EQ2Login
    folder can then be deleted.  Don't forget to edit eq2.ini in EverQuest's
    base folder to point at the new UI.</p>
    <p>Your passwords and character data are not stored anywhere else and,
    other than to check for updates, EQ2Login does not access the Internet
    in any way.  If you delete <code>eq2ui_loginscene.xml</code>, all your
    data will be lost.</p>
    <h2>Source Code</h2>
    <p>May.BE runs a <a href="http://subversion.tigris.org/"
    target="svn">Subversion</a> Server with public access for the code to
    this project.  The current source to EQ2Login can be found at <a
    href="http://svn.may.be/svn/EQ2Login/trunk/EQ2Login/" target="svn">
    http://svn.may.be/svn/EQ2Login/trunk/EQ2Login/</a>.  If you make
    any changes, please feed these back to me via
    <a href="mailto:cliff@may.be?subject=EQ2Login">email</a>.</p>
    <h2>Contact Details</h2>
    <p>If you like EQ2Login, please let me know.  Ditto if you hate it or find
    a bug in it or want to make a suggestion for it.  I'm Cliff Stanford
    and you can mail me as
    <a href="mailto:cliff@may.be?subject=EQ2Login">cliff@may.be</a>.  On
    EQ2 I'm Sixes on <span class="s">Oggok</span> Blackburrow, a member of
    <a href="http://www.britlore.co.uk" target="bl">Britannic Lore</a>
    and you can mail me there in-game or as
    <a href="mailto:sixes@britlore.co.uk?subject=EQ2Login">sixes@britlore.co.uk</a>.
    And thanks to Mook from Antonia Bayle for his <a
    href="http://www.eq2interface.com/forums/showthread.php?t=1314"
    target="eq2interface">original concept</a>.</p>
    </td>
    <td>
    <div class="logo">
      <a href="/"><img src="/images/maybe.gif" alt="may.be" /></a>
    </div>
    <img src="images/LoginScene.jpg" alt="eq2ui_loginscene.xml" />
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
  $xml = simplexml_load_file("EQ2Login.application");
  $path = "//asmv2:assemblyIdentity[@name='EQ2Login.exe']/@version";
  $version = $xml->xpath($path);
  return $version[0];
}

?>
