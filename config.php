<?php

	$config = array(
		'version'		=> '1.0',
		'inputDir'		=> './input',
		'outputDir'		=> './output'
	);

	if(!file_exists($config['inputDir'])) {
		mkdir($config['inputDir']);
	}
	if(!file_exists($config['outputDir'])) {
		mkdir($config['outputDir']);
	}