<h4>
  我的任教：
</h4>
<div class="col-sm-12">
  学科：
</div>
<div class="col-sm-12">
  <label class="i-checks">
    <input type="checkbox" name="subject" value="1"><i></i>语文　
  </label>
  <label class="i-checks">
    <input type="checkbox" name="subject" value="2"><i></i>数学　
  </label>
  <label class="i-checks">
    <input type="checkbox" name="subject" value="3"><i></i>英语　
  </label>
  <label class="i-checks">
    <input type="checkbox" name="subject" value="4"><i></i>物理　
  </label>
  <label class="i-checks">
    <input type="checkbox" name="subject" value="5"><i></i>历史　
  </label>
  <label class="i-checks">
    <input type="checkbox" name="subject" value="6"><i></i>地理　
  </label>
  <label class="i-checks">
    <input type="checkbox" name="subject" value="7"><i></i>生物　
  </label>
  <label class="i-checks">
    <input type="checkbox" name="subject" value="8"><i></i>政治　
  </label>
  <label class="i-checks">
    <input type="checkbox" name="subject" value="9"><i></i>心理　
  </label>
  <label class="i-checks">
    <input type="checkbox" name="subject" value="10"><i></i>体育　
  </label>
  <label class="i-checks">
    <input type="checkbox" name="subject" value="11"><i></i>阅读　
  </label>
</div>
<div class="col-sm-12">
  其他：
</div>
<div class="col-sm-12">
  <label class="i-checks">
    <input type="checkbox" name="subject" value="1"><i></i>我是班主任
  </label>
</div>




      if (iabs ($uday) > 7 || ($uday > 0 && $nday > date ('N')) || ($uday < 0 && $nday < date ('N'))) {
        $str = ($uday > 0) ? $h_week['1'] : $h_week['-1'];
      }