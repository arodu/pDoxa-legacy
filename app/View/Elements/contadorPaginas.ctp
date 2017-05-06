<?php
echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de {:count} en total, desde el registro {:start} hasta el {:end}')
//                      Página 1 de 6, mostrando 10 registros de 54 total, desde registros 1 hasta 10    
    
	));
?>