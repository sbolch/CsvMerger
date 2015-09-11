<?php

if($_POST) {
	require('./config.php');

	$mode = $_POST['mode'];

	$_SESSION['oFilePath'] = $config['outputDir'];
	$_SESSION['oFileName'] = $_POST['main-input-file'];

	$lists = array();

	foreach(
		array(
			'main-input-file',
			'second-input-file'
		) as $fileId
	) {
		$iFile = fopen($config['inputDir'].'/'.$_POST[$fileId], 'r');
		$lists[$fileId] = array();
		while($lists[$fileId][] = fgetcsv($iFile));
		fclose($iFile);
	}

	switch($mode) {
		case 'del':
		default:
			delMode($lists);
			break;
	}
} else {
	header("location:.");
}

function delMode($lists) {
	$unsure = array();

	foreach($lists['main-input-file'] as $key => $line) {
		foreach($lists['second-input-file'] as $cLine) {
			if($line[0] == $cLine[0] || $line[1] == $cLine[0]) {
				/*if($line[1] != $cLine[1]) {
					$unsure[] = '#'.($key+1).': '.implode(',', $line);
				} else {*/
					unset($lists['main-input-file'][$key]);
				//}
			}
		}
	}

	saveOutput($lists['main-input-file']);

	$_SESSION['msg'] = 'Feladat befejezve.';
	$_SESSION['unsure'] = $unsure;

	header("location:.");
}

function saveOutput($list) {
	$fp = fopen($_SESSION['oFilePath'].'/'.date('ymdHis').'_'.$_SESSION['oFileName'], 'w');

	foreach($list as $line) {
		fputcsv($fp, $line);
	}

	unset($_SESSION['oFilePath']);
	unset($_SESSION['oFileName']);

	fclose($fp);
}