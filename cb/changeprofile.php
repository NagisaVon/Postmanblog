<?php
  include 'core/init.php';
  protect_D1 ();
  $profile_page = $GLOBALS['web_url'] . '/' . $user_data['user_id'];
  $nickname_empty = false;
  $nickname = trim (sanitize ($user_data['nickname']));
  $email = trim (sanitize ($user_data['email']));
  $p_math = $user_data['p_math'];
  $p_english = $user_data['p_english'];
  $p_normal = $user_data['p_normal'];
  if (isset ($_POST['submit1'])) {
    $email = trim (sanitize ($_POST['email']));
    $nickname = trim (sanitize ($_POST['nickname']));
    if ($nickname === "") {
      $nickname_empty = true;
    } else {
      change_profile ($session_user_id, $nickname, $email);
    }
  } else if (isset ($_POST['submit2'])) {
    change_profile_class ($session_user_id, $_POST['p_normal'], $_POST['p_math'], $_POST['p_english']);
  }
?>
<script type="text/javascript">
  function submit1() {
    $.ajax({
      type:'POST',
      url:'changeprofile.php',
      //data:"ChatText=HEHE&user_id=8&to_id=5&type=0",
      data:"&submit1=1&nickname=" + nickname.value + "&email=" + email.value,
      success:function(){
        header_nickname.innerHTML = aside_nickname.innerHTML = nickname.value;
        header_email.innerHTML = aside_email.innerHTML = email.value;
        $('#content').load("changeprofile.php");
        alertify.success("个人信息修改成功");
      }
    });
  }
  function submit2() {
    $.ajax({
      type:'POST',
      url:'changeprofile.php',
      //data:"ChatText=HEHE&user_id=8&to_id=5&type=0",
      data:"&submit2=1&p_normal=" + p_normal.value + "&p_math=" + p_math.value + "&p_english=" + p_english.value,
      success:function(){
        $('#content').load("changeprofile.php");
        alertify.success("分班修改成功");
      }
    });
  }
  function submit3() {
    $.ajax({
      type:'POST',
      url:'check_id_code.php',
      //data:"ChatText=HEHE&user_id=8&to_id=5&type=0",
      data:"&submit3=1&id_code=" + id_code.value,
      success:function(data){
        if (data == "1") {
          location.replace('index.php');
        } else {
          alertify.error("激活码错误！");
        }
      }
    });
  }
</script>
<div class="app-content-body">
  <div class="wrapper-md">
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">
          个人信息
        </div>
        <div class="panel-body form-horizontal">
          <div class="form-group">
            <label class="col-sm-3 control-label">昵称：</label>
            <div class="col-sm-8">
              <input id="nickname" type="text" class="form-control rounded" placeholder="你的昵称（不得为空）" required  value="<?php echo $nickname; ?>">
            </div>
            <font color="red"><?php if($nickname_empty) { echo "　·昵称不得为空"; } ?></font>
            <div class="col-sm-1">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">邮箱：</label>
            <div class="col-sm-8">
              <input id="email" type="email" class="form-control rounded" placeholder="输入有效邮箱（不得为空）" required  value="<?php echo $email; ?>">
            </div>
            <div class="col-sm-1">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">主页：</label>
            <div class="col-sm-8">
              <a class="btn btn-default" href="<?php echo $profile_page; ?>"><font color="#6C63A8"><?php echo $profile_page; ?></font></a>
            </div>
            <div class="col-sm-1">
            </div>
          </div>
          <div class="line line-dashed b-b line-lg pull-in"></div>
          <div class="form-group">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
              <button onclick="submit1();" class="btn btn-block m-b-lg btn-info btn-rounded">修改</button>
            </div>
            <div class="col-sm-3">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">
          分层班级
        </div>
        <div class="panel-body form-horizontal">
          <div class="form-group">
            <label class="col-sm-3 control-label">行政：</label>
            <div class="col-sm-8">
              <select id="p_normal" class="form-control">
                <?php include 'config/class.normal.php'; ?>
              </select>
              <script>
                document.getElementById("p_normal").value = <?php echo $p_normal; ?>
              </script>
            </div>
            <div class="col-sm-1">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">数学：</label>
            <div class="col-sm-8">
              <select id="p_math" class="form-control">
                <?php include 'config/class.math.php'; ?>
              </select>
              <script>
                document.getElementById("p_math").value = <?php echo $p_math; ?>
              </script>
            </div>
            <div class="col-sm-1">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">英语：</label>
            <div class="col-sm-8">
              <select id="p_english" class="form-control">
                <?php include 'config/class.english.php'; ?>
              </select>
              <script>
                document.getElementById("p_english").value = <?php echo $p_english; ?>
              </script>
            </div>
            <div class="col-sm-1">
            </div>
          </div>
          <div class="line line-dashed b-b line-lg pull-in"></div>
          <div class="form-group">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
              <button onclick="submit2()" class="btn btn-block m-b-lg btn-info btn-rounded">修改</button>
            </div>
            <div class="col-sm-3">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">
          修改权限
        </div>
        <div class="panel-body form-horizontal">
          <div class="form-group">
            <label class="col-sm-3 control-label">激活码：</label>
            <div class="col-sm-8">
              <input type="text" id="id_code" class="form-control" placeholder="输入有效激活码" />
            </div>
            <div class="col-sm-1">
            </div>
          </div>
          <div class="line line-dashed b-b line-lg pull-in"></div>
          <div class="form-group">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
              <button onclick="submit3()" type="submit" class="btn btn-block m-b-lg btn-info btn-rounded">修改</button>
            </div>
            <div class="col-sm-3">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">
          <?php echo $h_normal[$user_data['p_normal']]; ?>的同学们
        </div>
        <?php
          $temple = '<a class="btn btn-rounded" href="' . $GLOBALS['web_url'] . '/';
          $rows = $GLOBALS['con']->query("SELECT user_id, nickname, p_normal FROM users");
          while ($row = $rows->fetch_assoc ()) {
            if ($row['p_normal'] == $user_data['p_normal']) {
              echo $temple . $row['user_id'] . '">' . $row['nickname'] . '</a>';
            }
          }
        ?>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">
          数学<?php echo $h_math[$user_data['p_math']]; ?>班的同学们
        </div>
        <?php
          $temple = '<a class="btn btn-rounded" href="' . $GLOBALS['web_url'] . '/';
          $rows = $GLOBALS['con']->query("SELECT user_id, nickname, p_math FROM users");
          while ($row = $rows->fetch_assoc ()) {
            if ($row['p_math'] == $user_data['p_math']) {
              echo $temple . $row['user_id'] . '">' . $row['nickname'] . '</a>';
            }
          }
        ?>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">
          英语<?php echo $h_english[$user_data['p_english']]; ?>班的同学们
        </div>
        <?php
          $temple = '<a class="btn btn-rounded" href="' . $GLOBALS['web_url'] . '/';
          $rows = $GLOBALS['con']->query("SELECT user_id, nickname, p_english FROM users");
          while ($row = $rows->fetch_assoc ()) {
            if ($row['p_english'] == $user_data['p_english']) {
              echo $temple . $row['user_id'] . '">' . $row['nickname'] . '</a>';
            }
          }
        ?>
      </div>
    </div>
  </div>
</div>