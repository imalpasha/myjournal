<?php
require_once "BaseModel.php";

class FormModel extends BaseModel
{
	function getForms($id = null) {

		if ($id != null) {
			//return $this->db->category->where('id', $id)->fetch();
			$stmt3 = $this->db2->prepare("SELECT e.*,COUNT('category_id') AS counter FROM category_criteria f JOIN category e WHERE e.id = f.category_id AND e.id=? GROUP BY e.id");
			$stmt3->execute(array($id));
			return $result = $stmt3->fetchAll();
		}
		//return $this->db->category->where('status', 'enable');
		$stmt3 = $this->db2->prepare("SELECT e.*,COUNT('category_id') AS counter FROM category_criteria f JOIN category e WHERE e.id = f.category_id AND e.status=? GROUP BY e.id");
		$stmt3->execute(array('enable'));
		return $result = $stmt3->fetchAll();
	}

	function insertData($categoryValue = null, $criteriaValues = null) {
		if ($categoryValue != null) {
			//$category = $this->db->category->insert($categoryValue);
			$stmt3 = $this->db2->prepare("INSERT INTO category (name) VALUES (?)");
			$stmt3->execute(array($categoryValue['name']));						
			$lastInsertID = $this->db2->lastInsertId();			

			if ($lastInsertID != null) {
				if ($criteriaValues != null) {
					foreach ($criteriaValues as $criteriaId) {
						//$this->db->category_criteria()->insert(array('category_id' => $category['id'], 'criteria_id' => $criteriaId));
						$stmt3 = $this->db2->prepare("INSERT INTO category_criteria (category_id,criteria_id) VALUES (?,?)");
						$stmt3->execute(array($category['id'],'criteria_id' => $criteriaId));
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
}