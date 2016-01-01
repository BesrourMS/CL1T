<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
require('simpledom.php');
$html = new simple_html_dom();
$html->load_file('http://www.mosaiquefm.net/fr/sport/classement');

$classement = $html->find('.classementList table tr');
$i=0;

foreach($classement as $n) {
    /**
     * @var simple_html_dom_node $n;
     */

 if($i++ < 1) continue ;

    $tds = $n->find('td');
	$ths = $n->find('th');
	
	$string = trim($tds[0]->innertext);
	preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', $string, $result);
	$logo = array_pop($result);
	
    $arrayclassement[] = array(
		'Position' => trim(strip_tags($ths[0]->innertext)),
        'Logo' => $logo,
		'Equipe' => trim(strip_tags($ths[1]->innertext)),
        'Points' =>  trim(strip_tags($tds[1]->innertext)),
        'J' =>  trim(strip_tags($tds[2]->innertext)),
        'G' =>  trim(strip_tags($tds[3]->innertext)),
        'N' =>  trim(strip_tags($tds[4]->innertext)),
        'D' =>  trim(strip_tags($tds[5]->innertext)),
        'BE' =>  trim(strip_tags($tds[6]->innertext)),
        'BM' =>  trim(strip_tags($tds[7]->innertext)),
        'DB' =>  trim(strip_tags($tds[8]->innertext)),
    );
}
header("Content-type: application/json; charset=utf-8");
print_r(json_encode($arrayclassement));
?>