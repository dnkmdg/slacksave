<article class="presentation">
  <div class="media">
    <img src="<?php echo $p['user_avatar'] ?>" alt="<?php echo $p['user_name'] ?>'s avatar" title="<?php echo $p['user_name'] ?>">
  </div>
  <div class="content">
    <h2>@<?php echo $p['user_name'] ?></h2>
    <h5>Uppdaterades <?php echo date('Y-m-d H:i:s',$p['timestamp']) ?></h2>
    <p>
    <?php
      $presentation = $p['text'];
      if(substr($presentation, 0,6) == 'intro '):
        $presentation = substr($presentation, 6);
      endif;
      echo nl2br($presentation);
    ?>
    </p>
  </div>
</article>
