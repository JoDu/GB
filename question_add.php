<?php
include_once("include/db.php");
include_once("include/func_category.php");
$conn_ategory = new Category();
$submit_name = "類別";

print_r($post);exit;

if($_POST["submitType"] == "addExam"){
	header('Location: '.$ROOTURL.'exam_add.php?post='.$_POST);
	exit;
}
//print_r($_POST);exit;

if (!empty($_POST["jcategory"])) {
	$jcategory = $_POST["jcategory"];
	$result = $conn_ategory->getCategoryList($_POST["jcategory"]);
	$submit_name = "學科";
}
if (!empty($_POST["jsubject"])) {
	$jsubject = $_POST["jsubject"];
	$pieces = explode("-", $jsubject);
	$subject_result = $conn_ategory->getSubjectList($pieces[0],$pieces[1]);
	$submit_name = "章";
}

if (!empty($_POST["jchapter"])) {
	$jchapter = $_POST["jchapter"];
	$chapter_result = $conn_ategory->getChapterList($jchapter);
	$submit_name = "節";
}
if (!empty($_POST["jsection"])) {
	$jsection = $_POST["jsection"];
	$section_result = $conn_ategory->getSectionList($jsection);
	$submit_name = "小節";
}
if (!empty($_POST["jpart"])) {
	$jpart = $_POST["jpart"];
	$part_result = $conn_ategory->getPartList($jpart);
	$submit_name = "項目";
}
if (!empty($_POST["jitem"])) {
	$jitem = $_POST["jitem"];
	$item_result = $conn_ategory->getItemList($jitem);
}

//print_r($_POST);exit;
?>
<?php include_once("include/header.php");?>
<form name="myForm" action="data_add.php" method="post">
	<div class="container">
		<div class="widget add-customer">
			<div class="body">
				<div class="form-edit">
					<div class="control-group">
						<?php if (empty($jcategory)) { ?>
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
						<input type="hidden" name="postCategory" value="<?php print $jcategory;?>">
						<input type="hidden" name="postSubject" value="<?php print $jsubject;?>">
						<input type="hidden" name="postChapter" value="<?php print $jchapter;?>">
						<input type="hidden" name="postSection" value="<?php print $jsection;?>">
						<input type="hidden" name="postPart" value="<?php print $jpart;?>">
						<input type="hidden" name="postItem" value="<?php print $jitem;?>">
					  <input type="submit" name="submitType" value="新增<?php print $submit_name;?>">
				  </div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php include_once("include/footer.php");?>