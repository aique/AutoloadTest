<?php

class Library_Qframe_View_Element_CSS_Printer
{
	public static function printFile(Library_Qframe_View_Element_CSS_File $file)
	{
		return '<link rel="'.$file->getRel().'" type="'.$file->getType().'" href="'.$file->getHref().'" media="'.$file->getMedia().'" />';
	}
}