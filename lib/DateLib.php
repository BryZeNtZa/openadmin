<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application utilities functions
 * Date : Mai 2018
 * Copyright XDEV WORKGROUP
 * */
 
namespace OpenAdmin\Library;
 
Class DateLib {

	public static function getIDDate($date) {

		try {

			if ($date == '') {
				return 0;
				exit();
			}

			list($day, $month, $year) = explode('/', $date);

			if ($year < 100) {
				$year = '20' . $year;  // Provisoire
			}

			$timestamp = mktime(0, 0, 0, $month, $day, $year);
			$timestamp1 = $timestamp - mktime(0, 0, 0, 1, 1, $year) + (3600 * 24);

			$result = round($timestamp1 / (3600 * 24)) + 366 * (date('Y', $timestamp) - 1);

			return $result;
			
		} catch (Exception $e) {
			echo 'Exception reçue : ', $e->getMessage(), '\n';
		}
		
	}		
	
	public static function getIDTime($time) {

		try {
			if ($time == '') {
				return 0;
				exit();
			}

			list($hour, $minute, $second) = explode(':', $time);

			$result = $hour * 60 + $minute;

			return $result;
	
		} catch (Exception $e) {
			echo 'Exception reçue : ', $e->getMessage(), '\n';
		}
	}
		
	public static function getIDDateTime($dateTime){

		list($date, $time) = explode(' ', $dateTime);
		list($day, $mois, $year) = explode('-', $date);
		list($hour, $min, $second) = explode(':', $time);

		$strTimeInput = $month.'/'.$day.'/'.$year;

		$dayOfYear = date('z', strtotime($strTimeInput))+1;
		$yearOfDate = 366 * (date('Y', strtotime($strTimeInput)) - 1);

		$result = ($dayOfYear + $yearOfDate); // Yesterday Days after JC
		$result *= 1440; // Yesterday Minutes after JC
		$result += self::GetIDTime($time); // Instant Minutes after JC
		$result *= 60; // Instant Seconds after JC
		$result += $second; // Instant Seconds after JC

		return $result;

	}

	// Conversion de la date dans le format demandé
	public static function dateConvert($dateTime, $formatBefore, $formatAfter, $to='hour'){
		
		$date = substr($dateTime, 0, 10);
		$time = (strlen($date) > 10) ? substr($dateTime, 11, 8) : '00:00:00';
	 
		switch ($formatBefore) {
			case 'd/m/Y':  list($day, $month, $year) = explode('/', $date); break;
			case 'd/Y/m':  list($day, $year, $month) = explode('/', $date); break;
			case 'Y/m/d':  list($year, $month, $day) = explode('/', $date); break;
			case 'Y/d/m':  list($year, $day, $month) = explode('/', $date); break;
			case 'm/d/Y':  list($month, $day, $year) = explode('/', $date); break;
			case 'm/Y/d':  list($month, $year, $day) = explode('/', $date); break;
			case 'd-m-Y':  list($day, $month, $year) = explode('-', $date); break;
			case 'd-Y-m':  list($day, $year, $month) = explode('-', $date); break;
			case 'Y-m-d':  list($year, $month, $day) = explode('-', $date); break;
			case 'Y-d-m':  list($year, $day, $month) = explode('-', $date); break;
			case 'm-d-Y':  list($month, $day, $year) = explode('-', $date); break;
			case 'm-Y-d':  list($month, $year,$day) = explode('-', $date); break;
			case 'd.m.Y':  list($day, $month, $year) = explode('.', $date); break;
			case 'd.Y.m':  list($day, $year, $month) = explode('.', $date); break;
			case 'Y.m.d':  list($year, $month, $day) = explode('.', $date); break;
			case 'Y.d.m':  list($year, $day, $month) = explode('.', $date); break;
			case 'm.d.Y':  list($month, $day, $year) = explode('.', $date); break;
			case 'm.Y.d':  list($month, $year, $day) = explode('.', $date); break;
		}
		
		switch ($formatAfter){
			case 'd/m/Y': $date = $day.'/'.$month.'/'.$year; break;
			case 'd/Y/m': $date = $day.'/'.$year.'/'.$month; break;
			case 'Y/m/d': $date = $year.'/'.$month.'/'.$day; break;
			case 'Y/d/m': $date = $year.'/'.$day.'/'.$month; break;
			case 'm/d/Y': $date = $month.'/'.$day.'/'.$year; break;
			case 'm/Y/d': $date = $month.'/'.$year.'/'.$day; break;
			case 'd-m-Y': $date = $day.'-'.$month.'-'.$year; break;
			case 'd-Y-m': $date = $day.'-'.$year.'-'.$month; break;
			case 'Y-m-d': $date = $year.'-'.$month.'-'.$day; break;
			case 'Y-d-m': $date = $year.'-'.$day.'-'.$month; break;
			case 'm-d-Y': $date = $month.'-'.$day.'-'.$year; break;
			case 'm-Y-d': $date = $month.'-'.$year.'-'.$day; break;
			case 'd.m.Y': $date = $day.'.'.$month.'.'.$year; break;
			case 'd.Y.m': $date = $day.'.'.$year.'.'.$month; break;
			case 'Y.m.d': $date = $year.'.'.$month.'.'.$day; break;
			case 'Y.d.m': $date = $year.'.'.$day.'.'.$month; break;
			case 'm.d.Y': $date = $month.'.'.$day.'.'.$year; break;
			case 'm.Y.d': $date = $month.'.'.$year.'.'.$day; break;
			case 'Ymd': $date = $year.$month.$day; break;
		}

		if (!$to) return $date;

		$dateTime  = $date . ' ' . $time;

		switch ($to) {
			case 'hours': $dateTime = substr($dateTime, 0, 13); break;
			case 'minutes': $dateTime = substr($dateTime, 0, 16); break;
			case 'seconds': $dateTime = substr($dateTime, 0, 19); break;
		}

		return $dateTime;
	}

	function showDateHeuresMinsJMY($dateTime) {
		return self::dateConvert($dateTime, 'Y-m-d', 'd/m/Y', 16);
	}

}
