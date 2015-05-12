<?php
  if (isset ($_GET['user_id']) && isset ($_GET['page']) && isset ($_GET['type'])) {
    include 'core/init.php';
    $page = (int) $_GET['page'];
    if ($_GET['type'] == 'all') {
      $all_albums = album_id_from_user ($_GET['user_id']);
    } else {
      $all_albums = album_id_from_user_by_type ($_GET['user_id'], $_GET['type']);
    }
    $album_num = count ($all_albums);
    $page_num = 10;
    $min = ($page - 1) * $page_num;
    $max = $page * $page_num;
    if ($album_num >= $min) {
      ?>
      <ul class="list-group list-group-lg no-radius m-b-none m-t-n-xxs">
      <?php
      $to = ($max < $album_num) ? $max : $album_num;
      for ($i = $min; $i < $to; $i++) {
        $album_data = album_data ($all_albums[$i], 'id', 'name', 'note', 'type', 'datetime', 'img');
        $id = $album_data['id'];
        ?>
        <li class="list-group-item clearfix b-l-3x b-l-info">
          <div class="pull-right text-sm text-muted">
            <span class="hidden-xs"><?php echo $album_data['datetime']; ?></span>
            <i class="fa fa-paperclip m-l-sm"></i>
          </div>
          <div class="clear">
            <div><a class="text-md" href="album.php?id=<?php echo $id; ?>"><?php echo $album_data['name']; ?></a><span class="label bg-light m-l-sm "><?php echo $h_album_type[$album_data['type']]; ?></span></div>
            <div class="text-ellipsis m-t-xs"><?php echo $album_data['note']; ?></div>
          </div>
        </li>
      <?php } ?>
      </ul>
    <?php
    }
  }
?>