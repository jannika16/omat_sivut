<?php
if (empty($GET)) {
  die("...");
}

  $nimi = $_GET['nimi'];
  $pvm = $_GET['pvm'];
  $kuvaus = $_GET['kuvaus'];

  $errors = array();

  if (empty($nimi)) $errors[] = 'Anna nimi!';
  if (empty($pvm)) $errors[] = 'Anna päivämäärä!';
  if (empty($kuvaus)) $errors[] = 'Anna kuvaus!';

  if (!empty($errors)) {
    $output = '<ul><li>' . implode('</li><li>',$errors) . '</li></ul>';
  } else {
    $output = '...';

    $xml = simplexml_load_file('data/projekti.xml');
    $uusiprojetki = $xml->addChild('projekti');
    $uusiprojekti->addChild('nimi', $nimi);
    $uusiprojekti->addChild('pvm', $pvm);
    $uusiprojekti->addChild('kuvaus', $kuvaus);

    $dom = new DOMDocument("1.0");
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());
    $dom->save('data/projekti.xml');
  }

  header('refresh:2;url=projektit.html');
  echo $output;
 ?>
