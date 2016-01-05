<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="css/style.css" media="screen" rel="stylesheet" type="text/css"/>
<title>新增題目</title>
</head>
<body>
<!-- header -->
<div class="header">
	<div class="wrap">
		<h1 class="logo"><a href="index.php"></a></h1>
		<!-- 會員選單 -->
		<!--
		<ul class="account-nav">
			<li><a href="#" class="apply">申請會員</a></li>
			<li><a href="#" class="login">會員登入</a></li>
		</ul>
		-->
		<!-- 會員選單 -->
		<!-- 導覽列 -->
		<div class="nav">
			<ul>
				<?php if (empty($_GET["page"])) { ?>
					<li class="current"><a href="index.php">首頁</a></li>
			  <?php } else { ?>
			  	<li><a href="index.php">首頁</a></li>
			  <?php } ?>
			  <?php if ($_GET["page"]=="search") { ?>
					<li class="current"><a href="search.php?page=search">搜尋題目</a></li>
			  <?php } else { ?>
			  	<li><a href="search.php?page=search">搜尋題目</a></li>
			  <?php } ?>
				
				<!--<li><a href="#">客戶資料</a></li>
				<li><a href="#">目標設定</a></li>
				<li><a href="#">保險資料庫</a></li>
				<li><a href="#">訂閱頻道</a></li>
				<li><a href="#">設定</a></li> 
				-->
			</ul>
		</div>
		<!-- /導覽列 -->
	</div>
</div>
<!-- /header -->
<!-- breadcrumbs -->
<div class="breadcrumbs">
	<div class="wrap">
		<a href="index.php" class="index">首頁</a><span class="sp"></span>
		<?php if ($_GET["page"]=="search") { ?>
			搜尋題目
		<?php } else { ?>
			新增題目
		<?php } ?>
	</div>
</div>
<!-- breadcrumbs -->