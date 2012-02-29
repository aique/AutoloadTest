<?php

class Library_Paginator_Decorators_PaginatorStandarDecorator
{
	public static function showPagination($paginator)
	{
		$output = '<div id="paginator"><ul>';
		
		for($i = 1 ; $i < $paginator->getPagesNumber() ; $i++)
		{
			$output .= '<li><a href="'.Library_Manage_URLManager::getURLData().'/page/'.$i.'">'.$i.'</a></li>';
		}
		
		$output .= '</ul></div>';
		
		return $output;
	}
}