<?php

/**
 * Clase que gestiona visualmente una colección de elementos.
 * 
 * Representa la información de los elementos de la colección
 * de manera visual en un formato de lista, paginando los resultados
 * según las preferencias establecidas en el fichero de configuración.
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Paginator_Paginator
{
	private $collection;
	private $itemsNumber;
	private $itemsPerPage;
	private $visiblePages;
	private $pagesNumber;
	private $currentPage;
	
	private $printer;
	
	public function __construct($collection, $itemsPerPage, $visiblePages, $printer = null)
	{
		$this->collection = $collection;
		$this->itemsNumber = count($collection);
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
		
		$pagesNumber = floor($this->itemsNumber / $this->itemsPerPage);
		
		if($this->itemsNumber % $this->itemsPerPage > 0)
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
	 * @return
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