<?php
/// PHP Simple HTML DOM Parser(v1.9.1) - http://simplehtmldom.sourceforge.net/
include('simple_html_dom.php');

// get DOM from URL or file
$html = file_get_html('http://joido.ttk.pte.hu/');

// Kiirja a hőfokot
function homererseklet($adat)
{
    $html = file_get_html('http://joido.ttk.pte.hu/');

    $misi_lekerdezes = $html->find('td[style="padding: 3px;"]', $adat)->innertext;
    $misi_robbanas = explode(" ", $misi_lekerdezes);
    return $misi_robbanas[1];

}

// Kiirja a tendenciát
$misi_hofok_tendencia = $html->find('td[style="padding: 3px;"]', 12)->innertext;

// Kiirja a mintavételezés idejét
$misi_mintavetelezes_lekerdezes = $html->find('td[width=580]', 0)->innertext;
$misi_mintavetelezes_robbanas = preg_split('/(<br>|:|\*|=)/', $misi_mintavetelezes_lekerdezes, -1, PREG_SPLIT_NO_EMPTY);
$misi_mintavetelezes = $misi_mintavetelezes_robbanas[1] . ":" . $misi_mintavetelezes_robbanas[2];


// Hőmérő kiválasztása
if (homererseklet(11) != "nincsadat") {
    // Ta	Léghőmérséklet
    $misi_hofok = homererseklet(11);
    $misi_hofok_backup = false;

} else {
    // Ta2	tartalék hőmérő
    $misi_hofok = homererseklet(14);
    $misi_hofok_backup = true;

}


// JSON generálás
$myObj = null;
$myObj->misi_hofok = $misi_hofok;
$myObj->misi_hofok_backup = $misi_hofok_backup;
$myObj->misi_hofok_tendencia = $misi_hofok_tendencia;
$myObj->misi_varos = "Pécs";
$myObj->misi_mintavetelezes_ideje = $misi_mintavetelezes;

$myJSON = json_encode($myObj);

// JSON renderelés
echo $myJSON;


?>
