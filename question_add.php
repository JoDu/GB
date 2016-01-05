<?php
include_once("include/db.php");
include_once("include/func_category.php");
$conn_ategory = new Category();

//print_r($_POST);exit;

if($_POST["submitType"] == "editQuestion"){
	$page_title = "修改題目";
	$question_id = $_POST["postQ"];
	$question_result = $conn_ategory->getQuestionList($question_id,'','','','','','','');
	$exam_id = $question_result[0]["exam_id"];
	$item_id = $question_result[0]["item_id"];
	$item_result = $conn_ategory->getItemList($item_id);
	$exam_result = $conn_ategory->getExamList($exam_id);
}
?>
<?php include_once("include/header.php");?>
<form name="myForm" action="category_add.php" method="post">
<div class="container">
	<div class="widget add-customer">
		<div class="body">
			<div class="form-edit">
      	<div class="title">
					<h3 class="icon-info"><?php print $page_title;?></h3>
				</div>
	
				<div class="control-group">
					<label class="control-label">題目</label>
					<div class="controls">
						<input type="text" name="question" value="<?php print $question_result[0]["question"];?>" class="input-l">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">答案</label>
					<div class="controls">
						<input type="text" name="answer" value="<?php print $question_result[0]["answer"];?>" class="input-l">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">解析</label>
					<div class="controls">
						<textarea name="resolution"><?php print $question_result[0]["resolution"];?></textarea>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">關鍵字</label>
					<div class="controls">
						<input type="text" name="keyword" value="<?php print $question_result[0]["keyword"];?>" class="input-m">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">年份</label>
					<div class="controls">
						<input type="text" name="year" value="<?php print $question_result[0]["year"];?>" class="input-s">
					</div>
				</div>
				<input type="hidden" name="postQ" value="<?php print $question_id;?>">
				<div class="btn-box-1">
				<button type="reset" class="btn basic">取消</button>
				<button type="submit" name="submitType" value="editQuestion" class="btn red">確認送出</button>
				</div>
				
			</div>
		</div>
	</div>
</div>
</form>
<?php include_once("include/footer.php");?>