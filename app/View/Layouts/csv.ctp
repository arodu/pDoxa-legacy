<?php
header("Cache-Control: public"); 
header('Content-Type: text/csv; charset=utf-8'); // definimos el tipo MIME y la codificación
header('Content-Disposition: attachment; filename='.$title_for_layout.'.csv'); // Forzamos que el archivo se descargue con un nombre definido
echo $this->fetch('content');
?>