<?php

/**
 * Clase que imprime por pantalla la información contenida en el paginador.
 *  
 * @author qinteractiva
 *
 */
class Library_Paginator_Printer_DefaultPaginatorPrinter extends Library_Printer_BasePrinter
{
	public function __contruct(Library_Paginator_Paginator $paginator)
	{
		parent::__construct($paginator);
	}
	
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
			$output = 'No hay elementos para mostrar.';
		}
		
		return $output;
	}
	
	private function printCollection(Library_Paginator_Paginator $paginator, $collection)
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
	
	private function printPagination(Library_Paginator_Paginator $paginator, $output)
	{
		$request = Library_Manage_ResourceManager::getRequestData();
		
		$request->setParams(array());
		
		$pagesNumber = $paginator->getPagesNumber();
		
		if($pagesNumber > 1)
		{
			$output .= '<div class="pagination"><ul>';
			
			$output .= '<li><a href="'.$request.'/page/1">Primera</a></li>';
			
			for($i = 1 ; $i <= $pagesNumber ; $i++)
			{
				if($i == $paginator->getCurrentPage())
				{
					$output .= '<li class="active"><a href="'.$request.'/page/'.$i.'">'.$i.'</a></li>';
				}
				else
				{
					$output .= '<li><a href="'.$request.'/page/'.$i.'">'.$i.'</a></li>';
				}
			}
			
			$output .= '<li><a href="'.$request.'/page/'.$pagesNumber.'">Última</a></li>';
		}
		
		$output .= '</ul></div>';
		
		return $output;
	}
}