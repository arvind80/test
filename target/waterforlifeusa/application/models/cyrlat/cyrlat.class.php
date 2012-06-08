<?php

require_once 'ooyes_functions.php';

############################################################################
#CyrLat class v. 1.0.1 by Yaroslav Shapoval
#en: Class for converting Cyrillic to Latin characters in both directions.
#ru: ����� ��� ��������������� �������� � �������� � �������.
#    "Privet, Mir!" <-> "������, ���!"
#en: See test.php for example of usage
#ru: ���� test.php ���������� ������� �������������
#en: see "examples" dir for additional examples.
#ru: � ����� "examples" �������������� �������
#############################################################################
class CyrLat {
    var $cyr=array(
    "�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�");
    var $lat=array(
    "Sch","Sh","Ch","Ts","Yu","Ya","Zh","A","B","V","G","D","E","E","Z","I","J","K","L","M","N","O","P","R","S","T","U","F","H","'","Y","`","E");
    var $lat_additional=array(
    "W","X","Q","Yo","Ja","Ju","'","`","y");
    var $cyr_additional=array(
    "�","��","�","�","�","�","�","�","�");
    function cyr2lat($input){
     for($i=0;$i<count($this->cyr);$i++){
       $current_cyr=$this->cyr[$i];
       $current_lat=$this->lat[$i];
       $input=str_replace($current_cyr,$current_lat,$input);
       $input=str_replace(strtolower($current_cyr),strtolower($current_lat),$input);
     }
    return($input);
    }
    function lat2cyr($input){
     for($i=0;$i<count($this->lat_additional);$i++){
       $current_cyr=$this->cyr_additional[$i];
       $current_lat=$this->lat_additional[$i];
       $input=str_replace($current_lat,$current_cyr,$input);
       $input=str_replace(strtolower($current_lat),strtolower($current_cyr),$input);
     }
     for($i=0;$i<count($this->lat);$i++){
       $current_cyr=$this->cyr[$i];
       $current_lat=$this->lat[$i];
       $input=str_replace($current_lat,$current_cyr,$input);
       $input=str_replace(strtolower($current_lat),strtolower($current_cyr),$input);
     }
    return($input);
    }
}

#Uncomment for example
#$cyrlat = new CyrLat;
#$inp="����������, ��� ������ ���������� ����!";
#$out=$cyrlat->cyr2lat($inp);
#echo "!: $out <br>";
#$out2=$cyrlat->lat2cyr($out);
#echo "!: $out2 <br>";

?>