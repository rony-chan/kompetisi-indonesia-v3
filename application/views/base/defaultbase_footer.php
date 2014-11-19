<!--base start-->
<!-- Modal -->
<footer>
  <section class="footer"> 
    <div class="row">

      <div class="footer-link col-md-2">          
        <ul class="menu">
          <li><img src="<?php echo base_url('images/home/logo-white.png')?>"/></li>
        </ul>
      </div>
      <div class="footer-link col-md-1">
        <ul class="menu">
          <li><strong><h5>Ready</h5></strong></li>
          <li><a href="<?php echo site_url('pasangkompetisi');?>">Pasang</a></li>
          <li><a href="<?php echo site_url('start/kompetisi/jelajah');?>">Jelajah</a></li>
          <li><a href="<?php echo site_url('start/kompetisi/news');?>">Berita</a></li>
          <li><a href="<?php echo site_url('publik/read/TWpBPQ/Bantuan');?>">Bantuan</a></li>
          <li><a href="<?php echo site_url('publik/read/TVRZPQ/Testimoni');?>">Testimoni</a></li> 
          <li><a href="<?php echo site_url('publik/read/TWpZPQ/Kompetisi-Indonesia-Ads');?>">Ads</a></li> 
          <li><a data-toggle="modal" href="#login">Login/Register</a></li>
        </ul>
      </div>
      <div class="footer-link col-md-1">
        <ul class="menu">
          <li><strong><h5>Kategori</h5></strong></li>
          <?php 
          $main_kat = $this->m_kompetisi->show_kat();
          foreach ($main_kat as $mk) : ?>
            <li><a href="<?php echo site_url('start/kompetisi/jelajah?q=&kat='.$mk['id_main_kat'])?>"><?php echo $mk['main_kat']?></a></li>
          <?php endforeach ?>
        </ul>
      </div>
      <div class="footer-link col-md-4">
        <ul class="menu">
          <li>
           <div class="fb-like" data-href="https://facebook.com/kompetisiindo" data-width="200px" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
         </li>
         <li><br/></li>
         <li>
          <a href="https://twitter.com/kompetisiindo" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </li>
        <li><br/></li>
        <li><br/></li>
      </ul>
    </div>

    <div class="footer-link col-md-4">
      <p>KompetisiIndonesia<sup>TM</sup> , kompetisi dengan cara berbeda. Temukan beragam kompetisi dari berbagai kategori yang diadakan di Indonesia dengan mudah. Manajemen kompetisi yang kamu ikuti untuk selalu update beritanya dan tidak terlewat batas deadlinenya. Sebagai penyelanggara tidak perlu pusing lagi untuk mebuat personal web sebagai media publikasi, cukup menggunakan KompetisiIndonesia<sup>TM</sup> penyelenggara bisa memasang kompetisi, memanajemen peserta dan penyerahan hadiah.  </p>
      <p><a href="<?php echo site_url('publik/read/TVRjPQ/Privacy-Policy')?>">Privacy Policy</a> | <a href="<?php echo site_url('publik/read/TWpJPQ/Disclaimer')?>">Disclaimer</a> <!-- | <a href="<?php echo base_url('publik/read/TVRnPQ/Term-Of-Use')?>">Term of Use</a> --> | <a href="#">Sitemap</a> |  <a href="<?php echo site_url('publik/read/TVRrPQ/Contact-Us')?>">Contact Us</a> | <a  target="_blank" href="http://www.emailmeform.com/builder/form/L065MsWJTyH5RdZf9CAQ">Error Report</a> </p>
      <p>Kompetisi Indonesia &copy; copyright 2011 - 2014 All Rights Reserved | by ID+More</p>
    </div>
  </div>    
</section>
<section class="footer-social"> 
  <center>
    <a title="Kindo via Google+" target="_blank" href="https://plus.google.com/u/0/+Kompetisiindonesia"><span><img src="http://kompetisiindonesia.com/images/icon/g+-20x20.png" alt="google+-login"/></span></a>
    <a title="Kindo via Facebook" target="_blank" href="http://facebook.com/kompetisiindo"><span><img src="http://kompetisiindonesia.com/images/icon/fb-20x20.png" alt="facebook-login"/></span></a>
    <a title="Kindo via Twitter" target="_blank" href="http://twitter.com/kompetisiindo"><span><img src="http://kompetisiindonesia.com/images/icon/twitter-20x20.png" alt="twitter-login"/></span></a>
    <a title="Kindo via RSS" target="_blank" href="http://feeds.feedburner.com/kompetisiindo"><span><img src="http://kompetisiindonesia.com/images/icon/rss-20x20.png" alt="rss"/></span></a>
    <a title="Kindo via Email" target="_blank" href="mailto:sc@kompetisiindonesia.com"><span><img src="http://kompetisiindonesia.com/images/icon/mail-20x20.png" alt="email-login"/></span></a>
  </center>
</section>
<section class="footer-link partner"> 
  <center><p>Supported By : </p></center>
  <div class="container">
    <center>    
     <a target="_blank" href="http://facebook.com/idmore" title="ID+More Indonesia dan Kelebihannya"><img style="height:30px" src="<?php echo base_url('images/partner/idmore.png')?>"/></a>
     <a target="_blank" href="http://my.domainesia.com/aff.php?aff=585" title="Domainesia Jagonya Hosting dan Domain"><img style="height:30px" src="<?php echo base_url('images/partner/domainesia.png')?>"/></a>
     <a target="_blank" href="https://www.google.com/work/apps/business/" title="Google Apps For Work"><img style="height:30px" src="<?php echo base_url('images/partner/google-apps-for-work.png')?>"/></a>
   </center>
 </div>
</section>
</footer>
</body>



<!--GOOGLE +-->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js?onload=onLoadCallback';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>


<!--FB SDK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1419514554927551";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!-- Histats.com  START (hidden counter)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="web counter gratis" ><script  type="text/javascript" >
  try {Histats.start(1,2475171,4,0,0,0,"");
  Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?2475171&101" alt="web counter gratis" border="0"></a></noscript>
<!-- Histats.com  END  -->

<!--G anal-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44428186-2', 'kompetisiindonesia.com');
  ga('send', 'pageview');
</script>






</html>