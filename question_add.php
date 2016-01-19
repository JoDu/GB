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
	$q_item_id = $question_result[0]["item_id"];
	//print_r($question_result);exit;
	$question_item_result = $conn_ategory->getItemList($q_item_id);
	$question_subject_result = $conn_ategory->getSubjectList($question_item_result[0]["subject_id"],$question_item_result[0]["sub_id"]);
	$q_category_id = $question_subject_result[0]["category_id"];
	$q_subject_id = $question_item_result[0]["subject_id"]."-".$question_item_result[0]["sub_id"];
	$q_chapter_id = $question_item_result[0]["chapter_id"];
	$q_section_id = $question_item_result[0]["section_id"];
	$q_part_id = $question_item_result[0]["part_id"];
	//$exam_result = $conn_ategory->getExamList($exam_id);
	//$question_exam_result = $conn_ategory->getExamList('');
}

$result = $conn_ategory->getCategoryList('');
$subject_result = $conn_ategory->getSubjectList('','');
$chapter_result = $conn_ategory->getChapterList('');
$section_result = $conn_ategory->getSectionList('');
$part_result = $conn_ategory->getPartList('');
$item_result = $conn_ategory->getItemList('');
$exam_result = $conn_ategory->getExamList('');
//print_r($part_result);
//exit;
$arr_subject = array();
foreach ($subject_result as $key => $val) {
	$id = $val["subject_id"]."-".$val["sub_id"];
  $arr_subject[$val["category_id"]][$id]=$val["subject_name"];
}

$arr_chapter = array();
foreach ($chapter_result as $key => $val) {
	$subject_id = $val["subject_id"]."-".$val["sub_id"];
  $arr_chapter[$subject_id][$val["chapter_id"]]=$val["chapter_name"];
}

$arr_section = array();
foreach ($section_result as $key => $val) {
  $arr_section[$val["chapter_id"]][$val["section_id"]]=$val["section_name"];
}

$arr_part = array();
foreach ($part_result as $key => $val) {
  $arr_part[$val["section_id"]][$val["part_id"]]=$val["part_name"];
}

$arr_item = array();
foreach ($item_result as $key => $val) {
  $arr_item[$val["part_id"]][$val["item_id"]]=$val["item_name"];
}
//print_r($arr_subject[$q_category_id]);exit;
?>
<?php include_once("include/header.php");?>
<script>
var subject= <?php echo json_encode($arr_subject); ?>;
var chapter= <?php echo json_encode($arr_chapter); ?>;
var section= <?php echo json_encode($arr_section); ?>;
var part= <?php echo json_encode($arr_part); ?>;
var item= <?php echo json_encode($arr_item); ?>;
var subject_id = <?php echo $q_subject_id; ?>;

function removeOptions(selectbox)
{
    var i;
    for(i=selectbox.options.length-1;i>=0;i--)
    {
        selectbox.remove(i);
    }
}


function renew(sel){
	var arrSubject = new Array();
	arrSubject = subject[sel.value];
	//var arrLength = Object.keys(arrSubject).length;
	//console.log(arrSubject);
	removeOptions(document.getElementById("id_subject"));
	removeOptions(document.getElementById("id_chapter"));
	removeOptions(document.getElementById("id_section"));
	removeOptions(document.getElementById("id_part"));
	removeOptions(document.getElementById("id_item"));
	
	var i = 0;
	for (var key in arrSubject) {
		document.myForm.jsubject.options[i]=new Option(arrSubject[key], key);
		//if (subject_id == arrSubject[key]) {
		//	document.myForm.jsubject.options[i].selected = true;
		//}
		i++;
  } 
}

function renew2(sel){
	var arrChapter = new Array();
	arrChapter = chapter[sel.value];
	
	removeOptions(document.getElementById("id_chapter"));
	removeOptions(document.getElementById("id_section"));
	removeOptions(document.getElementById("id_part"));
	removeOptions(document.getElementById("id_item"));
	
	var i = 0;
	for (var key in arrChapter) {
		document.myForm.jchapter.options[i]=new Option(arrChapter[key], key);
		i++;
  }
}

function renew3(sel){
	var arrSection = new Array();
	arrSection = section[sel.value];
	removeOptions(document.getElementById("id_section"));
	removeOptions(document.getElementById("id_part"));
	removeOptions(document.getElementById("id_item"));
	var i = 0;
	for (var key in arrSection) {
		document.myForm.jsection.options[i]=new Option(arrSection[key], key);
		i++;
  }
}

function renew4(sel){
	var arrPart = new Array();
	arrPart = part[sel.value];
	removeOptions(document.getElementById("id_part"));
	removeOptions(document.getElementById("id_item"));
	var i = 0;
	for (var key in arrPart) {
		document.myForm.jpart.options[i]=new Option(arrPart[key], key);
		i++;
  }
}

function renew5(sel){
	var arrItem = new Array();
	arrItem = item[sel.value];
	removeOptions(document.getElementById("id_item"));
	var i = 0;
	for (var key in arrItem) {
		document.myForm.jitem.options[i]=new Option(arrItem[key], key);
		i++;
  }
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<form name="myForm" action="category_add.php" method="post">
<div class="container">
	<div class="widget add-customer">
		<div class="body">
			<div class="form-edit">
      	<div class="title">
					<h3 class="icon-info"><?php print $page_title;?></h3>
				</div>
				
				<div class="title">
					<h3 class="icon-info">題目分類</h3>
				</div>
				<div class="Table">
					<div class="Heading">
			        <div class="Cell">類別</div>
			        <div class="Cell">學科</div>
			        <div class="Cell">章</div>
			    </div>
					<div class="Row">
						<div class="Cell">
							<select name="jcategory" size=5 style="width:200px;" onChange="renew(this);">
								<?php foreach ($result as $key => $val) { ?>
									<option value="<?php echo $val["category_id"];?>" <?php if ($val["category_id"] ==$q_category_id) { print "selected";}?>><?php echo $val["category_name"];?></option>
								<?php } ?>
							</select>
						</div>
        		<div class="Cell">
            	<select name="jsubject" size=5 style="width:200px;" id="id_subject" onChange="renew2(this);">
								<?php foreach ($arr_subject[$q_category_id] as $key => $val) { ?>
									<option value="<?php echo $key;?>" <?php if ($key ==$q_subject_id) { print "selected";}?>><?php echo $val;?></option>
								<?php } ?>
							</select>
        		</div>
        		<div class="Cell">
            	<select name="jchapter" size=5 style="width:200px;" id="id_chapter" onChange="renew3(this);">
								<?php foreach ($arr_chapter[$q_subject_id] as $key => $val) { ?>
									<option value="<?php echo $key;?>" <?php if ($key ==$q_chapter_id) { print "selected";}?>><?php echo $val;?></option>
								<?php } ?>
							</select>
        		</div>
        	</div><br/>
        	<div class="Heading">
			        <div class="Cell">節</div>
			        <div class="Cell">小節</div>
			        <div class="Cell">項目</div>
			    </div>
			    <div class="Row">
						<div class="Cell">
							<select name="jsection" size=5 style="width:200px;" id="id_section" onChange="renew4(this);">
								<?php foreach ($arr_section[$q_chapter_id] as $key => $val) { ?>
									<option value="<?php echo $key;?>" <?php if ($key ==$q_section_id) { print "selected";}?>><?php echo $val;?></option>
								<?php } ?>
							</select>
						</div>
        		<div class="Cell">
            	<select name="jpart" size=5 style="width:200px;" id="id_part" onChange="renew5(this);">
								<?php foreach ($arr_part[$q_section_id] as $key => $val) { ?>
									<option value="<?php echo $key;?>" <?php if ($key ==$q_part_id) { print "selected";}?>><?php echo $val;?></option>
								<?php } ?>
							</select>
        		</div>
        		<div class="Cell">
            	<select name="jitem" size=5 style="width:200px;" id="id_item">
								<?php foreach ($arr_item[$q_part_id] as $key => $val) { ?>
									<option value="<?php echo $key;?>" <?php if ($key ==$q_item_id) { print "selected";}?>><?php echo $val;?></option>
								<?php } ?>
							</select>
        		</div>
        	</div>
			  </div>
				
				<br/>
				<div class="title">
					<h3 class="icon-info">考試種類</h3>
				</div>
				<div class="Table">
					<div class="Row">
						<div class="Cell">
							<select id="jexam" name="jexam" size=5 style="width:200px;">
								<?php foreach ($exam_result as $key => $val) { ?>
									<option value="<?php echo $val["exam_id"];?>" <?php if ($val["exam_id"] ==$exam_id) { print "selected";}?>><?php echo $val["exam_name"];?></option>
								<?php } ?>
							</select>
						</div>
        	</div>
				</div>
				<br/>
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