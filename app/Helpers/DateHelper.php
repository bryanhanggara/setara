<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function formatIndonesian($date)
    {
        if (!$date) return '';
        
        $carbon = Carbon::parse($date);
        
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        
        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        
        $tanggal = $carbon->day;
        $bulan_nama = $bulan[$carbon->month];
        $tahun = $carbon->year;
        $hari_nama = $hari[$carbon->format('l')];
        
        return "$hari_nama, $tanggal $bulan_nama $tahun";
    }
    
    public static function formatIndonesianShort($date)
    {
        if (!$date) return '';
        
        $carbon = Carbon::parse($date);
        
        $bulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ags',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];
        
        $tanggal = $carbon->day;
        $bulan_nama = $bulan[$carbon->month];
        $tahun = $carbon->year;
        
        return "$tanggal $bulan_nama $tahun";
    }
    
    public static function formatIndonesianWithTime($date)
    {
        if (!$date) return '';
        
        $carbon = Carbon::parse($date);
        
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        
        $tanggal = $carbon->day;
        $bulan_nama = $bulan[$carbon->month];
        $tahun = $carbon->year;
        $waktu = $carbon->format('H:i');
        
        return "$tanggal $bulan_nama $tahun $waktu";
    }
    
    public static function timeAgo($date)
    {
        if (!$date) return '';
        
        $carbon = Carbon::parse($date);
        $now = Carbon::now();
        
        // Check if the date is in the future
        if ($carbon->isFuture()) {
            return 'baru saja';
        }
        
        $diffInSeconds = $carbon->diffInSeconds($now);
        $diffInMinutes = $carbon->diffInMinutes($now);
        $diffInHours = $carbon->diffInHours($now);
        $diffInDays = $carbon->diffInDays($now);
        $diffInWeeks = $carbon->diffInWeeks($now);
        $diffInMonths = $carbon->diffInMonths($now);
        $diffInYears = $carbon->diffInYears($now);
        
        if ($diffInSeconds < 60) {
            return 'baru saja';
        } elseif ($diffInMinutes < 60) {
            return round($diffInMinutes) . ' menit yang lalu';
        } elseif ($diffInHours < 24) {
            return round($diffInHours) . ' jam yang lalu';
        } elseif ($diffInDays < 7) {
            return round($diffInDays) . ' hari yang lalu';
        } elseif ($diffInWeeks < 4) {
            return round($diffInWeeks) . ' minggu yang lalu';
        } elseif ($diffInMonths < 12) {
            return round($diffInMonths) . ' bulan yang lalu';
        } else {
            return round($diffInYears) . ' tahun yang lalu';
        }
    }
} 