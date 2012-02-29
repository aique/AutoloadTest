<?php

class Library_Paginator_Paginator
{
	private $collection;
	private $itemsNumber;
	private $itemsPerPage;
	private $pagesNumber;
	private $currentPage;
	
	private $decorator;
	
	public function __construct($collection, $itemsPerPage, $decorator = null)
	{
		$this->collection = $collection;
		$this->itemsNumber = count($collection);
		$this->itemsPerPage = $itemsPerPage;
		$this->pagesNumber = $this->calculatePagesNumber();
		$this->currentPage = 1;
		
		if($decorator)
		{
			$this->decorator = $decorator;
		}
		else
		{
			$this->decorator = new Library_Paginator_Decorators_PaginatorStandarDecorator();
		}
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
	    $this->currentPage = $currentPage;
	}
	
	public function show($currentPage)
	{
		if(is_numeric($currentPage) && $currentPage > 0)
		{
			$this->currentPage = $currentPage;
		}
		
		return $this->decorator->show($this);
	}
	
	public function getFirstItemPosOnPage()
	{
		return ($this->currentPage - 1) * $this->itemsPerPage + 1;
	}
	
	public function getLastItemPosOnPage()
	{
		return $this->getFirstItemPosOnPage() + $this->itemsPerPage - 1;
	}
	
	private function calculatePagesNumber()
	{
		$pagesNumber = 0;
		
		$pagesNumber = $this->itemsNumber / $this->itemsPerPage;
		
		if($this->itemsNumber % $this->itemsPerPage > 0)
		{
			$pagesNumber = $pagesNumber + 1;
		}
		
		return $pagesNumber;
	}
	
}