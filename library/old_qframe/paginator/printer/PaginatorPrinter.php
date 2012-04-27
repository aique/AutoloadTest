<?php

/**
 * Obtiene la representación visual del paginador.
 * 
 * @package qframe
 * 
 * @subpackage paginator
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Paginator_Printer_PaginatorPrinter extends Library_Qframe_Printer_BasePrinter
{
	/**
	 * Devuelve una cadena de texto con la salida en pantalla por
	 * defecto del paginador, compuesta por los controles de navegación.
	 * 
	 * @return string
	 * 
	 */
	public function standardPrint()
	{
		$paginationHelper = self::getHelperData($this->getElement());
		
		return Library_Qframe_File_FileUtil::getFileContent($this->getElement()->getTemplate(),
															array('helper' => $paginationHelper,
																  'paginator' => $this->getElement()));
	}
	
	private function getHelperData(Library_Qframe_Paginator_Paginator $paginator)
	{
		$paginatorHelper = new Library_Qframe_Paginator_Helper_PaginatorHelper();
		
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
		elseif($currentPage == $pagesNumber)
		{
			$pagesToPrint = $visiblePages - 1;
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
			// Cálculo de las páginas a la izquierda de la actual
			
			for($i = $currentPage - $pagesToPrint , $j = 0 ; $i > 0 && $j < $pagesToPrint ; $i++ , $j++ , $printedPages++)
			{
				$paginatorHelper->addLeftPage($i);
			}
			
			if($currentPage - $j > 1)
			{
				$paginatorHelper->setLeftArrowPage($currentPage - $printedPages);
			}
						
			$paginatorHelper->setCurrentPage($currentPage);
			
			// Cálculo de las páginas a la izquierda de la actual
			
			for($i = $currentPage + 1 ; $i <= $pagesNumber && $printedPages < $visiblePages ; $i++ , $printedPages++)
			{
				$paginatorHelper->addRightPage($i);
			}
			
			if($i <= $pagesNumber)
			{
				$paginatorHelper->setRightArrowPage($i);
			}
		}
		
		return $paginatorHelper;
	}
}