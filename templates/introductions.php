<?php
  foreach($slack->get_posts($_GET['channel'],true) as $p):
?>
<article class="presentation">
  <?php if(!empty($p['user_avatar'])) : ?>
    <div class="media">
      <img src="<?php echo $p['user_avatar'] ?>" alt="<?php echo $p['user_name'] ?>'s avatar" title="<?php echo $p['user_name'] ?>">
    </div>
  <?php endif; ?>
  <div class="content">
    <div class="header">
      <h2>@<?php echo $p['user_name'] ?></h2>
    </div>
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
