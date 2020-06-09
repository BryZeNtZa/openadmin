<?php
/**
 * Project : OLYMPIA KIT.
 * File Author : BryZe NtZa
 * File Description : Application Tables/Lists Pagination class
 * Date : Mai 2018.
 * Copyright XDEV WORKGROUP
 * */
 
namespace OpenAdmin\Library;
 
class Paginator {
	
	private $pageMaxElts = 0; //Max elements displayed by page
	private $maxOffsets  = 0; //Max buttons should be displayed in the pagination table
	
    private $page 	 = 0; //Default offset (selected by the user)
	private $nbPages = 0; //Number buttons needed to be displayed in the pagination table (calculated)
	
	public function __construct($nbPages, $page) {
		
		$this->nbPages = $nbPages;
		$this->page = $page;
		$this->setParams();
    }
	
	private function setParams() {
		GLOBAL $APP_DEFAULTS;
		$this->pageMaxElts = $APP_DEFAULTS['listsmax'];
		$this->maxOffsets  = $APP_DEFAULTS['paginationmax'];
	}
	
	public function paginate() {
		
		$paginTable  = '<nav aria-label="Pagination">';
			
		//Button previous
		$paginTable .= '<ul class="pagination">';
		$paginTable .= ( $this->page == 1 ) 
						? '<li class="disabled"><a href="#">&laquo;</a></li>'
						: '<li><a href="#" data-page="' . ( $this->page - 1 ) . '" data-offset="' . ( ( $this->page - 1 ) * $this->pageMaxElts ) . '" class="page" >&laquo;</a></li>';
		
		//Offsets Buttons
		if ( $this->nbPages <= $this->maxOffsets ) {
			for( $i = 1; $i <= $this->nbPages; $i++ ) 
				$paginTable .= '<li class="' . ( ( $i == $this->page ) ? 'active' : '' ) . '" ><a href="#" data-page="' . $i . '" data-offset="' . ( ($i-1) * $this->pageMaxElts ) . '" class="page" >' . $i . '</a></li>';
		}
		else {
			// Determine the sliding range, centered around the current page.
			$numAdjacents = (int) floor( ($this->maxOffsets - 3) / 2 );
			$slidingStart = ( ( $this->page + $numAdjacents ) > $this->nbPages )  ? ( $this->nbPages - $this->maxOffsets + 2 ) : ( $this->page - $numAdjacents ) ;
			if ( $slidingStart < 2 ) $slidingStart = 2;
			$slidingEnd = $slidingStart + $this->maxOffsets - 3;
			if ( $slidingEnd >= $this->nbPages ) $slidingEnd = $this->nbPages - 1;

			// Build the list of pages.
			$paginTable .= '<li class="'. ( ( $this->page == 1 ) ? 'active' : '' ) . '" ><a href="#" data-page="1" data-offset="0" class="page" >1</a></li>';
			if ( $slidingStart > 2 )  $paginTable .= '<li class="disabled"><a href="#" >...</a></li>';
			for ($i = $slidingStart; $i <= $slidingEnd; $i++)
				$paginTable .= '<li class="' . ( ( $i == $this->page ) ? 'active' : '' ) . '" ><a href="#" data-page="' . $i . '" data-offset="' . ( ( $i - 1 ) * $this->pageMaxElts ) . '" class="page" >' . $i . '</a></li>';
			if ( $slidingEnd < ( $this->nbPages - 1 ) )  $paginTable .= '<li class="disabled"><a href="#" >...</a></li>'; 
			$paginTable .= '<li class="' . ( ( $this->nbPages == $this->page ) ? 'active' : '' ) . '" ><a href="#" data-page="' . $this->nbPages . '" data-offset="' . ( ( $this->nbPages - 1 ) * $this->pageMaxElts ) . '" class="page" >' . $this->nbPages . '</a></li>';
			
		}
		
		//Button next
		$paginTable .= ( $this->page >= $this->nbPages ) 
						? '<li class="disabled"><a href="#">&raquo;</a></li>'
						: '<li><a href="#" data-page="' . ( $this->page + 1 ) . '" data-offset="' . ( $this->page * $this->pageMaxElts ) . '" class="page" >&raquo;</a></li>';
						
		$paginTable .= '</ul>';
		
		$paginTable .= '</nav>';
		
		return $paginTable;
	}
}
?>