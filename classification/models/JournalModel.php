<?php
require_once "BaseModel.php";

class JournalModel extends BaseModel
{

	function getJournals($limit = 0, $offset = 0, $search = '') {
		if ($search != '') {
			return $this->db->journals()->where('name LIKE ?', '%' . $search .'%')->limit($limit, $offset);
		}
	
		return $this->db->journals()->limit($limit, $offset);
	}
	
	function getJournalsFullList($search = '') {
	if ($search != '') {
			return $this->db->journals()->where('name LIKE ?', '%' . $search .'%');
		}
		return $this->db->journals();
	}

	function getJournal($id) {
		return $this->db->journals[$id];
	}

	function getCount($search = '') {
		if ($search != '') {
			return $this->db->journals()->where('name LIKE ?', '%' . $search .'%')->count();
		}

		return $this->db->journals()->count();
	}

	function getDiscipline($id) {
		$discipline = $this->db->disciplines()->where('dis_id', $id)->fetch();
		return $discipline['dis_desc'];
	}
}