<div id="header">

	<h1><?php echo Library_I18n_I18n::getText("screen_common_layout_title"); ?></h1>
	
	<p>
	
		Fecha actual: <?php echo Library_I18n_I18n::getDate(new Library_I18n_Date_Date(date("d"), date("m"), date("Y"))); ?>
	
	</p>
	
	<p>
	
		Ingresos en publicidad a día de hoy: <?php echo Library_I18n_I18n::getMoney(new Library_I18n_Money_Money(1745, 20)); ?>
	
	</p>

</div>