<?php
	function chat_data ($id) {
		$data = array();
		$id = (int) $id;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM chats WHERE id='$id'"));
			return $data;
		}
	}

	function new_chat ($homework_data) {
		array_walk ($homework_data, 'array_sanitize');
		$fields = implode (',', array_keys ($homework_data));
		$data = '\'' . implode ('\', \'', $homework_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO chats ($fields) VALUES ($data)");
	}

	function display_messages0 ($ida, $idb) {
		$ida = (int) $ida;
		$idb = (int) $idb;
		$result = $GLOBALS['con']->query ("SELECT id, user_id, to_id, text FROM chats WHERE type='0'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			if (($row['user_id'] == $ida && $row['to_id'] == $idb) || ($row['user_id'] == $idb && $row['to_id'] == $ida)) {
				$udata = user_data($row['user_id'], 'nickname');
				?>
				<span><?php echo $udata['nickname']; ?></span> says :<br/>
				<span><?php echo $row['text']; ?></span><br/>
				<?php
			}
		}
		return $rows;
	}

	function display_messages1 ($user_id) {
		$result = $GLOBALS['con']->query ("SELECT id, user_id, text, datetime FROM chats WHERE type='1'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			$udata = user_data($row['user_id'], 'nickname');
			?>
			<?php if ($user_id == $row['user_id']) { ?>
			<div class="m-b text-right">
				<div class="m-r-sm inline text-left">
					<div class="pos-rlt btn-lg bg-info r r-2x">
						<span class="arrow right pull-up arrow-info">
						</span>
						<p class="m-b-none">
							<?php echo $row['text']; ?>
						</p>
					</div>
					<small class="text-muted">
						<?php echo $row['datetime']; ?>
					</small>
				</div>
			</div>
			<?php } else { ?>
			<div class="m-b">
				<a href class="pull-left thumb">
					<?php echo $udata['nickname']; ?>
				</a>
				<div class="m-l-sm inline">
					<div class="pos-rlt btn-lg btn-default r r-2x">
						<span class="arrow left pull-up">
						</span>
						<p class="m-b-none">
							<?php echo $row['text']; ?>
						</p>
					</div>
					<small class="text-muted">
						<i class="fa fa-ok text-success">
						</i>
						<?php echo $row['datetime']; ?>
					</small>
				</div>
			</div>
			<?php } ?>
			<?php
		}
		return $rows;
	}
	function test_sql () {
		$GLOBALS['con']->query ("INSERT INTO `chats` (`id`, `user_id`, `to_id`, `type`, `text`, `datetime`) VALUES (NULL, '8', '5', '0', 'Test Message', '2015-03-10 12:27:38')");
	}
?>