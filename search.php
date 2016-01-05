<?php
include_once("include/db.php");
include_once("include/func_category.php");
$conn_ategory = new Category();
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

//print_r($arr_subject);
//exit;
//print_r($subject_result);
?>
<?php include_once("include/header.php");?>
<script>
var subject= <?php echo json_encode($arr_subject); ?>;
var chapter= <?php echo json_encode($arr_chapter); ?>;
var section= <?php echo json_encode($arr_section); ?>;
var part= <?php echo json_encode($arr_part); ?>;
var item= <?php echo json_encode($arr_item); ?>;

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

<form name="myForm" action="search_result.php?page=search" method="post">
<div class="container">
	<div class="widget add-customer">
		<div class="body">
			<div class="form-edit">
				<div class="title">
					<h3 class="icon-info">請選擇分類</h3>
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
									<option value="<?php echo $val["category_id"];?>"><?php echo $val["category_name"];?></option>
								<?php } ?>
							</select>
						</div>
        		<div class="Cell">
            	<select name="jsubject" size=5 style="width:200px;" id="id_subject" onChange="renew2(this);">
								<option value="">請先選取類別
							</select>
        		</div>
        		<div class="Cell">
            	<select name="jchapter" size=5 style="width:200px;" id="id_chapter" onChange="renew3(this);">
								<option value="">請先選取學科
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
								<option value="">請先選取章
							</select>
						</div>
        		<div class="Cell">
            	<select name="jpart" size=5 style="width:200px;" id="id_part" onChange="renew5(this);">
								<option value="">請先選取節
							</select>
        		</div>
        		<div class="Cell">
            	<select name="jitem" size=5 style="width:200px;" id="id_item">
								<option value="">請先選取小節
							</select>
        		</div>
        	</div>
			  </div>
			  
				
				<br/>
				<div class="title">
					<h3 class="icon-info">請選擇考試</h3>
				</div>
				<div class="Table">
					<div class="Heading">
						<div class="Cell">考試種類</div>
					</div>
					<div class="Row">
						<div class="Cell">
							<select name="jexam" size=5 style="width:200px;">
								<?php foreach ($exam_result as $key => $val) { ?>
									<option value="<?php echo $val["exam_id"];?>"><?php echo $val["exam_name"];?></option>
								<?php } ?>
							</select>
						</div>
        	</div>
				</div>
				<br/>
				<div class="btn-box-1">
				<button type="reset" class="btn basic">取消</button>
				<button type="submit" name="submitType" value="search" class="btn red">搜尋</button>
				</div>

			</div>
		</div>
	</div>
</div>
</form>
<?php include_once("include/footer.php");?>