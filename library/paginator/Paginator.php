<?php

class Library_Paginator_Paginator
{
	private $itemsNumber;
	private $itemsPerPage;
	private $pagesNumber;
	
	private $decorator;
	
	public function __construct($collection, $itemsPerPage, $decorator = null)
	{
		$this->itemsNumber = count($collection);
		$this->itemsPerPage = $itemsPerPage;
		$this->pagesNumber = $this->calculatePagesNumber();
		
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
	
	public function showPagination()
	{
		return $this->decorator->showPagination($this);
	}
	
	public function getFirstItemPosOnPage($currentPage = 1)
	{
		if(!$currentPage)
		{
			$currentPage = 1;
		}
		
		return ($currentPage - 1) * $this->itemsPerPage + 1;
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