<?php

/**
 * 返回layui需要的json格式
 */
function layui_json($code = 200, $msg = "success",$data = array(),  $count = 0)
{
    $list = ['code' => $code,'msg' => $msg, 'data' => $data, 'count' => $count];
    return json_encode($list);
}
	
	
	/**
	 * 后台筛选处理方法
	 * @param $filterSos
	 * @param $sql
	 * @param bool $first
	 * @param array $field
	 * @return string
	 */
	function proSearchParam($filterSos, $sql, $first = false, $field = [])
{
	foreach ($filterSos as $item) {
		if(isset($item['values']) && empty($item['values'])){
			//设置了values并且为空则跳出
			continue;
		}
		
		if(isset($item['value']) && empty($item['value'])){
			//设置了value并且为空则跳出
			continue;
		}
		
		//改写字段所属表
		if($item['mode'] != "group") {
//			$item['field'] = isset($field[$item['field']]) ? $field[$item['field']] . '.' . $item['field'] : 'A.' . $item['field'];
			$item['field'] = isset($field[$item['field']]) ? $field[$item['field']] . '.' . $item['field'] : $item['field'];
		}else{
			if(count($item['children']) == 0){
				continue;
			}
		}
		
		if($item['prefix'] == "and"){
			if($first){
				$sql .= " (";
			}else {
				$sql .= " AND (";
			}
		}else{
			$sql .= " OR (";
		}
		
		switch ($item['mode']) {
			case "in" :
				{
					$str = implode('","', $item['values']);
					$sql .= $item['field'] . ' in ("' . $str . '"))';
					break;
				}
			case "condition" :
				{
					if ($item['type'] == "contain") {
						$sql .= $item['field'] . " like " . "'%" . $item['value'] . "%'" . ")";
					} else if ($item['type'] == "notContain") {
						$sql .= $item['field'] . " not like " . "'%" . $item['value'] . "%'" . ")";
					} else if ($item['type'] == "start") {
						$sql .= $item['field'] . " like '" . $item['value'] . "%'" . ")";
					} else if ($item['type'] == "end") {
						$sql .= $item['field'] . " like '" . "%" . $item['value'] . "')";
					} else if ($item['type'] == "eq") {
						$item['value'] = is_numeric($item['value']) ? $item['value'] : "'" . $item['value'] . "'";
						$sql .= $item['field'] . " = " . $item['value'] . ")";
					} else if ($item['type'] == "ne") {
						$item['value'] = is_numeric($item['value']) ? $item['value'] : "'" . $item['value'] . "'";
						$sql .= $item['field'] . " <> " . $item['value'] . ")";
					} else if ($item['type'] == "gt") {
						$item['value'] = is_numeric($item['value']) ? $item['value'] : "'" . $item['value'] . "'";
						$sql .= $item['field'] . " > " . $item['value'] . ")";
					} else if ($item['type'] == "ge") {
						$item['value'] = is_numeric($item['value']) ? $item['value'] : "'" . $item['value'] . "'";
						$sql .= $item['field'] . " >= " . $item['value'] . ")";
					} else if ($item['type'] == "lt") {
						$item['value'] = is_numeric($item['value']) ? $item['value'] : "'" . $item['value'] . "'";
						$sql .= $item['field'] . " < " . $item['value'] . ")";
					} else if ($item['type'] == "le") {
						$item['value'] = is_numeric($item['value']) ? $item['value'] : "'" . $item['value'] . "'";
						$sql .= $item['field'] . " <= " . $item['value'] . ")";
					} else {
						$sql .= $item['field'] . $item['value'] . ")";
					}
					break;
				}
			case "date" :
				{
					if ($item['type'] == "yesterday") {
						$sql .= $item['field'] . " between '" . strtotime(date("Y-m-d 00:00:00", strtotime("-1 day"))) . "' AND '" . strtotime(date("Y-m-d 23:59:59")) . "')";
					} else if ($item['type'] == "thisWeek") {
						$sql .= $item['field'] . " between '"
							. strtotime(date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y"))))
							. "' AND '"
							. strtotime(date("Y-m-d H:i:s", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y"))))
							. "')";
					} else if ($item['type'] == "lastWeek") {
						$sql .= $item['field'] . " between '"
							. strtotime(date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d") - date("w") - 7, date("Y"))))
							. "' AND '"
							. strtotime(date("Y-m-d H:i:s", mktime(23, 59, 59, date("m"), date("d") - date("w"), date("Y"))))
							. "')";
					} else if ($item['type'] == "thisMonth") {
						$sql .= $item['field'] . " between '"
							. strtotime(date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), 1, date("Y"))))
							. "' AND '"
							. strtotime(date("Y-m-d H:i:s", mktime(23, 59, 59, date("m"), date("t"), date("Y"))))
							. "')";
					} else if ($item['type'] == "thisYear") {
						$sql .= $item['field'] . " between '"
							. strtotime(date('Y-01-01'))
							. "' AND '"
							. strtotime(date('Y-12-31'))
							. "')";
					} else if ($item['type'] == "specific") {
						//指定时间
						$sql .= $item['field'] . " between '" . strtotime($item['value'] . " 00:00:00")
							. "' AND '"
							. strtotime($item['value'] . " 23:59:59")
							. "')";
					} else if ($item['type'] == "exclude") {
						//排除时间
						$sql .= $item['field'] . " not between '" . strtotime($item['value'] . " 00:00:00")
							. "' AND '"
							. strtotime($item['value'] . " 23:59:59")
							. "')";
					} else if ($item['type'] == "specificSlot") {
						//指定时间段
						$sql .= $item['field'] . " between '" . strtotime(explode(' ~ ', $item['value'])[0])
							. "' AND '"
							. strtotime(date("Y-m-d 23:59:59", strtotime(explode(' ~ ', $item['value'])[1])))
							. "')";
					} else if ($item['type'] == "excludeSlot") {
						//排除时间段
						$sql .= $item['field'] . " not between '" . strtotime(explode(' ~ ', $item['value'])[0])
							. "' AND '"
							. strtotime(date("Y-m-d 23:59:59", strtotime(explode(' ~ ', $item['value'])[1])))
							. "')";
					} else if ($item['type'] == "all") {
						$sql .= "1" . "=" . 1 . ")";
					}
					break;
				}
			case "group" :
				{
					$sql = proSearchParam($item['children'], $sql, true, $field) . ")";
					break;
				}
		}
		$first = false;
	}
	return $sql;
}
