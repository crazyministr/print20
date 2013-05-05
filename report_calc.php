<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ReportCalc
{
	private $data;
	private $depth = array();
	private $xml_parser;
	private $error;
	private $error_line;

	function startElement($parser, $name, $attrs) 
	{
		$data['name'] = $name;
		$data['attrs'] = $attrs;
		$depth[$parser]++;
	}
	
	function endElement($parser, $name) 
	{
		$depth[$parser]--;
	}
	
	function valueElement($parser, $value)
	{
		$data[$value] = $value;
	}

	function __construct($file)
	{
		$xml_parser = xml_parser_create();
		xml_set_element_handler($xml_parser, "startElement", "endElement");
		xml_set_character_data_handler($xml_parser, "valueElement");
		if (!($fp = fopen($file, "r"))) {
			$error = "xml is unavailable for read";
			exit();
		}
	
		while ($data = fread($fp, 4096)) {
		    if (!xml_parse($xml_parser, $data, feof($fp))) {
			$error  = xml_error_string(xml_get_error_code($xml_parser));
			$line_error = xml_get_current_line_number($xml_parser);
			exit();
		    }
		}
		fclose($fp);
		xml_parser_free($xml_parser);
	}
}
?>
