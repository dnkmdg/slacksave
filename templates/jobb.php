<?php
  foreach($slack->get_posts($_GET['channel']) as $p):
?>
<article class="presentation">
  <strong><em>@<?php echo $p['user_name'] ?> tipsade om:</em></strong>
  <div class="content">

    <small>Uppdaterades <?php echo date('Y-m-d H:i:s',$p['timestamp']) ?></small>
    <p>
    <?php
      echo Slacker::format_text($p['text']);
    ?>
    </p>
  </div>
</article>
<?php
  endforeach;
?>
