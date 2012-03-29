<?php

/**
 * Pagina una colección de elementos ofreciendo los controles necesarios
 * para navegar entre ella.
 * 
 * Es recomendable establecer las características del paginador en el
 * fichero de configuración, pasando los valores definidos en la llamada
 * al constructor. De esta manera se puede editar de manera rápida e
 * intuitiva.
 * 
 * Existen los siguientes parámetros configurables:
 * 
 * <ul>
 * <li>ItemsPorPagina: Número de elementos en cada página.</li>
 * <li>PaginasVisibles: Número de páginas accesibles de manera directa.</li>
 * </ul>
 * 
 * Así en una colección que consta de 30 elementos a la que se le ha
 * aplicado un paginador con 5 ítems por página y 3 páginas visibles,
 * al situarse en la página 3 puede verse lo siguiente:
 * 
 * <ul>
 * <li>Elemento 11</li>
 * <li>Elemento 12</li>
 * <li>Elemento 13</li>
 * <li>Elemento 14</li>
 * <li>Elemento 15</li>
 * </ul>
 * 
 * <- ... 2 3 4 ... ->
 * 
 * @package qframe
 * 
 * @subpackage paginator
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Paginator_Paginator
{
	private $collection;
	/**
	 * Número de elementos por página
	 * @var int
	 */
	private $itemsPerPage;
	/**
	 * Número de páginas accesibles de manera directa.
	 * @var int
	 */
	private $visiblePages;
	/**
	 * Número de páginas totales.
	 * 
	 * @var int
	 */
	private $pagesNumber;
	/**
	 * Página actual.
	 * 
	 * @var int
	 */
	private $currentPage;
	
	private $printer;
	
	public function __construct($collection, $itemsPerPage, $visiblePages, $printer = null)
	{
		$this->collection = $collection;
		$this->itemsPerPage = $itemsPerPage;
		$this->visiblePages = $visiblePages;
		$this->pagesNumber = $this->calculatePagesNumber();
		$this->currentPage = 1;
		
		if($printer != null)
		{
			$this->printer = $printer;
		}
		else
		{
			$this->printer = new Library_Qframe_Paginator_Printer_PaginatorPrinter();
		}
		
		$this->printer->setElement($this);
	}
	
	/**
	 * Devuelve el valor del atributo collection.
	 *
	 * @return array
	 */
	public function getCollection()
	{
	    return $this->collection;
	}
	 
	/**
	 * Establece el valor del atributo collection.
	 *
	 * @param array $collection
	 */
	public function setCollection($collection)
	{
	    $this->collection = $collection;
	}
	
	/**
	* Devuelve el valor del atributo pageNum.
	*
	* @return int
	*/
	public function getPagesNumber()
	{
		return $this->pagesNumber;
	}
	
	/**
	 * Establece el valor del atributo pageNum.
	 *
	 * @param int $pageNum
	 */
	public function setPagesNumber($pagesNumber)
	{
		$this->pagesNumber = $pagesNumber;
	}
	
	/**
	 * Devuelve el valor del atributo itemsPerPage.
	 *
	 * @return int
	 */
	public function getItemsPerPage()
	{
	    return $this->itemsPerPage;
	}
	 
	/**
	 * Establece el valor del atributo itemsPerPage.
	 *
	 * @param int $itemsPerPage
	 */
	public function setItemsPerPage($itemsPerPage)
	{
	    $this->itemsPerPage = $itemsPerPage;
	}
	
	/**
	 * Devuelve el valor del atributo visiblePages.
	 *
	 * @return int
	 */
	public function getVisiblePages()
	{
	    return $this->visiblePages;
	}
	 
	/**
	 * Establece el valor del atributo visiblePages.
	 *
	 * @param int $visiblePages
	 */
	public function setVisiblePages($visiblePages)
	{
	    $this->visiblePages = $visiblePages;
	}
	
	/**
	 * Devuelve el valor del atributo currentPage.
	 *
	 * @return int
	 */
	public function getCurrentPage()
	{
	    return $this->currentPage;
	}
	 
	/**
	 * Establece el valor del atributo currentPage.
	 *
	 * @param int $currentPage
	 */
	public function setCurrentPage($currentPage)
	{
		if($currentPage < 0)
		{
			$this->currentPage = 0;
		}
		elseif($currentPage > $this->calculatePagesNumber())
		{
			$this->currentPage = $this->calculatePagesNumber();
		}
		else
		{
			$this->currentPage = $currentPage;
		}
	}
	
	/**
	 * Devuelve la posición del primer elemento mostrado en la página actual.
	 * 
	 * @return int
	 */
	public function getFirstItemPosOnPage()
	{
		return ($this->currentPage - 1) * $this->itemsPerPage + 1;
	}
	
	/**
	 * Devuelve la posición del último elemento mostrado en la página actual.
	 * 
	 * @return int
	 */
	public function getLastItemPosOnPage()
	{
		return $this->getFirstItemPosOnPage() + $this->itemsPerPage - 1;
	}
	
	/**
	 * Calcula el número de páginas totales que componen el sistema de paginación.
	 * 
	 * @return int
	 */
	private function calculatePagesNumber()
	{
		$pagesNumber = 0;
		
		$itemsNumber = count($this->collection);
		
		$pagesNumber = floor($itemsNumber / $this->itemsPerPage);
		
		if($itemsNumber % $this->itemsPerPage > 0)
		{
			$pagesNumber = $pagesNumber + 1;
		}
		
		return $pagesNumber;
	}
	
	/**
	 * Imprime la salida por defecto del paginador.
	 * 
	 * @param int $currentPage
	 * 
	 * 		Número de página actual.
	 * 
	 * @return string
	 * 
	 * 		Cadena de texto que se mostrará en pantalla.
	 * 
	 * @throws Exception
	 * 
	 * 		Lanza una excepción en caso de que el formato del número
	 * 		de página no sea el correcto.
	 */
	public function standardPrint($currentPage)
	{
		if(!empty($currentPage))
		{
			if(is_numeric($currentPage))
			{
				$this->setCurrentPage($currentPage);
			}
			else
			{
				throw new Exception("El número de página es incorrecto. Se ha recibido " . $currentPage . ". Debe ser un número entero mayor que 0.");
			}
		}
	
		return $this->printer->standardPrint($this);
	}
	
}