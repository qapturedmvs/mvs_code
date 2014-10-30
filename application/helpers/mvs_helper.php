<?php

function btnType( $uri, $type = null, $events = null ){
	$html;
	switch( $type ){
		case 'edit':
			$html = '<i class="icon-edit">EDIT</i>';
			break;
		case 'remove':
			$html = '<i class="icon-remove">REMOVE</i>';
			break;
		default:
			$html = '';
	}
	return anchor($uri, $html, $events);
}
