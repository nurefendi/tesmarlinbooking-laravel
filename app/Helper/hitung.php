<?php
if( !function_exists('hitungangka')){
	function hitungangka($angka_a){
		$stop = 0;
        $marlin = ' Marlin';
        $boking = ' Booking';
        $hasil = [];
        foreach (range(1, $angka_a) as $i => $val) {
            if ($val % 3 != 0 && $val % 5 != 0) {
                $hasil[] = $val . ' : <br>';
                continue;
              }
            if ($val % 3 == 0 && $val % 5 != 0) {
                $hasil[] = $val.' : '.$marlin ."<br>";
                // echo "a";
            }

            if ($val % 5 == 0 && $val % 3 != 0){
                $hasil[] = $val.' : '.$boking."<br>";
                // echo "b";
            }
            if ($val % 3 == 0 && $val % 5 == 0){
                ++$stop;
                $hasil[] = $val.' : '.$marlin.$boking.'<br>';
            }
            if($stop >= 2){
                $marlin = ' Booking';
                $boking = ' Marlin';
            }
            if($stop >= 5){
                break;
            }

        }

        return $hasil;
	}
}