<?php
require_once "BaseModel.php";

class FormModel extends BaseModel
{
	function getForms($id = null) {

		if ($id != null) {
			return $this->db->category->where('id', $id)->fetch();
		}
		return $this->db->category->where('status', 'enable');
	}

	function insertData($categoryValue = null, $criteriaValues = null) {
		if ($categoryValue != null) {
			$category = $this->db->category->insert($categoryValue);

			if ($category) {
				if ($criteriaValues != null) {
					foreach ($criteriaValues as $criteriaId) {
						$this->db->category_criteria()->insert(array('category_id' => $category['id'], 'criteria_id' => $criteriaId));
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