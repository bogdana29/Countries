<?php
$xmlFile = './docs/countries.xml';
$xsltFile = './docs/countries.xsl';
/** deoarece  PHP suporta XSLT Procesor v1.0 am modificat folosind preg_replace_callback  fisierul xml primit si am transformat 
 * linkurile map_url in 2 atribute logitudine, respectiv latitudine
 */
function transfFisier(){
    global $xmlFile;
    if(!file_exists($xmlFile)) {
        echo "Nu pot exista fisierul in calea specificata  ".$xmlFile;
        exit;
    } 
     
    try{
        $xmlDoc = file_get_contents($xmlFile);    
        $logitudineSiLatitudine = "/(.+@((-?\d{1,2}.\d{6,7}),(-?\d{1,2}.\d{7})),.+)/";

        $xmlDoc= preg_replace_callback(
            $logitudineSiLatitudine,
           "logitudine_latitudine",
           $xmlDoc);
        return $xmlDoc;         
    }catch(\Exception $ee){
        echo "Eroare parsare fisier".$ee.getMessage();

    }
}
/**  */
function logitudine_latitudine($matches)
{
  return "<logitudine>".$matches[3]."</logitudine><latitudine>".$matches[4]."</latitudine>";
  
}
 
/**prelucrare XML cu processor XSLT 1.0 default ptr PHP */
function prelucreazadate(){
    global $xmlFile, $xsltFile;
    
    $xmlDoc = transfFisier();
    //echo "<br>xmlDoc" .$xmlDoc."<br> gata fisier";
   /* if(!file_exists($xmlFile)) {
        echo "No such file ".$xmlFile;
        exit;
    } */
    if(!file_exists($xsltFile)) {
        echo "Nu pot exista fisierul xsl ".$xsltFile;
        exit;
    } 
    try{
        //$xmlDoc = file_get_contents($xmlFile);    
        //echo "<br>xmlDoc" .$xmlDoc."<br> gata fisier original";
        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->loadXML($xmlDoc);
        $xslDoc = new \DOMDocument;
        $xslDoc->load($xsltFile);
            
        $proc = new \XSLTProcessor;
        $proc->registerPHPFunctions();
        $proc->importStyleSheet($xslDoc);
            
        $text = $proc->transformToXml(  $doc);
         echo $text; 
        
        /**extragerea nodurilor
          *  3. În același script, folosind sintaxa XPath, să se extragă 
          și să se afișeze sub tabelul de mai sus numele țărilor care au moneda “Euro”.
        */        
        echo tariCuMoneda($doc);
             
    }catch(\Exception $e){
        echo "Eroare la parsare fisier " .$e->getMessage();
    }
    
    return;
}
 
 /** extragerea nodurilor
          *  3. În același script, folosind sintaxa XPath, să se extragă 
          și să se afișeze sub tabelul de mai sus numele țărilor care au moneda “Euro”.
*/   
function tariCuMoneda($doc){
    $reval = "";
    $xpath = new \DOMXPath($doc); //@lang //title[@lang='en']

    $elements = $xpath->query("//country/currency[@code='EUR']");
    if($elements->length==0)   $reval = '<div class="bg-danger col-md-12">Nu exista nici o tzara cu moneda EUR</div>';
    else{
        $reval = '<div class="bg-success col-md-12"><h4>Tari cu moneda Euro (' . $elements->length .')</h4></div>';
        for ($i = 0; $i < $elements->length; $i++){
            $siblings = $xpath->query("preceding-sibling::name", $elements->item($i));
            foreach ($siblings as $sibling) {
                $reval.= '<div class="col-md-12"><h4>'.$sibling->nodeValue.'</h4></div>';   
            }

        } 
    }
    return $reval;
}