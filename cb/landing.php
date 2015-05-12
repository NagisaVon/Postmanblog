<?php
	include 'core/init.php';
	$row = $GLOBALS['con']->query("SELECT user_id FROM users");
	$user_count = $row->num_rows;
	//die ();
?>
<!DOCTYPE html>
<html lang="zh">
	<head>
		<title>
			CenterBrain
		</title>
		<?php include 'includes/head.php'; ?>
		<script type="text/javascript" name="baidu-tc-cerfication" data-appid="5525242" src="http://apps.bdimg.com/cloudaapi/lightapp.js"></script>
	</head>
	<body>
		<header id="header" class="navbar navbar-fixed-top bg-white-only padder-v" data-spy="affix" data-offset-top="1">
			<div class="container">
				<a class="pull-left thumb-sm avatar">
					<img src="img/logo.png" alt="...">
				</a>
				<div class="navbar-header">
					<button class="btn btn-link visible-xs pull-right m-r" type="button" data-toggle="collapse"
					data-target=".navbar-collapse">
						<i class="fa fa-bars">
						</i>
					</button>
					<a href="#" class="navbar-brand m-r-lg">
						<span class="h3 font-bold">
							CenterBrain
						</span>
					</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav font-bold">
						<li>
							<a href="#features" data-ride="scroll">
								功能
							</a>
						</li>
						<li>
							<a href="#life" data-ride="scroll">
								应用情景
							</a>
						</li>
						<li>
							<a href="#cross-platform" data-ride="scroll">
								跨平台
							</a>
						</li>
						<!--<li>
							<a href="#" data-ride="scroll">
								评论
							</a>
						</li>-->
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<div class="m-t-sm">
								<a href="login.php" class="btn btn-sm btn-default btn-rounded m-l">
									<strong>
										登陆
									</strong>
								</a>
								<a href="register.php" class="btn btn-sm btn-success btn-rounded m-l">
									<strong>
										注册
									</strong>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</header>

		<div id="content">
			<div class="bg-white-only container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<div class="m-t-xxl m-b-xxl padder-v">
							<h1 class="font-bold l-h-1x m-t-xxl text-black padder-v animated fadeInDown">
								做最好的校内互动平台
							</h1>
							<h3 class="text-muted m-t-xl l-h-1x">
								班级公邮、班级博客、题目与试卷、短信通知和家校互动……<br>
								学校中的繁杂事物全部由 CenterBrain 帮您处理。
							</h3>
						</div>

						<p class="text-center m-b-xxl wrapper">
							<a href="login.php"
							target="_blank" class="btn b-2x btn-lg b-black btn-default btn-rounded text-lg font-bold m-b-xxl animated fadeInUpBig">
								登陆
							</a>　
							<a href="register.php"
							target="_blank" class="btn b-2x btn-lg b-black btn-default btn-rounded text-lg font-bold m-b-xxl animated fadeInUpBig">
								注册
							</a>
						</p>
					</div>
				</div>
			</div>
			<div id="features" class="container m-b-xxl padder-v">
				<div class="row no-gutter">
					<div class="col-md-3 col-sm-6">
						<div class="bg-light m-r-n-md no-m-xs no-m-sm">
							<a href="http://www.cwsoft.cc"	target="_blank" class="wrapper-xl block">
								<span class="h3 m-t-sm text-black">
									学生团队开发
								</span>
								<span class="block m-b-md m-t">
									由北京四中学生创办并维护。作为学生，我们最了解校园生活！
								</span>

								<i class="icon-arrow-right text-lg">
									查看“团队”   <!-- maybe can create a part to show our team right in this landing page~ -->
								</i>
							</a>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="bg-black dker m-t-xl m-l-n-md m-r-n-md text-white no-m-xs no-m-sm">
							<div class="wrapper-xl block">    	<!-- used to be a <a> here -->
								<span class="h3 m-t-sm text-white">
									极强的可定制性
								</span>
								<span class="block m-b-md m-t">
									可以为任何一所学校的每一个年级定制，无论分班有多么复杂！
								</span>
								<!-- <i class="icon-arrow-right text-lg">
									查看“定制”  will create #diy later 
								</i> -->
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="bg-light dker m-t-n m-l-n-md m-r-n-md no-m-xs no-m-sm">
							<div href="http://user.qzone.qq.com/2602551804/311" target="_blank" class="wrapper-xl block">  <!-- used to be a <a> here -->
								<span class="h3 m-t-sm text-black"> 
									快速传达信息
								</span>
								<span class="block m-b-md m-t">
									利用 CenterBrain 在师生和家长间极快地传递信息。将取代飞信、邮件和家校互动短信平台。
								</span>
								<!-- <i class="icon-arrow-right text-lg">
									查看“短信平台”
								</i> -->
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="bg-white m-t m-l-n-md no-m-xs no-m-sm">
							<div href="register.php" target="_blank" class="wrapper-xl block">
								<span class="h3 m-t-sm text-black">
									展示自己的风采
								</span>
								<span class="block m-b-md m-t">
									您可以利用 CenterBrain 的博客系统轻松建立班级博客或发布你自己的作品。这里将是一个校园自媒体的汇集地！
								</span> <!-- 既然这样说， 外人就应该也能不注册账号地访问 我们的article系统！-->
								<!-- <i class="icon-arrow-right text-lg">
								</i> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="life" class="bg-light">
				<div class="container">
					<div class="row m-t-xl m-b-xxl">
						<div class="col-sm-6" data-ride="animated" data-animation="fadeInLeft"
						data-delay="300">
							<div class="m-t-xxl">
								<div class="m-b">
									<a href class="pull-left thumb-sm avatar">
										<img src="img/logo.png" alt="...">
									</a>
									<div class="m-l-sm inline">
										<div class="pos-rlt wrapper b b-light r r-2x">
											<span class="arrow left pull-up">
											</span>
											<p class="m-b-none">
												Hey!
											</p>
										</div>
										<small class="text-muted">
											<i class="fa fa-ok text-success">
											</i>
											1 hour ago
										</small>
									</div>
								</div>
								<div class="m-b text-right">
									<a href class="pull-right thumb-sm avatar">
										<img src="img/logo.png" class="img-circle" alt="...">
									</a>
									<div class="m-r-sm inline text-left">
										<div class="pos-rlt wrapper bg-primary r r-2x">
											<span class="arrow right pull-up arrow-primary">
											</span>
											<p class="m-b-none">
												Hi CW, What's up...
											</p>
										</div>
										<small class="text-muted">
											31 minutes ago
										</small>
									</div>
								</div>
								<div class="m-b">
									<a href class="pull-left thumb-sm avatar">
										<img src="img/logo.png" alt="...">
									</a>
									<div class="m-l-sm inline">
										<div class="pos-rlt wrapper b b-light r r-2x">
											<span class="arrow left pull-up">
											</span>
											<p class="m-b-none">
												Have been working on the updates for many hours...
											</p>
										</div>
										<small class="text-muted">
											<i class="fa fa-ok text-success">
											</i>
											2 minutes ago
										</small>
									</div>
								</div>
								<div class="m-b text-right">
									<a href class="pull-right thumb-sm avatar">
										<img src="img/logo.png" class="img-circle" alt="...">
									</a>
									<div class="m-r-sm inline text-left"> 
										<div class="pos-rlt wrapper bg-info r r-2x">
											<span class="arrow right pull-up arrow-info">
											</span>
											<p class="m-b-none">
												Can not wait to see it:)
											</p>
										</div>
										<small class="text-muted">
											1 minutes ago
										</small>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 wrapper-xl">
							<h3 class="text-dark font-bold m-b-lg">
								节省你的时间，把时间花在真正有用的地方
							</h3>
							<ul class="list-unstyled	m-t-xl">
								<li data-ride="animated" data-animation="fadeInUp" data-delay="600">
									<i class="icon-check pull-left text-lg m-r m-t-sm">
									</i>
									<p class="clear m-b-lg">
										<strong>
											Using Less
										</strong>
										, Angulr's CSS is built on Less, a preprocessor with additional functionality
										like variables, mixins, and functions for compiling CSS.
									</p>
								</li>
								<li data-ride="animated" data-animation="fadeInUp" data-delay="900">
									<i class="icon-check pull-left text-lg m-r m-t-sm">
									</i>
									<p class="clear m-b-lg">
										<strong>
											Grunt Task
										</strong>
										, Angulr using Grunt to automate development tasks, like compiling less
										to css, concatenating and minifying js files...
									</p>
								</li>
								<li data-ride="animated" data-animation="fadeInUp" data-delay="1100">
									<i class="icon-check pull-left text-lg m-r m-t-sm">
									</i>
									<p class="clear m-b-lg">
										<strong>
											Bower Package
										</strong>
										, fetching and installing packages from all over, finding, downloading,
										and saving the stuff you’re looking for.
									</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--
			<div id="cross-platform" class="bg-white-only">
				<div class="container">
					<div class="row m-t-xl m-b-xxl">
						<div class="col-sm-6 wrapper-xl">
							<h3 class="text-black font-bold m-b-lg">
								适用于所有设备
							</h3>
							<p class="h4 l-h-1x">
								不管是PC、手机、平板还是“其他”，都可以使用CenterBrain。
							</p>
						</div>
						<div class="col-sm-6" data-ride="animated" data-animation="fadeInLeft"
						data-delay="300">
							<div class="m-t-xxl text-center">
								<span class="text-2x text-muted">
									<i class="icon-screen-smartphone text-2x">
									</i>
								</span>
								<span class="text-3x text-muted">
									<span class="text-2x">
										<i class="icon-screen-desktop text-2x">
										</i>
									</span>
								</span>
								<span class="text-3x text-muted">
									<i class="icon-screen-tablet text-2x">
									</i>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			-->
			<div id="cross-platform" class="bg-white-only">
				<div class="container">
					<div class="row m-t-xl m-b-xxl">
						<div class="col-sm-6" data-ride="animated" data-animation="fadeInLeft" data-delay="300">
							<div class="m-t-xxl text-center">
								<p>
									<a target="_blank" class="text-sm btn btn-lg btn-rounded btn-default m-sm">
										<i class="fa fa-apple fa-3x pull-left m-l-sm"></i>
										<span class="block clear m-t-xs text-left m-r m-l">
											iOS
											<b class="text-lg block font-bold">
												开发中　
											</b>
										</span>
									</a>
								</p>
								<p>
									<a target="_blank" class="text-sm btn btn-lg btn-rounded btn-default m-sm">
										<i class="fa fa-android fa-3x pull-left m-l-sm"></i>
										<span class="block clear m-t-xs text-left m-r m-l">
											Android 
											<b class="text-lg block font-bold">
												开发中　
											</b>
										</span>
									</a>
								</p>
							</div>
						</div>
						<div class="col-sm-6 wrapper-xl">
							<h3 class="text-black font-bold m-b-lg">
								传说中的手机客户端
							</h3>
							<p class="h4 l-h-1x">
								手机客户端正在开发中。经常使用手机的用户可以通过浏览器访问CenterBrain。
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-black dker clearfix">
				<div class="container m-t-xxl m-b-xxl padder-v">
					<div class="carousel auto slide clearfix">
						<div class="carousel-inner text-center m-t-xl m-b-xl">
							<div class="col-sm-6 col-sm-offset-3 m-b-xl">
								<h4 class="font-thin l-h-2x text-white m-b-lg"><em>“只要用了CenterBrain，不用多久，我就会升职加薪、当上总经理、出任CEO、迎娶白富美、走上人生巅峰，想想还有点小激动呢嘿嘿”</em></h4>
								<p class="text-muted">- 王大锤</p>
							</div>
						</div>
					</div>
				</div>
			</div>

	</div>
		</div>

			<!-- footer -->
			<footer>
				<div class="bg-info">
					<div class="container">
						<div class="row m-t-xl m-b-xl">
							<div class="col-sm-6 text-white text-center">
								<h4 class="m-b">
									心动了吗？心动不如行动！
								</h4>
							</div>
							<div class="col-sm-6 text-center">
								<a href="register.php" class="btn btn-lg btn-default btn-rounded">
									立即注册
								</a>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<?php
				include 'includes/footer-landing.php';
			?>
			<!-- /footer -->

			<script src="js/bootstrap.min.js"></script>
			<script src="js/jquery.appear.js"></script>
			<script src="js/landing.js"></script>
	</body>
</html>