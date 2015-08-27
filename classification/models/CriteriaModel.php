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
			
			echo $criteria_id = $criteriaValue['criteria_id'];
			
			$criteriaUpdate = array(
				"criteria_name" => $criteriaValue['criteria_name'],
				"compulsory" => $criteriaValue['compulsory'],
				"criteria_type" => $criteriaValue['criteria_type'],
			);
			
			$x = $this->db->criteria->where("id=?",$criteria_id)->fetch();

			if($x)
			{
				$criteria = $x->update($criteriaUpdate);
				$criteria = $x->update($criteriaUpdate);

			}
			if ($choiceValues != null) {
						
						$z = $this->db->choice->where("criteria_id=?",$criteria_id);
						$disableAllRelated = array(
							"status" => 'disable',
						);
						if($z){
							$h = $z->update($disableAllRelated);
						}
						
						foreach ($choiceValues as $choiceValue) {
							
							//print_r($choiceValue);
							
							$choiceUpdate = array(
							"choice_name" => $choiceValue['choice_name'],
							"marks" => $choiceValue['marks'],
							"status" => "enable",
							"criteria_id" => $criteria_id,
							);
							
							
							echo $choice_id = $choiceValue['choice_id'];
							if($choice_id != ""){
								$y = $this->db->choice->where("id=?",$choice_id)->fetch();
								$k = $y->update($choiceUpdate);
							}
							else{
								$v = $this->db->choice->insert($choiceUpdate);
							}
							
						}
			}

		return true;
	}
	
	
}