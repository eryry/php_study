<?php

class Student {
	public $ame;
	
	public function __construct($name) {
		$this->name = $name;
	}
	
	function cal_avg($data) {
		$sum = 0;
		for($i=0;$i<count($data);$i++) {
			$sum += $data[$i];
		}
		$avg = $sum / count($data);
		return $avg;
	}
	
	function judge($avg) {
		$result;
		if(60<=$avg) {
			$resutl= "passed";
		}else{
			$resutl= "failed";
		}
		return $resutl;
	}
}

$a001 = new Student("sato");
$data = [70,65,50,90,100];
$avg = $a001->cal_avg($data);
$result= $a001->judge($avg);

echo count($data)."\n";
echo $a001->name."\n";
echo $avg."\n";
echo $result."\n"

;?>
