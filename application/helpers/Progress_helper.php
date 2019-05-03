<?php
if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'getProgress' ) ) {
	function getProgress( $status ) {
		switch ($status){
			case 'proses':
				$percent = 20;
				break;
			case 'cetak':
				$percent = 30;
				break;
			case 'kirim':
				$percent = 50;
				break;
			case 'terima':
				$percent = 99;
				break;
			case 'tolak':
				$percent = 90;
				break;
			default : $percent = 100;
		}
		return $percent;
	}
}