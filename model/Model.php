<?php

class Model {
    
        public function __construct()  
        {  
            
        } 
        
	public function curl($kierunek) 
        {
            for ($i=1; $i<=3; $i++)
            {
                //$kierunek = $_GET['kierunek'];
                $url='http://www.wakacje.pl/wczasy/'.$kierunek.'/?str-'.$i;
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                $page = curl_exec($curl);
                curl_close($curl);

                $dom = new DOMDocument;
                libxml_use_internal_errors(true);
                $dom->loadHTML($page);
                libxml_clear_errors();
                $xpath = new DOMXPath($dom);
                $specialPrice = $xpath->query('//span[@class="specialPrice"]');

                foreach($specialPrice as $item) 
                {
                    $parent = $item->parentNode;//rodzic
                    $link = 'http://www.wakacje.pl'.$parent->getAttribute('href');//pobranie do zmiennej link wartości odnośnika
                    $procent = preg_replace('/\D/', '', $item->nodeValue); //wyciąganie tylko liczb ze stringa
                    $tablica[$link]['procent'] = (int)$procent;//zapis do tablicy [link_do_oferty] [procent obniżki]
                }
            }
                
                
            //sortowanie
            uasort($tablica, function($a, $b) {
                return $b['procent'] <=> $a['procent'];
            });
                
               
            $first_key = key($tablica);//pierwszy klucz z tablicy
                
            return $first_key;
        }
            
            
}

?>