<?php

class Library_Paginator_Decorators_PaginatorStandarDecorator
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
				
				$output .= $item->printItem();
			}
		}
			
		$output .= '</ul></div>';
		
		return $output;
	}
	
	private static function printPagination($paginator, $output)
	{
		$output .= '<div id="paginator"><ul>';
			
		for($i = 1 ; $i < $paginator->getPagesNumber() ; $i++)
		{
			$output .= '<li><a href="'.Library_Manage_ResourceManager::getURLData().'/page/'.$i.'">'.$i.'</a></li>';
		}
			
		$output .= '</ul></div>';
		
		return $output;
	}
}