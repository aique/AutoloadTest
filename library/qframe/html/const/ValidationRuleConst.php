<?php

/**
 * Constantes relacionadas con la validación de formularios HTML.
 * 
 * @package qframe
 * 
 * @subpackage html
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Html_Const_ValidationRuleConst
{
	// Constantes para la validación de campo requerido
	const REQUIRED = "required";
	
	// Constantes para la validación de formato
	const FORMAT = "format";
	
	// Posibles formatos soportados
	const NUMERIC_FORMAT = "numeric";
	const ALPHABETICAL_FORMAT = "alphabetical";
	const ALPHANUMERIC_FORMAT = "alphanumeric";
	const EMAIL = "email";
	
	// Constantes para la validación del contenido
	const FIELD_VALUE = "field_value";
	
	// Constantes para la validación con expresiones regulares
	const REGEX = "regex";
}