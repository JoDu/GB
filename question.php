<?php
include_once("include/db.php");
include_once("include/func_category.php");
$conn_ategory = new Category();

/*
if($_POST["submitType"] == "addExam"){
	header('Location: '.$ROOTURL.'question_add.php?item_id='.$_POST["jitem"]);
	exit;
}
*/
//print_r($_POST);exit;

$page_title = "題目內容";

if (!empty($_GET["q"])) {
	$question_id = $_GET["q"];
	$question_result = $conn_ategory->getQuestionList($question_id,'','','','','','','');
	$exam_id = $question_result[0]["exam_id"];
	$item_id = $question_result[0]["item_id"];
	$item_result = $conn_ategory->getItemList($item_id);
	$exam_result = $conn_ategory->getExamList($exam_id);
} else {
	$return_mesg = "資料不齊全!";
}

?>
<?php include_once("include/header.php");?>
<form name="myForm" action="question_add.php?page=search" method="post">
	<div class="container">
		<div class="widget customer">
			<div class="hd">
				<h2><?php print $page_title;?></h2>
			</div>
			<div class="body">
				<div class="form-edit">
					<div class="control-group">
						<?php if (empty($return_mesg)) { ?>
							<div class="control-group">
								<label class="control-label">題目</label>
								<div class="controls"><?php print $question_result[0]["question"];?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">答案</label>
								<div class="controls"><?php print $question_result[0]["answer"];?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">解析</label>
								<div class="controls"><?php print $question_result[0]["resolution"];?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">關鍵字</label>
								<div class="controls"><?php print $question_result[0]["keyword"];?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">考試種類</label>
								<div class="controls"><?php print $exam_result[0]["exam_name"];?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">年份</label>
								<div class="controls"><?php print $question_result[0]["year"];?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">項目</label>
								<div class="controls"><?php print $item_result[0]["item_name"];?></div>
							</div>
							<div class="btn-box-1">
								<button type="submit" name="submitType" value="editQuestion" class="btn red">修改</button>
							</div>
							<input type="hidden" name="postQ" value="<?php print $question_id;?>">
						<?php } else { ?>
							<?php print $return_mesg;?>
						<?php } ?>
				  </div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php include_once("include/footer.php");?>