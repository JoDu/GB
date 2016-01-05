<?php
include_once("include/db.php");
include_once("include/func_category.php");
$conn_ategory = new Category();
$submit_name = "類別";

/*
if($_POST["submitType"] == "addExam"){
	header('Location: '.$ROOTURL.'question_add.php?item_id='.$_POST["jitem"]);
	exit;
}
*/
//print_r($_POST);exit;

$page_title = "新增類別";

if (!empty($_POST["jcategory"])) {
	$jcategory = $_POST["jcategory"];
	$result = $conn_ategory->getCategoryList($_POST["jcategory"]);
	$submit_name = "學科";
	$page_title = "新增學科";
}
if (!empty($_POST["jsubject"])) {
	$jsubject = $_POST["jsubject"];
	$pieces = explode("-", $jsubject);
	$subject_result = $conn_ategory->getSubjectList($pieces[0],$pieces[1]);
	$submit_name = "章";
	$page_title = "新增章";
}

if (!empty($_POST["jchapter"])) {
	$jchapter = $_POST["jchapter"];
	$chapter_result = $conn_ategory->getChapterList($jchapter);
	$submit_name = "節";
	$page_title = "新增節";
}
if (!empty($_POST["jsection"])) {
	$jsection = $_POST["jsection"];
	$section_result = $conn_ategory->getSectionList($jsection);
	$submit_name = "小節";
	$page_title = "新增小節";
}
if (!empty($_POST["jpart"])) {
	$jpart = $_POST["jpart"];
	$part_result = $conn_ategory->getPartList($jpart);
	$submit_name = "項目";
	$page_title = "新增項目";
}
if (!empty($_POST["jitem"])) {
	$jitem = $_POST["jitem"];
	$item_result = $conn_ategory->getItemList($jitem);
}

if ($_POST["submitType"] == "addQuestion") {
	$submitType = $_POST["submitType"];
	$question = $_POST["question"];
	$answer = $_POST["answer"];
	$resolution = $_POST["resolution"];
	$keyword = $_POST["keyword"];
	$year = $_POST["year"];
	$exam_id = $_POST["jexam"];
	$page_title = "題目預覽";
	$exam_result = $conn_ategory->getExamList($exam_id);
	$exam_name = $exam_result[0]["exam_name"];
}

if ($_POST["submitType"] == "editQuestion") {
	$question_id = $_POST["postQ"];
	$submitType = $_POST["submitType"];
	$question = $_POST["question"];
	$answer = $_POST["answer"];
	$resolution = $_POST["resolution"];
	$keyword = $_POST["keyword"];
	$year = $_POST["year"];
	//$exam_id = $_POST["jexam"];
	$page_title = "修改題目預覽";
	//$exam_result = $conn_ategory->getExamList($exam_id);
	//$exam_name = $exam_result[0]["exam_name"];
}


if ($_POST["submitType"] == "新增考試") {
	$jexam = "1";
	$submit_name = "考試";
	$page_title = "新增考試";
}
//print_r($_POST);exit;
?>
<?php include_once("include/header.php");?>
<form name="myForm" action="data_add.php" method="post">
	<div class="container">
		<div class="widget add-customer">
			<div class="hd">
				<h2><?php print $page_title;?></h2>
			</div>
			<div class="body">
				<div class="form-edit">
					<div class="control-group">
						<?php if ($submitType == "addQuestion" || $submitType == "editQuestion") { ?>
							<div class="control-group">
								<label class="control-label">題目</label>
								<div class="controls"><?php print $question;?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">答案</label>
								<div class="controls"><?php print $answer;?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">解析</label>
								<div class="controls"><?php print $resolution;?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">關鍵字</label>
								<div class="controls"><?php print $keyword;?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">考試種類</label>
								<div class="controls"><?php print $exam_name;?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">年份</label>
								<div class="controls"><?php print $year;?></div>
							</div>
							
							<div class="control-group">
								<label class="control-label">項目</label>
								<div class="controls"><?php print $item_result[0]["item_name"];?></div>
							</div>
							<div class="btn-box-1">
								<button type="submit" name="submitType" value="<?php print $submitType;?>" class="btn red">確認送出</button>
							</div>
							<input type="hidden" name="postQ" value="<?php print $question_id;?>">
						<?php } else {?>
							<?php if (empty($jcategory) && empty($jexam)) { ?>
								類別編號:<input type="text" name="categoryID"><br/>
							<?php } else if (!empty($jitem)) { print "項目:".$item_result[0]["item_name"]."<br/>";?>
							<?php } else if (!empty($jpart)) { print "小節:".$part_result[0]["part_name"]."<br/>";?>
							<?php } else if (!empty($jsection)) { print "節:".$section_result[0]["section_name"]."<br/>";?>
							<?php } else if (!empty($jchapter)) { print "章:".$chapter_result[0]["chapter_name"]."<br/>";?>
							<?php } else if (!empty($jsubject)) { print "學科:".$subject_result[0]["subject_name"]."<br/>";?>
							<?php } else if (!empty($jcategory)) { print "類別:".$result[0]["category_name"]."<br/>";?>
								學科編號:<input type="text" name="subjectID"><br/>
								學科子編號:<input type="text" name="subID"><br/>
							<?php } ?>
							<?php print $submit_name;?>內容:<input type="text" name="addData"><br/>
							<div class="btn-box-1">
								<button type="submit" name="submitType" value="<?php print $page_title;?>" class="btn red"><?php print $page_title;?></button>
							</div>
						<?php } ?>
						<input type="hidden" name="postCategory" value="<?php print $jcategory;?>">
						<input type="hidden" name="postSubject" value="<?php print $jsubject;?>">
						<input type="hidden" name="postChapter" value="<?php print $jchapter;?>">
						<input type="hidden" name="postSection" value="<?php print $jsection;?>">
						<input type="hidden" name="postPart" value="<?php print $jpart;?>">
						<input type="hidden" name="postItem" value="<?php print $jitem;?>">
						<input type="hidden" name="postQuestion" value="<?php print $question;?>">
						<input type="hidden" name="postAnswer" value="<?php print $answer;?>">
						<input type="hidden" name="postResolution" value="<?php print $resolution;?>">
						<input type="hidden" name="postKeyword" value="<?php print $keyword;?>">
						<input type="hidden" name="postYear" value="<?php print $year;?>">
						<input type="hidden" name="postExam" value="<?php print $exam_id;?>">
				  </div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php include_once("include/footer.php");?>