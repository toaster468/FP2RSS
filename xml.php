<?PHP
	$xml = <<<XML
<?xml version='1.0' encoding='utf-8'?>
    <rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>
      <channel>
        <title>FP RSS</title>
        <description>A Facepunch news reader!</description>
        <link>http://www.toaster468.com/</link>
        <language>en</language>
        <copyright>rssFeedFolder.com</copyright>
        <atom:link href='http://www.yourdomain.com/yourfeed.xml' rel='self' type='application/rss+xml' />
        <image>
          <title>FP RSS</title>
          <url>http://www.toaster468.com/fp_rss.png</url>
          <link>http://www.toaster468.com/</link>
          <description>FP RSS</description>
        </image>
      </channel>
</rss>

XML;
?>