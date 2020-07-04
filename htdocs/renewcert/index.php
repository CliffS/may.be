<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
  <head>
    <title>RenewCert - Renew Expired Certificates</title>
    <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
    </script>
    <script type="text/javascript">
      _uacct = "UA-3038629-3";
      urchinTracker();
    </script>
    <link rel="stylesheet" type="text/css" href="/css/maybe.css" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  </head>
  <body>
    <table class="main">
    <tr>
    <td class="left" width="50%">
    <h1>RenewCert - Working Version</h1>
    <h2>What is RenewCert?</h2>
    <p>Microsoft has screwed up with its ClickOnce deployment
    in Visual Studio 2005&copy;.
    You are required to have a certificate in order to sign the
    ClickOnce manifests and, by default, you create one with an expiry
    of one year.</p>
    <p>A year on, your certificate expires and Visual Studio 2005&copy;
    refuses to allow you to upload any more.  If you simply create a
    new certificate, all your customers get an error:</p>
    <blockquote class="errmsg">
    The deployment identity does not match the subscription.
    </blockquote>
    <p>Not only can the customer not download the newer version,
    he cannot, owing to the nature of ClickOnce, even continue to
    use the older version.</p>
    <h2>Microsoft Workarounds</h2>
    <p>Microsoft developers know about this problem and have documented
    it on their support site: <a href="http://support.microsoft.com/kb/925521"
    target="ms">http://support.microsoft.com/kb/925521</a> where 
    they give two &quot;workarounds&quot;.</p>
    <p>The first &quot;workaround&quot; is a total joke:</p>
    <blockquote style="font-style:italic">
    Uninstall the ClickOnce application that you signed by using the
    expired certificate. Then, reinstall the updated ClickOnce application
    that uses the new certificate.
    </blockquote>
    <p>What they actually mean is that you need to tell each and every one
    of your users to uninstall your application and reinstall it
    from scratch.  Of course, you have no means to contact the users
    as all they see when trying to run the program
    is an unhelpful error message from Microsoft.</p>
    <p>Their second workaround is a little better.  According to Microsoft,
    you should:</p>
    <blockquote style="font-style:italic">
    Create a command-line assembly that updates the certificate.
    </blockquote>
    <p>What they actually mean is that you need to create a new certificate
    with the same key as the old one but with a date some time in the
    future.  The code supplied tries to set it five years from the date it's
    run. This would be fine, if the code actually worked.</p>
    <h2>Microsoft's Code</h2>
    <p>The Microsoft developers should be ashamed of the code provided.
    There is no error checking whatsoever; even a simple
    <em>File not found</em> causes a crash.</p>
    <p>The bigger problem is that the workaround doesn't 
    work for keys other than the very simple
    ones produced as <em>Test Certificates</em> by the signing page.
    As one correspondent put it, &quot;it worked great for all the
    certificates but the one I wanted.&quot;</p>
    <p>The main problem with the Microsoft code is that it loses the
    <code>CRYPT_KEY_PROV_INFO</code> structure from the original key
    and thus <code>CertCreateSelfSignCertificate()</code> fails.  Of
    course, in the original code, there is no way to tell
    what was failing.</p>
    </td>
    <td width="50%" class="right">
    <div class="logo">
      <a href="/"><img src="/images/maybe.gif" alt="May.BE Logo"
      title="Home" /></a>
    </div>
    <h2>The Solution</h2>
    <p>I have modified the Microsoft code to put in a
    test for success after each
    and every function call. I preserve the provider info structure
    from the old key to use when creating the new key.  This seems to
    work but I have only tested it with a very limited number of keys.</p>
    <p>The revised code can be found on my Subversion server in the file
    <a href="http://svn.may.be/svnvi.pl?file=RenewCert.cpp&amp;repos=RenewCert&amp;path=/trunk/RenewCert"
    target="svn">RenewCert.cpp</a>.  I apologise in advance for the
    state of this code &hellip; I got it to work and stopped fiddling.
    Maybe one day I'll rewrite it as a Windows application.</p>
    <p>In the meanwhile, you can download the
    <a href="RenewCert.zip">project as a zip file</a> or simply
    download the <a href="Renewcert.exe">executable</a> from this site.
    The project is also available from the
    <a href="http://svn.may.be/svn/RenewCert/"
    target="svn">Subversion Server</a>,  Please let me know how you get
    on with it.  Microsoft developers, please feel free to update your
    support pages with code from here.  Better still, Microsoft,
    maybe you should
    re-write the solution properly.</p>
    <h2>How To Use</h2>
    <p>On the <a href="http://support.microsoft.com/default.aspx/kb/925521"
    target="ms">Microsoft page</a>, it tells you to execute the following
    command:</p>
    <p style="font-size:smaller">
    renewcert &lt;OldCertificate&gt;.pfx &lt;NewCertificate&gt;.pfx \&quot;CN=&lt;NewCertificateName&gt;\&quot; &lt;Password&gt;
    </p>
    <p>This has confused a number of people as it has the effect of passing the
    quotes into the third parameter.  The correct syntax is:</p>
    <p style="font-size:smaller">
    renewcert &lt;OldCertificate&gt;.pfx &lt;NewCertificate&gt;.pfx CN=&lt;NewCertificateName&gt; &lt;Password&gt;
    </p>
    <p>Where the items in &lt;&gt; (including the &lt;&gt;) are replaced
    with the appropriate names.  If
    any parameter has a space or backslash in it, you should surround that
    parameter with quotes.  e.g.:</p>
    <p style="font-size:smaller">
    renewcert maybe.pfx "new maybe.pfx" CN=NewName secret
    </p>
    <h2>Problems</h2>
    <p>It seems that a number of people have had an issue where the 
    executable referred to above fails to run.  It seems to need something
    from the Microsoft C++ development environment but, so far, I've
    been unable to work out what.  The solution is to install the free
    <a href="http://msdn2.microsoft.com/en-gb/express/default.aspx"
    target="_blank">Visual Studio Express</a> version and rebuild the
    project.  If anyone manages to get an executable that runs without this
    please <a href="mailto:cliff@may.be?subject=Renewcert">let me know</a>.
    </p>
    <h2>Feedback</h2>
    <p>If you try this code, I would very much appreciate some feedback.
    Did it work for you?  If it gave an error, please let me have
    the output.
    Either way, please
<a href="mailto:cliff@may.be?subject='Renewcert Feedback'">mail me</a>
    and let me know.</p>
    <p>Cliff Stanford</p>
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
