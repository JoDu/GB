<?php
include_once("include/db.php");
include_once("include/func_category.php");
$conn_ategory = new Category();

//print_r($_POST);
//exit;

$postCategory = $_POST["jcategory"];
$postSubject = $_POST["jsubject"];
$postChapter = $_POST["jchapter"];
$postSection = $_POST["jsection"];
$postPart = $_POST["jpart"];
$postItem = $_POST["jitem"];
$postExam = $_POST["jexam"];
$submitType = $_POST["submitType"];

if (!empty($postItem) || !empty($postExam)) {
	$search_result = $conn_ategory->getQuestionList('','','','','',$postExam,'',$postItem);
} else {
	$return_mesg = "資料不齊全!";
}


?>
<?php include_once("include/header.php");?>
<!-- container -->
<div class="container">
	<!-- widget -->
	<div class="widget customer">
		<div class="hd">
			<h2>題目列表</h2>
		</div>
		<div class="body">
			<!-- content -->
			<div class="content">
				<!-- data-customer -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data-1">
				  <tr>
					<th scope="col" width="80%">題目</th>
					<th scope="col" width="20%">輸入時間</th>
				  </tr>
				  <?php foreach ($search_result as $key => $val) { ?>
					  <tr>
						<td><a href="question.php?page=search&amp;q=<?php echo $val["question_id"];?>" class="question"><?php echo $val["question"];?></a></td>
						<td><?php echo $val["timestamp"];?></td>
					  </tr>
					<?php } ?>
				</table>
				<!-- data-customer -->
				<!-- pagination -->
				<div class="pagination">
					<a href="#">«</a>
					<a href="#">1</a>
					<a href="#" class="current">2</a>
					<a href="#">3</a>
					<a href="#">4</a>
					<a href="#">5</a>
					<a href="#">»</a> 
				</div>
				<!-- pagination -->
			</div>
			<!-- /content -->
		</div>
	</div>
	<!-- /widget -->
</div>
<!-- /container -->
<?php include_once("include/footer.php");?>