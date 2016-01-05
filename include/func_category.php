<?php
include_once("init.ini");
include_once("db.php");
class Category{
    
    function Category() {
  		$this->conn = new DB_Connection(DBHOST, DATABASE, USERNAME, PASSWORD);
  		$this->conn->connect();
 		}
    
    public function getCategoryList($category_id='') {
			$sql = "SELECT * FROM category";
    	if (!empty($category_id)) {
    		$sql .= " where category_id =".$category_id;
    	}
    	//print $sql;exit;
			$result = $this->conn->query($sql);
			return $result;
    }

    public function addCategory($category_id,$category_name) {
            $sql = "insert into category (category_id,category_name)";
            $sql .= " values ('".$category_id."','".$category_name."')";
        //print $sql;exit;
            $result = $this->conn->query($sql);
            return $result;
    }
    
    public function getSubjectList($subject_id='',$sub_id='') {
    	$sql = "SELECT * FROM subject";
    	if (!empty($subject_id)) {
    		$sql .= " where subject_id ='".$subject_id."'";
    	}
    	if (!empty($sub_id)) {
    		$sql .= " and sub_id ='".$sub_id."'";
    	}   	
			$result = $this->conn->query($sql);
			return $result;
    }
    
    public function addSubject($subject_id,$sub_id,$category_id,$subject_name) {
            $sql = "insert into subject (subject_id,sub_id,category_id,subject_name)";
            $sql .= " values ('".$subject_id."','".$sub_id."','".$category_id."','".$subject_name."')";
        //print $sql;exit;
            $result = $this->conn->query($sql);
            return $result;
    }
    
    public function getChapterList($chapter_id='') {
    	$sql = "SELECT * FROM chapter";
    	if (!empty($chapter_id)) {
    		$sql .= " where chapter_id =".$chapter_id;
    	}    	
			$result = $this->conn->query($sql);
			return $result;
    }
    
    public function addChapter($subject_id,$sub_id,$chapter_name) {
            $sql = "insert into chapter (subject_id,sub_id,chapter_name)";
            $sql .= " values ('".$subject_id."','".$sub_id."','".$chapter_name."')";
        //print $sql;exit;
            $result = $this->conn->query($sql);
            return $result;
    }
    
    public function getSectionList($section_id='') {
    	$sql = "SELECT * FROM section";
    	if (!empty($section_id)) {
    		$sql .= " where section_id =".$section_id;
    	}    	
			$result = $this->conn->query($sql);
			return $result;
    }
    
    public function addSection($subject_id,$sub_id,$chapter_id,$section_name) {
            $sql = "insert into section (subject_id,sub_id,chapter_id,section_name)";
            $sql .= " values ('".$subject_id."','".$sub_id."','".$chapter_id."','".$section_name."')";
        //print $sql;exit;
            $result = $this->conn->query($sql);
            return $result;
    }
    
    public function getPartList($part_id='') {
    	$sql = "SELECT * FROM part";
    	if (!empty($part_id)) {
    		$sql .= " where part_id =".$part_id;
    	}    	
			$result = $this->conn->query($sql);
			return $result;
    }
    
    public function addPart($subject_id,$sub_id,$chapter_id,$section_id,$part_name) {
            $sql = "insert into part (subject_id,sub_id,chapter_id,section_id,part_name)";
            $sql .= " values ('".$subject_id."','".$sub_id."','".$chapter_id."','".$section_id."','".$part_name."')";
        //print $sql;exit;
            $result = $this->conn->query($sql);
            return $result;
    }
    
    public function getItemList($item_id='') {
    	$sql = "SELECT * FROM item";
    	if (!empty($item_id)) {
    		$sql .= " where item_id =".$item_id;
    	}    	
			$result = $this->conn->query($sql);
			return $result;
    }
    
    public function addItem($subject_id,$sub_id,$chapter_id,$section_id,$part_id,$item_name) {
            $sql = "insert into item (subject_id,sub_id,chapter_id,section_id,part_id,item_name)";
            $sql .= " values ('".$subject_id."','".$sub_id."','".$chapter_id."','".$section_id."','".$part_id."','".$item_name."')";
        //print $sql;exit;
            $result = $this->conn->query($sql);
            return $result;
    }
    
    public function getQuestionList($question_id='',$question='',$answer='',$resolution='',$keyword='',$exam_id='',$year='',$item_id='') {
    	$sql = "SELECT * FROM question";
    		$sql .= " where 1 ";
    	if (!empty($question_id)) {
    		$sql .= " and question_id ='".$question_id."'";
    	}
    	if (!empty($question)) {
    		$sql .= " and question like '%".$question."%'";
    	}
    	if (!empty($answer)) {
    		$sql .= " and answer like '%".$answer."%'";
    	}  	
    	if (!empty($resolution)) {
    		$sql .= " and resolution like '%".$resolution."%'";
    	}
    	if (!empty($keyword)) {
    		$sql .= " and keyword like '%".$keyword."%'";
    	}
    	if (!empty($exam_id)) {
    		$sql .= " and exam_id = '".$exam_id."'";
    	}
    	if (!empty($year)) {
    		$sql .= " and year = '".$year."'";
    	}
    	if (!empty($item_id)) {
    		$sql .= " and item_id = '".$item_id."'";
    	}
			$result = $this->conn->query($sql);
			return $result;
    }
    
    public function addQuestion($question,$answer,$resolution,$keyword,$exam_id='',$year,$item_id) {
            $sql = "insert into question (question,answer,resolution,keyword,exam_id,year,item_id)";
            $sql .= " values ('".$question."','".$answer."','".$resolution."','".$keyword."','".$exam_id."','".$year."','".$item_id."')";
        //print $sql;exit;
            $result = $this->conn->query($sql);
            return $result;
    }
    
    public function updQuestion($question_id,$question='',$answer='',$resolution='',$keyword='',$exam_id='',$year='',$item_id='') {
            $sql = "UPDATE question set question_id = '".$question_id."'";
            if (!empty($question)) {
			    		$sql .= " ,question = '".$question."'";
			    	}
			    	if (!empty($answer)) {
			    		$sql .= " ,answer = '".$answer."'";
			    	}  	
			    	if (!empty($resolution)) {
			    		$sql .= " ,resolution = '".$resolution."'";
			    	}
			    	if (!empty($keyword)) {
			    		$sql .= " ,keyword = '".$keyword."'";
			    	}
			    	if (!empty($exam_id)) {
			    		$sql .= " ,exam_id = '".$exam_id."'";
			    	}
			    	if (!empty($year)) {
			    		$sql .= " ,year = '".$year."'";
			    	}
			    	if (!empty($item_id)) {
			    		$sql .= " ,item_id = '".$item_id."'";
			    	}
            $sql .= " where question_id = '".$question_id."'";
        //print $sql;exit;
            $result = $this->conn->query($sql);
            return $result;
    }
    
    public function getExamList($exam_id='') {
    	$sql = "SELECT * FROM exam";
    	if (!empty($exam_id)) {
    		$sql .= " where exam_id =".$exam_id;
    	}    	
			$result = $this->conn->query($sql);
			return $result;
    }
    
    public function addExam($exam_name) {
            $sql = "insert into exam (exam_name)";
            $sql .= " values ('".$exam_name."')";
        //print $sql;exit;
            $result = $this->conn->query($sql);
            return $result;
    }
} 
?>
