<!--
#######################################################
# Sistemi Oluşturan: Hasan Atılan                     #
# https://tsbakkali.net  / https://ts3.web.tr         #
# GOOGLE MAPS APİ İle Yapılmıştır                     #
#######################################################
-->


<?php
$cfg = require_once("ayarlar.php");
?>

<html>
  <head>
    <title><?php echo $cfg->Ayarlar->Baslik; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="tsb.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var loadCounter = 0;
        var loadMap = setInterval(function() {
          $.get('harita.php', function (data) {
              $('#pageContent').html(data);
          });
          loadCounter ++;
          if(loadCounter >= 2){
            clearInterval(loadMap);
          }
        }, 0);

        <?php if($cfg->Ayarlar->aktiflik): ?>
        setInterval(function() {
            $.get('harita.php', function (data) {
                $('#pageContent').html(data);
            });
        }, <?php echo $cfg->Ayarlar->otoyenileme; ?>000);

        var counter = <?php echo $cfg->Ayarlar->otoyenileme; ?>;
        var interval = setInterval(function() {
          counter--;
          $("#countdownText").html('Otomatik Yenileme: ' + counter + 's');
          if (counter == 0) {
            counter = <?php echo $cfg->Ayarlar->otoyenileme; ?>;
          }
        }, 1000);
        <?php endif; ?>
      });
    </script>
    <style>
      body {
        background-color: #f6f8f9;
      }
      .pageWidth {
        position: fixed;
        left: 50%;
        transform: translateX(-50%);
      }
      h3 {
        font-size: 13px;
        color: rgb(83, 83, 83);
        background-color: rgb(250, 250, 250);
        padding: 8px;
        margin-bottom: 0px;
        border: 1px solid rgb(226, 226, 226);
        border-radius: 2px;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
        font-weight: 600;
        font-family: 'Open Sans', Helvetica, Arial, sans-serif;
        cursor: default;
      }
      a:link, a:visited, a:hover, a:active {
        font-size: 13px;
        color: rgb(83, 83, 83);
        text-decoration: none;
        font-weight: 600;
        font-family: 'Open Sans', Helvetica, Arial, sans-serif;
        cursor: auto;
      }
    </style>
  </head>
  <body>
    <div class="pageWidth">
      <h3>TeamSpeak Online Harita: <a href="ts3server://<?php echo $cfg->TsBilgiler->host; ?>?port=<?php echo $cfg->TsBilgiler->port; ?>"><?php echo $cfg->TsBilgiler->host; ?></a></h3>
      <div id="pageContent" style="width: 902px; height: 500px;"></div>
      <?php if($cfg->Ayarlar->aktiflik): ?><h3 id="countdownText" style="text-align: center;">Otomatik Yenileme: <?php echo $cfg->Ayarlar->otoyenileme; ?>s</h3><?php endif; ?>
	  
	  <h3 id="countdownText" style="text-align: center;">Geliştirici TSBAKKALİ.NET </h3>
      
    </div>
  </body>
</html>
