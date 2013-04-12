<?php
	require_once 'xml2array.php';

	$xml = file_get_contents("materials.xml");
	$xml_tags = xml2array($xml);
	$density = array();
	$cnt_paper = $cnt_carton = $cnt_offset = 0;
    foreach ($xml_tags as $key => $value) {
    	foreach ($value as $key1 => $value1)
    		if ($key1 == 'attrs')
    		{
    			$d = (int) $value1['density'];
    			if ($value1['type'] == 'paper')
    			{
    				if (!$paper[$d])
    				{
    					$paper[$d] = true;
    					$density['paper'][$cnt_paper++] = $d;
    				}
    			}
    			if ($value1['type'] == 'carton')
    			{
    				if (!$carton[$d])
    				{
    					$carton[$d] = true;
    					$density['carton'][$cnt_carton++] = $d;
    				}
    			}
    			if ($value1['type'] == 'offset')
    			{
    				if (!$offset[$d])
    				{
    					$offset[$d] = true;
    					$density['offset'][$cnt_offset++] = $d;
    				}
    			}
    		}
    }
    sort($density['paper']);
    sort($density['carton']);
    sort($density['offset']);
?>
