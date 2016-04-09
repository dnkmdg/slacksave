<article class="presentation">
  <h2><?php echo $p['user_name'] ?> <small><?php echo date('Y-m-d H:i:s',$p['timestamp']) ?></small></h2>
  <p>
  <?php
    $presentation = $p['text'];
    if(substr($presentation, 0,6) == 'intro '):
      $presentation = substr($presentation, 6);
    endif;
    echo nl2br($presentation);
  ?>
  </p>
</article>
