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
//print_r($arr_section);
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

function renew(sel){
	var elements = myForm.subName;
  elements.value = elements.value.replace("類別", "學科");
	var arrSubject = new Array();
	arrSubject = subject[sel.value];
	var arrLength = Object.keys(arrSubject).length;
	//console.log(arrSubject);
	//console.log(arrLength);
	var i = 0;
	for (var key in arrSubject) {
		document.myForm.jsubject.options[i]=new Option(arrSubject[key], key);
		i++;
  } 
}

function renew2(sel){
	var elements = myForm.subName;
  elements.value = elements.value.replace("學科", "章");
	//console.log(sel.value);
	var arrChapter = new Array();
	arrChapter = chapter[sel.value];
	var arrLength = Object.keys(arrChapter).length;
	//console.log(arrChapter);
	//console.log(arrLength);
	var i = 0;
	for (var key in arrChapter) {
		document.myForm.jchapter.options[i]=new Option(arrChapter[key], key);
		i++;
  }
}

function renew3(sel){
	var elements = myForm.subName;
  elements.value = elements.value.replace("章", "節");
	//console.log(sel.value);
	var arrSection = new Array();
	arrSection = section[sel.value];
	var arrLength = Object.keys(arrSection).length;
	//console.log(arrChapter);
	//console.log(arrLength);
	var i = 0;
	for (var key in arrSection) {
		document.myForm.jsection.options[i]=new Option(arrSection[key], key);
		i++;
  }
}

function renew4(sel){
	var elements = myForm.subName;
  elements.value = elements.value.replace("節", "小節");
	//console.log(sel.value);
	var arrPart = new Array();
	arrPart = part[sel.value];
	var arrLength = Object.keys(arrPart).length;
	//console.log(arrChapter);
	//console.log(arrLength);
	var i = 0;
	for (var key in arrPart) {
		document.myForm.jpart.options[i]=new Option(arrPart[key], key);
		i++;
  }
}

function renew5(sel){
	var elements = myForm.subName;
  elements.value = elements.value.replace("小節", "項目");
	//console.log(sel.value);
	var arrItem = new Array();
	arrItem = item[sel.value];
	var arrLength = Object.keys(arrItem).length;
	//console.log(arrChapter);
	//console.log(arrLength);
	var i = 0;
	for (var key in arrItem) {
		document.myForm.jitem.options[i]=new Option(arrItem[key], key);
		i++;
  }
  
}
</script>

<form name="myForm" action="category_add.php" method="post">
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
            	<select name="jsubject" size=5 style="width:200px;" onChange="renew2(this);">
								<option value="">請先選取類別
							</select>
        		</div>
        		<div class="Cell">
            	<select name="jchapter" size=5 style="width:200px;" onChange="renew3(this);">
								<option value="">請先選取學科
							</select>
        		</div>
        	</div>
        	<div class="Heading">
			        <div class="Cell">節</div>
			        <div class="Cell">小節</div>
			        <div class="Cell">項目</div>
			    </div>
			    <div class="Row">
						<div class="Cell">
							<select name="jsection" size=5 style="width:150px;" onChange="renew4(this);">
								<option value="">請先選取章
							</select>
						</div>
        		<div class="Cell">
            	<select name="jpart" size=5 style="width:150px;" onChange="renew5(this);">
								<option value="">請先選取節
							</select>
        		</div>
        		<div class="Cell">
            	<select name="jitem" size=5 style="width:150px;">
								<option value="">請先選取小節
							</select>
        		</div>
        	</div>
			  </div>

<br/><input type="submit" name="subName" value="新增類別">

      	<div class="title">
					<h3 class="icon-info">新增題目</h3>
				</div>
	
				<div class="control-group">
					<label class="control-label">題目</label>
					<div class="controls">
						<input type="text" name="exam" class="input-l">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">答案</label>
					<div class="controls">
						<input type="text" name="answer" class="input-l">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">解析</label>
					<div class="controls">
						<textarea name="resolution"></textarea>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">關鍵字</label>
					<div class="controls">
						<input type="text" name="keyword" class="input-m">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">年份</label>
					<div class="controls">
						<input type="text" name="year" class="input-s">
					</div>
				</div>
				
				<div class="btn-box-1">
				<button type="reset" class="btn basic">取消</button>
				<button type="submit" class="btn red">確認送出</button>
				</div>

			</div>
		</div>
	</div>
</div>
</form>
<?php include_once("include/footer.php");?>