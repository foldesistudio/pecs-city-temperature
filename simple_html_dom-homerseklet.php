<?php
/// PHP Simple HTML DOM Parser(v1.8.1) - http://simplehtmldom.sourceforge.net/
	include('simple_html_dom.php');		
	
	// get DOM from URL or file
		$html = file_get_html('http://joido.ttk.pte.hu/');
		
	// Kiirja a hőfokot
		$misi_lekerdezes = $html->find('td[style="padding: 3px;"]', 11)->innertext;
		$misi_nevnap_robbanas = explode(" ", $misi_lekerdezes);
		$misi_hofok = $misi_nevnap_robbanas[1];

	// Kiirja a tendenciát
		$misi_hofok_tendencia = $html->find('td[style="padding: 3px;"]', 12)->innertext;

	// Kiirja a mintavételezés idejét
		$misi_mintavetelezes_lekerdezes = $html->find('td[width=580]', 0)->innertext;	
		$misi_mintavetelezes_robbanas = preg_split('/(<br>|:|\*|=)/', $misi_mintavetelezes_lekerdezes,-1, PREG_SPLIT_NO_EMPTY);
		$misi_mintavetelezes = $misi_mintavetelezes_robbanas[1] . ":" . $misi_mintavetelezes_robbanas[2];


	// JSON generálás
	
$myObj->misi_hofok = $misi_hofok;
$myObj->misi_hofok_tendencia = $misi_hofok_tendencia;
$myObj->misi_varos = "Pécs";
$myObj->misi_mintavetelezes_ideje = $misi_mintavetelezes;

$myJSON = json_encode($myObj);

	// JSON renderelés
echo $myJSON;


		?>