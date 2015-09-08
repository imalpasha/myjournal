<?php
require_once "BaseModel.php";

class CriteriaModel extends BaseModel
{

	function getCriterias($compulsory = 1) {
		return $this->db->criteria->where('compulsory', $compulsory);
	}

	function getCriteria($id) {
		return $this->db->criteria->where('id', $id);
	}

	function insertData($criteriaValue = null, $choiceValues = null) {
		if ($criteriaValue != null) {
			$criteria = $this->db->criteria->insert($criteriaValue);

			if ($criteria) {
				if ($choiceValues != null) {
					foreach ($choiceValues as $choiceValue) {
						$criteria->choice()->insert($choiceValue);
					}
				}
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}

		return true;
	}
	
	function updateCriteria($criteriaValue = null, $choiceValues = null) {
		//if ($criteriaID != null) {
			
			$criteria_id = $criteriaValue['criteria_id'];
			
			$criteriaUpdate = array(
				"criteria_name" => $criteriaValue['criteria_name'],
				"compulsory" => $criteriaValue['compulsory'],
				"criteria_type" => $criteriaValue['criteria_type'],
			);
			
		
		$update1 = $this->db2->prepare("UPDATE criteria SET criteria_name = ? , compulsory=?,criteria_type =? WHERE id = ?");
		$update1->execute(array($criteriaValue['criteria_name'],$criteriaValue['compulsory'],$criteriaValue['criteria_type'],$criteriaValue['criteria_id']));
		//$update1->execute($criteriaUpdate);

		
			if ($choiceValues != null) {
				
						$stmt = $this->db2->prepare("UPDATE choice SET status = ? WHERE criteria_id = ?");
						$stmt->execute(array("disable",$criteria_id));
						
						foreach ($choiceValues as $choiceValue) {
														
							$choiceUpdate = array(
							"choice_name" => $choiceValue['choice_name'],
							"marks" => $choiceValue['marks'],
							"status" => "enable",
							"criteria_id" => $criteria_id,
							);
							
							$choice_id = $choiceValue['choice_id'];
							
							if($choice_id != ""){
				
			$stmt2 = $this->db2->prepare("UPDATE choice SET choice_name=?,marks=?,status=? WHERE id = ?");
			$stmt2->execute(array($choiceValue['choice_name'],$choiceValue['marks'],"enable",$choice_id));

							}
							
							else{
		
			$stmt3 = $this->db2->prepare("INSERT INTO choice (choice_name,marks,status,criteria_id) VALUES (?,?,?,?)");
			$stmt3->execute(array($choiceValue['choice_name'],$choiceValue['marks'],"enable",$criteria_id));

					}		
				}
			}

		return true;
	}
	
	
}