<?php 

/*******************************************************************************************/
/*
/*		Designed by 'AS Designing'
/*		Web: http://www.asdesigning.com
/*		Web: http://www.astemplates.com
/*		License: ASDE Commercial
/*
/*******************************************************************************************/


function googleFontChooser($fontfamily)
{
	
	$google_font = array('fontlink'=>false, 'fontfamily'=>false);
	
	switch($fontfamily)
	{
		case 'Acme':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Acme&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Acme', Arial, serif;";
			break;	
		case 'Advent Pro:100':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Advent+Pro:100&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Advent Pro', Arial, serif; font-weight: 100;";
			break;	
		case 'Advent Pro:200':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Advent+Pro:200&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Advent Pro', Arial, serif; font-weight: 200;";		
			break;	
		case 'Advent Pro:300':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Advent+Pro:300&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Advent Pro', Arial, serif; font-weight: 300;";		
			break;	
		case 'Advent Pro:400':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Advent+Pro:400&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Advent Pro', Arial, serif; font-weight: 400;";		
			break;	
		case 'Advent Pro:500':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Advent+Pro:500&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Advent Pro', Arial, serif; font-weight: 500;";		
			break;	
		case 'Advent Pro:600':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Advent+Pro:600&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Advent Pro', Arial, serif; font-weight: 600;";		
			break;	
		case 'Advent Pro:700':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Advent+Pro:700&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Advent Pro', Arial, serif; font-weight: 700;";		
			break;	
		case 'Arimo:400':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Arimo:400&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Arimo', Arial, serif; font-weight: 400;";		
			break;	
		case 'Arimo:400italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Arimo:400italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Arimo', Arial, serif; font-weight: 400; font-style: italic;";				
			break;	
		case 'Arimo:700':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Arimo:700&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Arimo', Arial, serif; font-weight: 700;";						
			break;	
		case 'Arimo:700italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Arimo:700italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Arimo', Arial, serif; font-weight: 700; font-style: italic;";						
			break;	
		case 'Average':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Average&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Average', Arial, serif;";
			break;	
		case 'BenchNine:700':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=BenchNine:700&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'BenchNine', Arial, serif; font-weight: 700;";
			break;	
		case 'BenchNine:400':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=BenchNine:400&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'BenchNine', Arial, serif; font-weight: 400;";
			break;	
		case 'BenchNine:300':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=BenchNine:300&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'BenchNine', Arial, serif; font-weight: 300;";
			break;	
		case 'Convergence':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Convergence&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Convergence', Arial, serif;";
			break;	
		case 'Cuprum:400':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Cuprum:400&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Cuprum', Arial, serif; font-weight: 400;";
			break;	
		case 'Cuprum:400italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Cuprum:400italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Cuprum', Arial, serif; font-weight: 400; font-style: italic;";
			break;	
		case 'Cuprum:700':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Cuprum:700&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Cuprum', Arial, serif; font-weight: 700;";
			break;	
		case 'Cuprum:700italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Cuprum:700italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Cuprum', Arial, serif; font-weight: 700; font-style: italic;";
			break;	
		case 'Exo:100':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:100&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 100;";
			break;	
		case 'Exo:100italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:100italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 100; font-style: italic;";
			break;	
		case 'Exo:200':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:200&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 200;";
			break;	
		case 'Exo:200italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:200italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 200; font-style: italic;";
			break;	
		case 'Exo:300':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:300&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 300;";
			break;	
		case 'Exo:300italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:300italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 300; font-style: italic;";
			break;	
		case 'Exo:400':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:400&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 400;";
			break;	
		case 'Exo:400italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:400italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 400; font-style: italic;";
			break;	
		case 'Exo:500':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:500&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 500;";
			break;	
		case 'Exo:500italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:500italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 500; font-style: italic;";
			break;	
		case 'Exo:600':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:600&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 600;";
			break;	
		case 'Exo:600italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:600italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 600; font-style: italic;";
			break;	
		case 'Exo:700':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:700&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 700;";
			break;	
		case 'Exo:700italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:700italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 700; font-style: italic;";
			break;	
		case 'Exo:800':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:800&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 800;";
			break;																																																															
		case 'Exo:800italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:800italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 800; font-style: italic;";
			break;	
		case 'Exo:900':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:900&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 900;";
			break;	
		case 'Exo:900italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Exo:900italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Exo', Arial, serif; font-weight: 900; font-style: italic;";
			break;	
		case 'Fredoka One':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Fredoka+One&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Fredoka One', Arial, serif;";
			break;	
		case 'Hammersmith One':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Hammersmith+One&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Hammersmith One', Arial, serif;";
			break;	
		case 'Homenaje':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Homenaje&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Homenaje', Arial, serif;";
			break;	
		case 'Jockey One':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Jockey+One&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Jockey One', Arial, serif;";
			break;	
		case 'Jura:300':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Jura:300&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Jura', Arial, serif; font-weight: 300;";
			break;	
		case 'Jura:400':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Jura:400&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Jura', Arial, serif; font-weight: 400;";
			break;	
		case 'Jura:500':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Jura:500&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Jura', Arial, serif; font-weight: 500;";
			break;	
		case 'Jura:600':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Jura:600&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Jura', Arial, serif; font-weight: 600;";
			break;	
		case 'Macondo':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Macondo&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Macondo', Arial, serif;";
			break;	
		case 'Marmelad':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Marmelad&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Marmelad', Arial, serif;";
			break;
		case 'Michroma':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Michroma&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Michroma', sans-serif; ";
			break;				
		case 'Montserrat':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Montserrat&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Montserrat', Arial, serif;";
			break;	
		case 'Muli:300':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Muli:300&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Muli', Arial, serif; font-weight: 300;";
			break;	
		case 'Muli:300italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Muli:300italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Muli', Arial, serif; font-weight: 300; font-style: italic;";
			break;	
		case 'Muli:400':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Muli:400&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Muli', Arial, serif; font-weight: 400;";
			break;	
		case 'Muli:400italic':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Muli:400italic&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Muli', Arial, serif; font-weight: 400; font-style: italic;";
			break;	
		case 'Numans':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Numans&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Numans', Arial, serif;";
			break;	
		case 'Oxygen':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Oxygen&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Oxygen', Arial, serif;";
			break;	
		case 'Pontano Sans':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Pontano+Sans&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Pontano Sans', Arial, serif;";
			break;	
		case 'Prosto One':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Prosto+One&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Prosto One', Arial, serif;";
			break;	
		case 'Russo One':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Russo+One&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Russo One', Arial, serif;";
			break;	
		case 'Salsa':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Salsa&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Salsa', Arial, serif;";
			break;	
		case 'Signika:300':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Signika:300&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Signika', Arial, serif; font-weight: 300;";
			break;	
		case 'Signika:400':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Signika:400&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Signika', Arial, serif; font-weight: 400;";
			break;	
		case 'Signika:600':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Signika:600&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Signika', Arial, serif; font-weight: 600;";
			break;	
		case 'Signika:700':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Signika:700&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Signika', Arial, serif; font-weight: 700;";
			break;	
		case 'Six Caps':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Six+Caps&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Six Caps', Arial, serif;";
			break;	
		case 'Tulpen One':
			$google_font['fontlink'] = "<link href='http://fonts.googleapis.com/css?family=Tulpen+One&subset=latin,cyrillic,greek' rel='stylesheet' type='text/css'>";
			$google_font['fontfamily'] = "font-family: 'Tulpen One', Arial, serif;";
			break;	
		default:
			$google_font['fontlink'] = false;
			$google_font['fontfamily'] = "font-family: " . $fontfamily . ';';
	} 

	return $google_font;
}



?>

