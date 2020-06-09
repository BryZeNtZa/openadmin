<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Utilities for numbers
 * Date : Mai 2018.
 * Copyright XDEV WORKGROUP
 * */
 
namespace OpenAdmin\Library;
 
class Numeric {
	
	public static function formatPrize($amount){
	
		$reste = $amount % 100;
		$ammountback = $amount;

		if( $reste <= 10){
			$ammountback = $amount - $reste;
		}
		elseif($reste <= 25){
			$ammountback = $amount - $reste + 25;
		}
		elseif($reste <= 35){
			$ammountback = $amount - $reste + 25;
		}
		elseif($reste <= 50){
			$ammountback = $amount - $reste + 50;
		}
		elseif($reste <= 55){
			$ammountback = $amount - $reste + 50;
		}
		elseif($reste <= 75){
			$ammountback = $amount - $reste + 75;
		}
		elseif($reste <= 80){
			$ammountback = $amount - $reste + 75;
		}
		elseif($reste <= 100){
			$ammountback = $amount - $reste + 100;
		}

		return $ammountback;
	}
	
	public static function formatReference($ref){
	
		$n = strlen($ref);
		$refback = $ref;

		if( $n == 1){
			$refback = "00000".$ref;
		}
		elseif($n == 2){
			$refback = "0000".$ref;
		}
		elseif($n == 3){
			$refback = "000".$ref;
		}
		elseif($n == 4){
			$refback = "00".$ref;
		}
		elseif($n == 5){
			$refback = "0".$ref;
		}
		
		return $refback;
	}

	public static function ConvNumCent($Nombre, $Langue) {
		
		$TabUnit='' ;
		$byCent=$byReste='' ;
		$strReste = '' ;
		$NumCent='';
		$TabUnit = array("", "un", "deux", "trois", "quatre", "cinq", "six", "sept","huit", "neuf", "dix") ;
		 
		$byCent = intval($Nombre / 100) ;
		$byReste = $Nombre - ($byCent * 100) ;
		$strReste = self::ConvNumDizaine($byReste, $Langue);
		
		switch( $byCent ) {
			
			case 0 :
				$NumCent = $strReste ;
			break;
			
			case 1 :
				if ($byReste == 0) $NumCent = "cent" ;
				else $NumCent = "cent " . $strReste ;
			break;
			
			default :
				if ($byReste == 0) $NumCent = $TabUnit[$byCent] . " cents" ;
				else $NumCent = $TabUnit[$byCent] . " cent " . $strReste ;
		}
		return $NumCent;
	}

	public static function ConvNumDizaine($Nombre, $Langue) {
		
		$TabUnit=$TabDiz='';
		$byUnit=$byDiz='' ;
		$strLiaison = '' ;
		 
		$TabUnit = array("", "un", "deux", "trois", "quatre", "cinq", "six", "sept", "huit", "neuf", "dix", "onze", "douze", "treize", "quatorze", "quinze", "seize", "dix-sept", "dix-huit", "dix-neuf") ;
		
		$TabDiz = array("", "", "vingt", "trente", "quarante", "cinquante", "soixante", "soixante", "quatre-vingt", "quatre-vingt") ;
		
		if ($Langue == 1) {
			$TabDiz[7] = "septante" ;
			$TabDiz[9] = "nonante" ;
		}
		else if ($Langue == 2) {
			$TabDiz[7] = "septante" ;
			$TabDiz[8] = "huitante" ;
			$TabDiz[9] = "nonante" ;
		}
		
		$byDiz = intval($Nombre / 10) ;
		$byUnit = $Nombre - ($byDiz * 10) ;
		
		$strLiaison = "-" ;
		if ($byUnit == 1) $strLiaison = " et " ;
		
		switch($byDiz) {
			case 0 :
				$strLiaison = "" ;
			break;
			
			case 1 :
				$byUnit = $byUnit + 10 ;
				$strLiaison = "" ;
			break;
			
			case 7 :
				if ($Langue == 0) $byUnit = $byUnit + 10 ;
			break;
			
			case 8 :
				if ($Langue != 2) $strLiaison = "-" ;
			break;
			
			case 9 :
				if ($Langue == 0) {
					$byUnit = $byUnit + 10 ;
					$strLiaison = "-" ;
				}
			break;
		}
		
		$NumDizaine = $TabDiz[$byDiz] ;
		if ($byDiz == 8 && $Langue != 2 && $byUnit == 0) $NumDizaine = $NumDizaine . "s" ;
		
		if ($TabUnit[$byUnit] != "") {
			$NumDizaine = $NumDizaine . $strLiaison . $TabUnit[$byUnit] ;
		}
		else {
			$NumDizaine = $NumDizaine ;
		}
		
		return $NumDizaine;
	}
		
		
	public static function ConvNumEnt($Nombre, $Langue) {
		
		$byNum=$iTmp=$dblReste='' ;
		$StrTmp = '';
		$NumEnt='' ;
		
		$iTmp = $Nombre - (intval($Nombre / 1000) * 1000) ;
		$NumEnt = self::ConvNumCent(intval($iTmp), $Langue) ;
		$dblReste = intval($Nombre / 1000) ;
		$iTmp = $dblReste - (intval($dblReste / 1000) * 1000) ;
		$StrTmp = self::ConvNumCent(intval($iTmp), $Langue) ;
		
		switch($iTmp) {
			case 0 :
			break;
			
			case 1 :
			$StrTmp = "mille " ;
			break;
			
			default :
			$StrTmp = $StrTmp . " mille " ;
		}
		
		$NumEnt 	= $StrTmp . $NumEnt ;
		$dblReste 	= intval($dblReste / 1000) ;
		$iTmp 		= $dblReste - (intval($dblReste / 1000) * 1000) ;
		$StrTmp	 	= self::ConvNumCent(intval($iTmp), $Langue) ;
		
		switch($iTmp) {
			case 0 :
			break;
			
			case 1 :
			$StrTmp = $StrTmp . " million " ;
			break;
			
			default :
			$StrTmp = $StrTmp . " millions " ;
		}
		
		$NumEnt = $StrTmp . $NumEnt ;
		$dblReste = intval($dblReste / 1000) ;
		$iTmp = $dblReste - (intval($dblReste / 1000) * 1000) ;
		$StrTmp = self::ConvNumCent(intval($iTmp), $Langue) ;
		
		switch($iTmp) {
			case 0 :
			break;
			
			case 1 :
			$StrTmp = $StrTmp . " milliard " ;
			break;
			
			default :
			$StrTmp = $StrTmp . " milliards " ;
		}
		
		$NumEnt 	= $StrTmp . $NumEnt ;
		$dblReste 	= intval($dblReste / 1000) ;
		$iTmp 		= $dblReste - (intval($dblReste / 1000) * 1000) ;
		$StrTmp 	= self::ConvNumCent(intval($iTmp), $Langue) ;
		
		switch($iTmp) {
			case 0 :
			break;
			
			case 1 :
				$StrTmp = $StrTmp . " billion " ;
			break;
			
			default :
				$StrTmp = $StrTmp . " billions " ;
		}
			
		$NumEnt = $StrTmp . $NumEnt ;
		
		return $NumEnt;
	}
			
	public static function ConvNumberLetter($Nombre, $Devise, $Langue) {
		
		$dblEnt=''; $byDec='';
		$bNegatif='';
		$strDev = '';
		$strCentimes = '';
		 
		if( $Nombre < 0 ) {
			$bNegatif = true;
			$Nombre = abs($Nombre);
		 
		}
		
		$dblEnt = intval($Nombre) ;
		$byDec = round(($Nombre - $dblEnt) * 100) ;
		
		if( $byDec == 0 ) {
			if ($dblEnt > 999999999999999) {
				return "#TropGrand" ;
			}
		}
		else {
			if ($dblEnt > 9999999999999.99) {
				return "#TropGrand" ;
			}
		}
		
		switch($Devise) {
			case 0 :
				if ($byDec > 0) $strDev = " virgule" ;
			break;
			
			case 1 :
				$strDev = " Euro" ;
				if ($byDec > 0) $strCentimes = $strCentimes . " Cents" ;
			break;
			
			case 2 :
				$strDev = " Dollar" ;
				if ($byDec > 0) $strCentimes = $strCentimes . " Cent" ;
			break;
		}
		
		if (($dblEnt > 1) && ($Devise != 0)) $strDev = $strDev . "s" ;
		 
		$NumberLetter = self::ConvNumEnt(floatval($dblEnt), $Langue) . $strDev . " " . Utils::ConvNumDizaine($byDec, $Langue) . $strCentimes ;
		
		return $NumberLetter;
		
	}
			
}

?>
