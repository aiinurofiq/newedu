<?php
function format_uang($angka){
     $hasil=number_format($angka,2,',','.');
return $hasil;
}