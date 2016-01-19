<?php
include_once("include/db.php");
include_once("include/func_category.php");
$conn_ategory = new Category();
$submit_name = "類別";

//print_r($_POST);exit;
$addData = $_POST["addData"];
if ($_POST["submitType"] == "addQuestion") {
	if (!empty($_POST["postItem"])) {
		$jitem = $_POST["postItem"];
		$year=$_POST["postYear"];
		$keyword=$_POST["postKeyword"];
		$resolution=$_POST["postResolution"];
		$answer=$_POST["postAnswer"];
		$question=$_POST["postQuestion"];
		$exam_id=$_POST["postExam"];
		$item_result = $conn_ategory->getItemList($jitem);
		$subject_id = $item_result[0]["subject_id"]."-".$item_result[0]["sub_id"];
		if ($_POST["postPart"] != $item_result[0]["part_id"]) {
			$returnMesg = "小節錯誤!請選擇正確小節!";
		} else if ($_POST["postSection"] != $item_result[0]["section_id"]) {
			$returnMesg = "節錯誤!請選擇正確節!";
		} else if ($_POST["postChapter"] != $item_result[0]["chapter_id"]) {
			$returnMesg = "章錯誤!請選擇正確章!";
		} else if ($_POST["postSubject"] != $subject_id) {
			$returnMesg = "學科錯誤!請選擇正確學科!";
		} else {
			$conn_ategory->addQuestion($question,$answer,$resolution,$keyword,$exam_id,$year,$jitem);
			$returnMesg = "題目輸入成功";
		}
	} else {
		$returnMesg = "項目錯誤!請選擇正確項目!";
	}
} else if ($_POST["submitType"] == "editQuestion") {
	if (!empty($_POST["postQ"])) {
		$question_id = $_POST["postQ"];
		$jitem = $_POST["postItem"];
		$year=$_POST["postYear"];
		$keyword=$_POST["postKeyword"];
		$resolution=$_POST["postResolution"];
		$answer=$_POST["postAnswer"];
		$question=$_POST["postQuestion"];
		$exam_id=$_POST["postExam"];
		$conn_ategory->updQuestion($question_id,$question,$answer,$resolution,$keyword,$exam_id,$year,$jitem);
		$returnMesg = "題目修改成功";
	} else {
		$returnMesg = "資料不齊全";
	}
} else {
	if (!empty($_POST["addData"])) {
		if ($_POST["submitType"] == "新增類別") {
			$category_id = $_POST["categoryID"];
			if (empty($category_id)) {
				$returnMesg = "請輸入類別編號";
			} else if(empty($addData)) {
				$returnMesg = "請輸入類別內容";
			} else {
				$conn_ategory->addCategory($category_id,$addData);
				$returnMesg = "類別輸入成功";
			}
			
		} else if ($_POST["submitType"] == "新增學科") {
			$category_id = $_POST["postCategory"];
			$subject_id=$_POST["subjectID"];
			$sub_id=$_POST["subID"];
			if (empty($sub_id)) {
				$sub_id = "00";
			}
			if (empty($category_id)) {
				$returnMesg = "請重新選擇類別";
			} else if(empty($subject_id)) {
				$returnMesg = "請輸入學科編號";
			} else if(empty($addData)) {
				$returnMesg = "請輸入學科內容";
			} else {
				$conn_ategory->addSubject($subject_id,$sub_id,$category_id,$addData);
				$returnMesg = "學科輸入成功";
			}
		} else if ($_POST["submitType"] == "新增章") {
			$jsubject = $_POST["postSubject"];
		  $pieces = explode("-", $jsubject);
		  $subject_id = $pieces[0];
		  $sub_id = $pieces[1];
		  //print_r($jsubject);
		  if (empty($subject_id)) {
		  	$returnMesg = "請重新選擇學科";
		  } else {
		  	$conn_ategory->addChapter($subject_id,$sub_id,$addData);
				$returnMesg = "章輸入成功";
			}
		} else if ($_POST["submitType"] == "新增節") {
			$jsubject = $_POST["postSubject"];
			$jchapter = $_POST["postChapter"];
		  $pieces = explode("-", $jsubject);
		  $subject_id = $pieces[0];
		  $sub_id = $pieces[1];
		  //print_r($jsubject);
		  if (empty($jchapter)) {
		  	$returnMesg = "請重新選擇章";
		  } else if (empty($jsubject)) {
		  	$returnMesg = "資料不齊全";
		  } else {
		  	$conn_ategory->addSection($subject_id,$sub_id,$jchapter,$addData);
				$returnMesg = "節輸入成功";
			}
		} else if ($_POST["submitType"] == "新增小節") {
			$jsubject = $_POST["postSubject"];
			$jchapter = $_POST["postChapter"];
			$jsection = $_POST["postSection"];
			$pieces = explode("-", $jsubject);
		  $subject_id = $pieces[0];
		  $sub_id = $pieces[1];
		  if (empty($jsection)) {
		  	$returnMesg = "請重新選擇節";
		  } else if (empty($jchapter)) {
		  	$returnMesg = "請重新選擇章";
		  } else if (empty($jsubject)) {
		  	$returnMesg = "請重新選擇學科";
		  } else {
		  	$conn_ategory->addPart($subject_id,$sub_id,$jchapter,$jsection,$addData);
				$returnMesg = "小節輸入成功";
		  }
		} else if ($_POST["submitType"] == "新增項目") {
			$jsubject = $_POST["postSubject"];
			$jchapter = $_POST["postChapter"];
			$jsection = $_POST["postSection"];
			$jsection = $_POST["postSection"];
			$jpart = $_POST["postPart"];
			$pieces = explode("-", $jsubject);
		  $subject_id = $pieces[0];
		  $sub_id = $pieces[1];
		  if(empty($jpart)) {
		  	$returnMesg = "請重新選擇小節";
		  } else if (empty($jsection)) {
		  	$returnMesg = "請重新選擇節";
		  } else if (empty($jchapter)) {
		  	$returnMesg = "請重新選擇章";
		  } else if (empty($jsubject)) {
		  	$returnMesg = "請重新選擇學科";
		  } else {
		  	$conn_ategory->addItem($subject_id,$sub_id,$jchapter,$jsection,$jpart,$addData);
				$returnMesg = "項目輸入成功";
		  }
		} else if ($_POST["submitType"] == "新增考試") {
				$conn_ategory->addExam($addData);
				$returnMesg = "考試輸入成功";
		}
	} else {
		$returnMesg = "資料不齊全";
	}
}
?>
<?php include_once("include/header.php");?>
<div class="container">
	<div class="widget add-customer">
		<div class="body">
			<?php print $returnMesg;?><br/>
		</div>
	</div>
</div>
<?php include_once("include/footer.php");?>