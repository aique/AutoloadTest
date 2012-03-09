<?php

class Library_Paginator_Printer_DefaultPaginatorPrinter
{
	public static function show($paginator)
	{
		$collection = $paginator->getCollection();
		
		if(count($collection > 0))
		{
			$output = self::printCollection($paginator, $collection);
			
			$output = self::printPagination($paginator, $output);
		}
		else
		{
			$output = "No hay elementos para mostrar.";
		}
		
		return $output;
	}
	
	private static function printCollection($paginator, $collection)
	{
		$output = '<div id="users"><ul>';
		
		for($i = $paginator->getFirstItemPosOnPage() - 1 ; $i < $paginator->getLastItemPosOnPage() ; $i++)
		{
			if(isset($collection[$i]))
			{
				$item = $collection[$i];
				
				$output .= $item;
			}
		}
			
		$output .= '</ul></div>';
		
		return $output;
	}
	
	private static function printPagination($paginator, $output)
	{
		$request = Library_Manage_ResourceManager::getRequestData();
		
		$request->setParams(array());
		
		$pagesNumber = $paginator->getPagesNumber();
		
		if($pagesNumber > 1)
		{
			$output .= '<div id="paginator"><ul>';
			
			for($i = 1 ; $i <= $paginator->getPagesNumber() ; $i++)
			{
				$output .= '<li><a href="'.$request.'/page/'.$i.'">'.$i.'</a></li>';
			}
		}
		
		return $output;
	}
}