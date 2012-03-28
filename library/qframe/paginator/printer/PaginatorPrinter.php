<?php

/**
 * Clase que imprime por pantalla la información contenida en el paginador.
 *  
 * @author qinteractiva
 *
 */
class Library_Qframe_Paginator_Printer_PaginatorPrinter extends Library_Qframe_Printer_BasePrinter
{
	/**
	 * Devuelve una cadena de texto con la salida en pantalla por defecto
	 * del paginador.
	 * 
	 * Los elementos que componen la colección serán impresos en formato
	 * de lista, utilizando su salida estándar devuelta por su método
	 * __toString.
	 * 
	 * También se imprimirán las distintas páginas que componen el sistema
	 * de paginación en formato de enlace para poder navegar a través de
	 * ellas.
	 * 
	 * @param string $paginator
	 */
	public function standardPrint()
	{
		$collection = $this->element->getCollection();
		
		if(count($collection > 0))
		{
			$output = self::printCollection($this->element, $collection);
			
			$output = self::printPagination($this->element, $output);
		}
		else
		{
			$output = Library_Qframe_I18n_I18n::getText('screen_common_pagination_noresults');
		}
		
		return $output;
	}
	
	private function printCollection(Library_Qframe_Paginator_Paginator $paginator, $collection)
	{
		$output = '<div id="users"><ul>';
		
		for($i = $paginator->getFirstItemPosOnPage() - 1 ; $i < $paginator->getLastItemPosOnPage() ; $i++)
		{
			if(isset($collection[$i]))
			{
				$item = $collection[$i];
				
				$output .= '<li>' . $item . '</li>';
			}
		}
			
		$output .= '</ul></div>';
		
		return $output;
	}
	
	private function printPagination(Library_Qframe_Paginator_Paginator $paginator, $output)
	{
		$request = Library_Qframe_Manage_ResourceManager::getRequestData();
		
		$request->setParams(array());
		
		$pagesNumber = $paginator->getPagesNumber();
		$visiblePages = $paginator->getVisiblePages();
		$currentPage = $paginator->getCurrentPage();
		
		$printedPages = 1;
		
		// Cálculo de páginas que se imprimirán a la izquierda de la actual
		
		if($visiblePages > $pagesNumber)
		{
			$pagesToPrint = $visiblePages - $pagesNumber;
		}
		elseif($currentPage + floor($visiblePages / 2) > $pagesNumber)
		{
			$pagesOnRightSide = ($pagesNumber - $currentPage - floor($visiblePages / 2));
			
			if($pagesOnRightSide < 0)
			{
				$pagesOnRightSide = 0;
			}
			
			$pagesToPrint = $pagesNumber - $visiblePages - $pagesOnRightSide - 1;
		}
		else
		{
			$pagesToPrint = floor($visiblePages / 2);
		}
		
		if($pagesNumber > 1)
		{
			// Impersión de páginas a la izquierda
			
			$leftPages = '';
			
			$output .= '<div class="pagination"><ul>';
			
			$output .= '<li><a href="'.$request.'/page/1">'.Library_Qframe_I18n_I18n::getText("screen_common_pagination_first").'</a></li>';
			
			for($i = $currentPage - $pagesToPrint , $j = 0 ; $i > 0 && $j < $pagesToPrint ; $i++ , $j++ , $printedPages++)
			{
				$leftPages .= '<li><a href="'.$request.'/page/'.$i.'">'.$i.'</a></li>';
			}
			
			if($currentPage - $j > 1)
			{
				$pageNum = $currentPage - $printedPages;
				
				$output .= '<li><a href="'.$request.'/page/'.$pageNum.'">&larr;</a></li>';
			}
			
			$output .= $leftPages;
			
			// Impresión de la página actual
			
			$output .= '<li class="active"><a href="'.$request.'/page/'.$currentPage.'">'.$currentPage.'</a></li>';
			
			// Impresión de páginas a la derecha
			
			for($i = $currentPage + 1 ; $i <= $pagesNumber && $printedPages < $visiblePages ; $i++ , $printedPages++)
			{
				$output .= '<li><a href="'.$request.'/page/'.$i.'">'.$i.'</a></li>';
			}
			
			if($i <= $pagesNumber)
			{
				$output .= '<li><a href="'.$request.'/page/'.$i.'">&rarr;</a></li>';
			}
			
			$output .= '<li><a href="'.$request.'/page/'.$pagesNumber.'">'.Library_Qframe_I18n_I18n::getText("screen_common_pagination_last").'</a></li>';
			
			$output .= '</ul></div>';
		}
		
		return $output;
	}
}