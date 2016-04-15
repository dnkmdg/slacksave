<?php
  foreach($slack->get_posts($_GET['channel'],true) as $p):
?>
<article class="presentation">
  <div class="media">
    <img src="<?php echo $p['user_avatar'] ?>" alt="<?php echo $p['user_name'] ?>'s avatar" title="<?php echo $p['user_name'] ?>">
  </div>
  <div class="content">
    <h2>@<?php echo $p['user_name'] ?></h2>
    <h5>Uppdaterades <?php echo date('Y-m-d H:i:s',$p['timestamp']) ?></h2>
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
