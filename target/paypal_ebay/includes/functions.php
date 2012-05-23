<?php
/*
	FUNCTIONS
*/
function save_image($url,$img)
{
	file_put_contents($img,file_get_contents($url));	
}

function get2DArrayFromCsv($file,$delimiter) 
{
	if (($handle = fopen($file, "r")) !== FALSE) {
		$i = 0;
		while (($lineArray = fgetcsv($handle, 4000, $delimiter)) !== FALSE) {
			for ($j=0; $j<count($lineArray); $j++) {
				$data2DArray[$i][$j] = $lineArray[$j];
			}
			$i++;
		}
		fclose($handle);
	}
	return $data2DArray;
} 
?>