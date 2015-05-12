<head><meta charset="utf-8"></head>
<?php
	include 'core/init.php';

	if (logged_in ()) {
		if ($user_data['type'] < 2) {
			header ('Location: index.php');
		}
	} else {
		header ('Location: index.php');
	}

	$teachmath = $teachenglish = $success = false;
	if (isset ($_POST['add_id_code'])) {
		if (!isset ($_POST['c_subject'])) {
			?><script type="text/javascript">alert ('请选择任教学科');</script><?php
		} else {
			$c_subject = $_POST['c_subject'];
			if ($_POST['type'] != 2) {
				if (isset ($_POST['c_math'])) {
					$classes = $_POST['c_math'];
				} else if (isset ($_POST['c_english'])) {
					$classes = $_POST['c_english'];
				} else if (isset ($_POST['c_normal'])) {
					$classes = $_POST['c_normal'];
				}
				array_walk($classes, "array_to_int");
			}
			if ($_POST['type'] != 2 && $c_subject == 1 && !isset ($_POST['c_math'])) {
				?><script type="text/javascript">alert ('请选择所任教数学的分层班级');</script><?php
			} else if ($_POST['type'] != 2 && $c_subject == 2 && !isset ($_POST['c_english'])) {
				?><script type="text/javascript">alert ('请选择所任教英语的分层班级');</script><?php
			} else if ($_POST['type'] != 2 && $c_subject != 1 && $c_subject != 2 && !isset ($_POST['c_normal'])) {
				?><script type="text/javascript">alert ('请选择所任教的班级');</script><?php
			} else {
				$note = "";
				if (isset ($_POST['note'])) {
					$note = $_POST['note'];
				}
				//add id code
				$code_data = array(
				'id_code'  => rand (100000583, 999991843),
				'subject'  => $c_subject,
				'class'    => ($_POST['type'] != 2) ? serialize ($classes) : "",
				'type'     => $_POST['type'],
				'diclass'  => $_POST['diclass'],
				'used'     => 0,
				'note'     => $note
					);
				add_id_code ($code_data);
				echo '添加成功，新注册码：' . $code_data['id_code'] . "<p />";
				?><script type="text/javascript">alert ('添加成功');</script><?php
				unset ($_POST);
				//exit ();
			}
		}
	}
?>
<html>
	<head>
		<title>
			Admin | CenterBrain
		</title>
		<script type="text/javascript">
			function visibles() {
				var cmath = document.getElementById('1');
				var cenglish = document.getElementById('2');
				var fmath = document.getElementById('FrmMath');
				var fenglish = document.getElementById('FrmEnglish');
				var fnormal = document.getElementById('FrmNormal');
				fmath.style.display = fenglish.style.display = fnormal.style.display = "none";
				if (cmath.checked) {
					fmath.style.display = "block";
				} else if (cenglish.checked) {
					fenglish.style.display = "block";
				} else {
					fnormal.style.display = "block";
				}
			}
			function init() {
				var first_item = document.getElementById('0');
				first_item.checked = true;
				visibles();
			}
		</script>
	</head>
	Sorry~~这里的美工消失了。。。
	<body onLoad="init()">
		<form action="admin.php" method="POST">
			<h2>Add Id Code</h2>
			学科：
			<?php
				$temple = '<label><input name="c_subject" onClick="visibles()" type="radio" value="';
				$str = "";
				foreach ($h_subject as $key => $value) {
					$str = $str . $temple . $key . '" Id="' . $key . '" />' . $value . ' </label>';
				}
				unset ($key);
				unset ($value);
				unset ($temple);
				echo $str;
				unset ($str);
			?>
			<div id="FrmMath" hidden>
				选择数学分班：
				<?php
					$temple = '<label><input name="c_math[]" onClick="visibles()" type="checkbox" value="';
					$str = "";
					foreach ($a_math as $key => $value) {
						$str = $str . $temple . $key . '" />' . $value . ' </label>';
					}
					unset ($key);
					unset ($value);
					unset ($temple);
					echo $str;
					unset ($str);
				?>
			</div>
			<div id="FrmEnglish" hidden>
				选择英语分班：
				<?php
					$temple = '<label><input name="c_english[]" onClick="visibles()" type="checkbox" value="';
					$str = "";
					foreach ($a_english as $key => $value) {
						$str = $str . $temple . $key . '" />' . $value . ' </label>';
					}
					unset ($key);
					unset ($value);
					unset ($temple);
					echo $str;
					unset ($str);
				?>
			</div>
			<div id="FrmNormal">
				选择班级：
				<?php
					$temple = '<label><input name="c_normal[]" onClick="visibles()" type="checkbox" value="';
					$str = "";
					foreach ($a_normal as $key => $value) {
						$str = $str . $temple . $key . '" />' . $value . ' </label>';
					}
					unset ($key);
					unset ($value);
					unset ($temple);
					echo $str;
					unset ($str);
				?>
			</div>
			<p />
			其他：
			<label>
				<input name="type" value="0" type="radio" checked />
				无
			</label>
			<label>
				<input name="type" value="1" type="radio" />
				班主任
			</label>
			<label>
				<input name="type" value="2" type="radio" />
				班长
			</label>
			<?php
				$temple = '<option value="';
				$str = '<select name="diclass">';
				foreach ($a_normal as $key => $value) {
					$str = $str . $temple . $key . '">' . $value . ' </option>';
				}
				unset ($key);
				unset ($value);
				unset ($temple);
				echo $str . '</select>';
				unset ($str);
			?>
			<p />
			备注（可选）：<input type="text" name="note" />
			<p />
			<input type="submit" value="提交" name="add_id_code">
			<input type="reset" value="重置" onClick="">
		</form>
	</body>
</html>