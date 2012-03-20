<h2><?php echo Library_Qframe_I18n_I18n::getText("screen_index_index_title"); ?></h2>

<p>
	
	Fecha actual: <?php echo Library_Qframe_I18n_I18n::getDate(new Library_Qframe_I18n_Date_Date(date("d"), date("m"), date("Y"))); ?>
	
</p>
	
<p>
	
	Ingresos en publicidad a día de hoy: <?php echo Library_Qframe_I18n_I18n::getMoney(new Library_Qframe_I18n_Money_Money(1745, 20)); ?>
	
</p>

<div class="row">

	<div class="span4">

		<?php echo $view["form"]; ?>
	
	</div>
	
</div>