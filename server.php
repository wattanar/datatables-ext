<?php 

class Datatables {

  public function filter($filterData, $filter = null) {
    $search = [];
  
    if (count($filterData) > 0) {
      foreach ($filterData['columns'] as $s) {
        if ($s['search']['value'] !== '') {
          $search[] = [
            'field' => self::field($s['data'], $filter),
            'value' => $s['search']['value'],
            'type'  => $s['name']
          ];
        }
      }
    }
    
    if (count($search) > 0) {
      $query = '';
      foreach ($search as $q) {
        if ($q['type'] === 'date') {
          $query .= ' ' . htmlspecialchars( "CONVERT(VARCHAR, ".$q['field']." , 120)" ) . ' LIKE \'%' . htmlspecialchars($q['value']) . '%\' AND ';
        }else{
          $query .= ' ' . htmlspecialchars($q['field']) . ' LIKE \'%' . htmlspecialchars($q['value']) . '%\' AND ';
        }
      }
      return trim($query, ' AND ');
  
    } else {
      return ' 1=1 ';
    }
  }

  function field($col, $filter) {
    if ($filter !== null) {
      if (isset($filter[$col])) {
        return $filter[$col];
      } else {
        return $col;
      }
    } else {
      return $col;
    }
  }

  function format($data, $search) {

    if ( isset($search['order']) ) {
      if ($search['order'][0]['dir'] === 'asc') {
        ksort($data);
      } else {
        krsort($data);
      }
    }
    
    if (!isset($search['draw'])) {
			$search['draw'] = 1;
		}

		if (!isset($search['start'])) {
			$search['start'] = 0;
		}

		if (!isset($search['length'])) {
			$search['length'] = 10;
		}
  
    return [
      'draw' => (int)$search['draw'],
      'recordsTotal' => count($data),
      'recordsFiltered' => count($data),
      "data" => array_slice($data, $search['start'], $search['length'])
    ];
  }
}
