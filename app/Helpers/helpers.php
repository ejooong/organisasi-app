<?php

if (!function_exists('format_nik')) {
    function format_nik($nik) {
        return substr($nik, 0, 4) . ' ' . 
               substr($nik, 4, 4) . ' ' . 
               substr($nik, 8, 4) . ' ' . 
               substr($nik, 12, 4);
    }
}

if (!function_exists('get_month_name')) {
    function get_month_name($month) {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        return $months[(int)$month] ?? '';
    }
}