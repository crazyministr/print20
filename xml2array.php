<?php

function xml2array( $xml ) {
	$tags = array();
	$c = $cn = $curAttr = $curAttrVal = '';
	$inTag = $inTagName = $inAttr = $inAttrName = $inAttrVal = $inText = false;
	$p = $i = -1;
	$len = strlen( $xml );
	$tag = $empty_tag = array( 'name' => '', 'text' => '', 'attrs' => array() );
	while ($i < $len ) {
		$i++;
		$c = $xml{$i};
		if ($i<$len-1)
			$cn = $xml{$i+1};
		 else
			$cn = chr(0);
		
		if ($c == '<' && $cn == '?') {
			$p = strpos($xml, '>', $i);
			if ($p === false) return $tags;
			$i = $p+1;
			continue;
		}
		if ($c == '<' && $cn == '/') {
			if ($tag['name'] != '') {
				$tag['text'] = trim(html_entity_decode($tag['text'],ENT_QUOTES));
				$tags[] = $tag;
			}
			$p = strpos($xml, '>', $i);
			if ($p === false) return $tags;
			$i = $p;
			$inTag = false;
			$inText = false;
			$tag = $empty_tag;
			continue;
		}
	
		if ($c == '<') {
			if ($tag['name'] != '') {
				$tag['text'] = trim(html_entity_decode($tag['text'],ENT_QUOTES));
				$tags[] = $tag;
			}
			$inTag = true;
			$inTagName = true;
			$inAttr = false;
			$inAttrName = false;
			$inAttrVal = false;
			$inText = false;
			$tag = $empty_tag;
			continue;
		}
		if ($c == ' ' && $inTag) {
			if ($inTagName) {
				$inTagName = false;
				$inAttr = true;
				$inAttrName = true;
				$inAttrVal = false;
				continue;
			} else if ( !$inAttr ) {
				$inAttr = true;
				$inAttrName = true;
				$inAttrVal = false;
				continue;
			}
		}
		if ( $c == '=' && $inAttrName) {
			$inAttrName = false;
			$inAttrVal = false;
			continue;
		}
		if ($c == '"' && $inAttr) {
			if ($inAttrVal) {
				$tag['attrs'][$curAttr] = html_entity_decode($curAttrVal,ENT_QUOTES);
				$curAttr = '';
				$curAttrVal = '';
				$inAttr = false;
				$inAttrName = false;
				$inAttrVal = false;
			} else {
				$inAttrVal = true;
			}
			continue;
		}
		if ($c == '>' && $inTag) {
			$inTag = false;
			$inTagName = false;
			$inText = true;
			continue;
		}
		if ($c == '/' && $cn == '>') {
			if ($tag['name'] != '') {
				$tags[] = $tag;
				$tag = $empty_tag;
			}
			$i++;
			continue;
		}
		if ($c == '>') {
			$inTag = false;
			$inTagName = false;
			$inText = true;
			continue;
		}
	
		if ($inTagName) $tag['name'] .= $c;
		else if ($inAttrName && $c != ' ') $curAttr .= $c;
		else if ($inAttrVal) $curAttrVal .= $c;
		else if ($inText) $tag['text'] .= $c;
	}
	return $tags;
}
/*

$xml = '<?xml version="1.0" standalone="yes"?>
<root rootattr="value" rootattr2="value&lt;encoded&gt;">
	<node>
		<id>1234</id>
		<name>Name</name>
	</node>
	<node attr="node attr" attr2="node attr &amp; &quot;qoted&quot; value">
		&quot;Quoted&quot; text
	</node>
</root>';

$xml_tags = xml2array($xml);

echo '<pre>'.print_r($xml_tags,true).'</pre>';

//
Array
(
    [0] => Array
        (
            [name] => root
            [text] => 
            [attrs] => Array
                (
                    [rootattr] => value
                    [rootattr2] => value
                )

        )

    [1] => Array
        (
            [name] => node
            [text] => 
            [attrs] => Array
                (
                )

        )

    [2] => Array
        (
            [name] => id
            [text] => 1234
            [attrs] => Array
                (
                )

        )

    [3] => Array
        (
            [name] => name
            [text] => Name
            [attrs] => Array
                (
                )

        )

    [4] => Array
        (
            [name] => node
            [text] => "Quoted" text
            [attrs] => Array
                (
                    [attr] => node attr
                    [attr2] => node attr & "qoted" value
                )

        )

)
*/

?>
