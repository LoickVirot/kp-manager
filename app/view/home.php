<div class="jumbotron">
  <h1>Suzy</h1>
  <p>A free and open-source php framework</p>
  <p><a class="btn btn-primary" href="https://github.com/LoickVirot/Suzy">GitHub</a></p>
</div>
<h2>Apache configuration</h2>
<pre>
    &lt;VirtualHost *:80&gt;
      DocumentRoot "/srv/http/Suzy/public"
      ServerName suzy.dev

      &lt;Directory /srv/http/Suzy&gt;
        Options FollowSymLinks
        AllowOverride all
      &lt;/Directory&gt;

      ErrorLog "/var/log/httpd/suzy-error.log
    &lt;/VirtualHost&gt;
</pre>
