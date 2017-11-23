<?php
if (empty($_GET)) {
  die("Ei toimi!!!");
}

  $nimi = $_GET['nimi'];
  $pvm = $_GET['pvm'];
  $kuvaus = $_GET['kuvaus'];
  // $kuva = $_GET['kuva'];

  $errors = array();

  if (empty($nimi)) $errors[] = 'Anna nimi!';
  if (empty($pvm)) $errors[] = 'Anna päivämäärä!';
  if (empty($kuvaus)) $errors[] = 'Anna kuvaus!';
  // if (empty($kuva)) $errors[] = 'Anna kuva!';

  if (!empty($errors)) {
    $output = '<ul><li>' . implode('</li><li>',$errors) . '</li></ul>';
  } else {
    $output = '...';

    $xml = simplexml_load_file('data/projekti.xml');
    $uusiprojekti = $xml->addChild('projekti');
    $uusiprojekti->addChild('nimi', $nimi);
    $uusiprojekti->addChild('pvm', $pvm);
    $uusiprojekti->addChild('kuvaus', $kuvaus);
    // $uusiprojekti->addChild('kuva', $kuva);

    $dom = new DOMDocument("1.0");
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());
    $dom->save('data/projekti.xml');


  }

  header('refresh:2;url=projektit.html');
  echo $output;
 ?>
