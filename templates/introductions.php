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
    <div class="meta">
      <div class="meta__update">
        <span class="meta__update__year">
          <?php echo date('Y', $p['timestamp']); ?>
        </span>
        <span class="meta__update__date">
          <?php echo date('m / d', $p['timestamp']); ?>
        </span>
        <span class="meta__update__time">
          <?php echo date('H:i', $p['timestamp']); ?>
        </span>
      </div>
    </div>
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

