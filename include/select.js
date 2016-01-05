var subject= <?php echo json_encode($arr_subject); ?>;
var chapter= <?php echo json_encode($arr_chapter); ?>;
var section= <?php echo json_encode($arr_section); ?>;
var part= <?php echo json_encode($arr_part); ?>;
var item= <?php echo json_encode($arr_item); ?>;

function renew(sel){
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