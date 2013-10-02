<?php

if(isset($_GET['isbn'])) {
	header("location: http://koha.institution.edu/cgi-bin/koha/opac-search.pl?idx=nb&q=" . $_GET['isbn']);
}
else if(isset($_GET['rft_btitle'])) {
	header("location: http://koha.institution.edu/cgi-bin/koha/opac-search.pl?idx=ti&q=" . $_GET['rft_btitle']);
}
else if ($_GET['genre'] == 'book' && isset($_GET['title'])) {
	header("location: http://koha.institution.edu/cgi-bin/koha/opac-search.pl?idx=ti&q=" . $_GET['title']);
}
else {
	$query = array();
	$cleanQuery = array();
	parse_str($_SERVER['QUERY_STRING'], $query);
	// quick fix for Oxford url resolver
	foreach($query as $k => $v) {
		$newKey = str_ireplace('rft_', '', str_ireplace('rft.', '', $k));

		$cleanQuery[$newKey] = $v;
	}
	if(! isset($cleanQuery['issn'])) {
		$cleanQuery['genre'] = 'journal';
	}
	header("location: http://godot.institution.edu/godot/hold_tab.cgi?" . http_build_query($cleanQuery));
}
