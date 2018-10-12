<?php

return [
	'mode'                  => 'utf-8',
	// 'format'                => '[317,185]',
	'format'                => '',
	'dpi'                   => '72',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'font_path' => public_path('magazine/css/fonts/'),
	'font_data' => [
		'acaslonProregular' => [
			'R'  => 'ACaslonPro-Regular.ttf'   // regular font
		],
		'agaramondpro' => [
			'R'  => 'AGaramondPro-Regular.ttf',
			'I'  => 'AGaramondPro-Italic.ttf'     // optional: italic font
		],
		'arialmt' => [
			'R'  => 'ArialMT.ttf'   // regular font
		],
		'corbel' => [
			'R'  => 'Corbel.ttf',    // regular font
			'B'  => 'Corbel-Bold.ttf',       // optional: bold font
			'I'  => 'Corbel-Italic.ttf',     // optional: italic font
			'BI' => 'Corbel-BoldItalic.ttf' // optional: bold-italic font
		],
		'gothamlight' => [
			'R'  => 'Gotham-Light.ttf'    // regular font
		],
		'gothammedium' => [
			'R'  => 'Gotham-Medium.ttf'    // regular font
		],
		'gothambold' => [
			'R'  => 'Gotham-Bold.ttf'    // regular font
		],
		'gothambook' => [
			'R'  => 'Gotham-Book.ttf'    // regular font
		],
		'helvetica' => [
			'R'  => 'HelveticaLTStd-Cond.ttf'    
		],
		'helveticaneueltstdltcn' => [
			'R'  => 'HelveticaNeueLTStd-LtCn.ttf'    // regular font
		],
		'latoregular' => [
			'R'  => 'Lato-Regular.ttf',    // regular font
			'B'  => 'Lato-Bold.ttf'       // optional: bold font
		],
		'latolight' => [
			'R'  => 'Lato-Light.ttf'    // regular font
		],
		'latomedium' => [
			'R'  => 'Lato-Medium.ttf'    // regular font
		],
		'latosemibold' => [
			'R'  => 'Lato-Semibold.ttf'    // regular font
		],
		'mercurydisplay' => [
			'B'  => 'MercuryDisplay-Bold.ttf',       // optional: bold font
			'I'  => 'MercuryDisplay-Italic.ttf'     // optional: italic font
		],
		'mercuryheadlinenormal' => [
			'R'  => 'MercuryHeadline-Normal.ttf'    // regular font
		],
		'mercurytextg4italic' => [
			'I'  => 'MercuryTextG4-Italic.ttf'    // regular font
		],
		'minionproregular' => [
			'R'  => 'MinionPro-Regular.ttf'    // regular font
		],
		'msgloriolaiistd' => [
			'R'  => 'MSGloriolaIIStd.ttf'    // regular font
		],
		'msgloriolaiistdbold' => [
			'R'  => 'MSGloriolaIIStd-Bold.ttf'    // regular font
		],
		'msgloriolaiistdlight' => [
			'R'  => 'MSGloriolaIIStdLight.ttf'    // regular font
		],
		'msgloriolaiistdmedium' => [
			'R'  => 'MSGloriolaIIStdMedium.ttf'    // regular font
		],
		'neutradisplight' => [
			'R'  => 'NeutraDisp-Light.ttf'    // regular font
		],
		'neutradisptitling' => [
			'R'  => 'NeutraDisp-Titling.ttf'    // regular font
		],
		'neutratextbold' => [
			'R'  => 'NeutraText-Bold.ttf'    // regular font
		],
		'neutratextboldsc' => [
			'R'  => 'NeutraText-BoldSC.ttf'    // regular font
		],
		'neutratextbook' => [
			'R'  => 'NeutraText-Book.ttf'    // regular font
		],
		'neutratextbooksc' => [
			'R'  => 'NeutraText-BookSC.ttf'    // regular font
		],
		'neutratextbookscitalic' => [
			'I'  => 'NeutraText-BookSCItalic.ttf'    // ITALIC font
		],
		'neutratextdemisc' => [
			'R'  => 'NeutraText-DemiSC.ttf'    // regular font
		],
		'neutratextlight' => [
			'R'  => 'NeutraText-Light.ttf'    // regular font
		],
		'neutratextlightalt' => [
			'R'  => 'NeutraText-LightAlt.ttf'    // regular font
		],
		'neutratextlightitalicalt' => [
			'R'  => 'NeutraText-LightItalicAlt.ttf'    // regular font
		],
		'neutratextlightsc' => [
			'R'  => 'NeutraText-LightSC.ttf'    // regular font
		],
		'overpasslight' => [
			'R'  => 'Overpass-Light.ttf'    // regular font
		],
		'uspsimbstandard' => [
			'R'  => 'USPSIMBStandard.ttf'    // regular font
		],
		'verlagblack' => [
			'R'  => 'Verlag-Black.ttf'    // regular font
		],
		'verlagbold' => [
			'R'  => 'Verlag-Bold.ttf'    // regular font
		],
		'verlaglight' => [
			'R'  => 'Verlag-Light.ttf'    // regular font
		],
		'verlagtext' => [
			'R'  => 'Verlag-Text.ttf'    // regular font
		],
		'whitneyblack' => [
			'R'  => 'Whitney-Black.ttf'    // regular font
		],
		'whitneybook' => [
			'R'  => 'Whitney-Book.ttf'    // regular font
		],
		'whitneylight' => [
			'R'  => 'Whitney-Light.ttf'    // regular font
		],
		'whitneymedium' => [
			'R'  => 'Whitney-Medium.ttf'    // regular font
		],
		// ...add as many as you want.
	]
];
