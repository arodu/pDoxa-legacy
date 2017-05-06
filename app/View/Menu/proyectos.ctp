<h3>Proyectos</h3>
	<div>
<?php if(@$seleccionado) $estatus = 'activo'; else $estatus = 'inactivo';?>
      <div style="display: block;">
      <strong>Proyecto: </strong>
      </div>
      <div style="display: block;margin-bottom:8px;">
         <?php if(!@$seleccionado){
                  echo '<div style="display: block;" class="ui-state-error ui-corner-all">';
                  echo '<span class="ui-icon ui-icon-alert" style="float:left; margin-right: .3em;"></span>';
                  echo '<div style="margin-left: 1.6em">No seleccionado!</div>';
                  echo '</div>';
               }else{
                  echo '<div style="display: block;" class="ui-state-default ui-corner-all">';
                  echo '<div class="ui-icon ui-icon-tag" style="float: left; margin-right: .3em;"></div>';
                  echo '<div style="margin-left: 1.6em">'.@$seleccionado['nombre'].'</div>';
                  echo '</div>';
               }
         ?>
      </div>
      <ul class="submenu">
        <?php
            echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-extlink'))."Seleccione Proyecto",'/proyectos/seleccionar',array('escape'=>false)).'</li>';
            echo '<li class="activo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-newwin')).'Crear Nuevo Proyecto','/proyectos/add',array('escape'=>false)).'</li>';
            echo '<li class="inactivo content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-copy')).'Copiar de un Proyecto Anterior','',array('escape'=>false)).'</li>';
            echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-locked')).'Restricciones','/proyectos/restricciones/',array('escape'=>false)).'</li>';
            //echo '<li></li>';
            //echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-extlink'))."<strong>Ver Horarios</strong>",'/proyectos/resumen',array('escape'=>false)).'</li>';
            //echo '<li class="'.$estatus.' popup">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-print'))."Horarios por Docente",'/proyectos/cargaDocente',array('escape'=>false)).'</li>';
            //echo '<li class="'.$estatus.' popup">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-print'))."Asistencia Docente",'/proyectos/asistenciaDocente',array('escape'=>false)).'</li>';
            //echo '<li></li>';
            //echo '<li class="'.$estatus.'">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-pencil')).'Modificar','/proyectos/edit/'.@$seleccionado['id'],array('escape'=>false)).'</li>';
            //echo '<li class="'.$estatus.'">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-trash')).'Eliminar','/proyectos/delete/'.@$seleccionado['id'],array('id'=>'borrar', 'escape'=>false)).'</li>';
            echo '<li></li>';
            echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-document')).'Nueva Aula','/aulas/add/',array('escape'=>false)).'</li>';
            echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-folder-open')).'Indice de Aulas','/aulas/index/',array('escape'=>false)).'</li>';
            echo '<li></li>';
            echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-document')).'Nueva Seccion','/seccions/add/',array('escape'=>false)).'</li>';
            echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-folder-open')).'Indice de Secciones','/seccions/index/',array('escape'=>false)).'</li>';
            echo '<li></li>';
            //echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-newwin'))."Horario",'/proyectos/resumen/1',array('escape'=>false)).'</li>';
            echo '<li class="'.$estatus.' archivo">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-disk'))."Generar CSV",'/resumen/archivoCsv',array('escape'=>false)).'</li>';
         ?>
	  </ul>
	</div>

	<?php if(@$seleccionado): ?>
         <h3>Seleccionar Secciones</h3>
         <div>
            <?php echo '<ul class="submenu">';
                  echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-refresh'))."Maestro de Aulas",'/aulas/maestroAulas',array('escape'=>false)).'</li>';
                  echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-shuffle'))."Categorias de Aulas",'/aulas/categoriasMaestroAulas',array('escape'=>false)).'</li>';
                  echo '</ul>';
                  echo '<hr />'; ?>
                  <?php echo $this->Form->create();?>
                    <span id="selectMaterias" class="leftSelect">
                        <?php echo $this->Form->input('Materias',array('options'=>$materias,'empty'=>'<-- Seleccione -->'));?>
                    </span>

                    <span id="selectSecciones" class="leftSelect">
                        <?php echo $this->Form->input('Secciones',array('options'=>array(),'empty'=>'<-- Seleccione -->'));?>
                    </span>

                  <?php echo $this->Form->end();
                  echo '<div id="selectEncuentros"></div>';
            ?>
         </div>
         
         
         <h3>Horarios</h3>
         <div>
            <?php
                  echo '<ul class="submenu">';
                    echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-extlink'))."<strong>Ver Horarios</strong>",'/resumen/tabla',array('escape'=>false)).'</li>';
                    echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-extlink'))."Lista de Horarios",'/resumen/lista',array('escape'=>false)).'</li>';
                    echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-print'))."Horarios por Docente",'/resumen/cargaDocente',array('escape'=>false)).'</li>';
                    
                    echo '<li></li>';
                    echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-print'))."Listados de Asistencia",'/asistencias/planilla',array('escape'=>false)).'</li>';
                    echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-clock'))."Verificar Asistencia",'/asistencias/verificar',array('escape'=>false)).'</li>';
                    echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-print'))."Reporte de Asistencias",'/asistencias/reporte',array('escape'=>false)).'</li>';
                    echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-print'))."Reporte de Asistencias 2",'/asistencias/reporte2',array('escape'=>false)).'</li>';

                    echo '<li></li>';
                    echo '<li class="'.$estatus.' funjs">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-refresh'))."Refrescar",'#',array('escape'=>false,'id'=>'actualizar')).'</li>';
                    echo '<li class="'.$estatus.' funjs">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-print'))."Imprimir",'#',array('escape'=>false,'id'=>'imprimir')).'</li>';
                    echo '<li></li>';
                    echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-arrowthickstop-1-e'))."Revisión Docente",'/resumen/revisionDocente',array('escape'=>false)).'</li>';
                    echo '<li class="'.$estatus.' content">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-arrowthickstop-1-e'))."Memo Carga Horaria",'/resumen/memoCargaDocente',array('escape'=>false)).'</li>';
                  echo '</ul>';
                  
                  echo '<br/>';
                  echo '<strong>Formatos</strong>';
                  echo '<ul id="formatos" class="submenu">';
                    echo '<li class="'.$estatus.' funjs">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-note'))."Materias",'#',array('escape'=>false,'id'=>'tipo-materias')).'</li>';
                    echo '<li class="'.$estatus.' funjs">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-signal'))."Cupos",'#',array('escape'=>false,'id'=>'ocultar-cupos')).'</li>';
                    echo '<li class="'.$estatus.' funjs">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-person'))."Docentes",'#',array('escape'=>false,'id'=>'ocultar-docentes')).'</li>';
                    echo '<li class="'.$estatus.' funjs">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-clock'))."Horas",'#',array('escape'=>false,'id'=>'tipo-hora')).'</li>';
                    echo '<li class="'.$estatus.' funjs">'.$this->Html->link($this->Html->tag('span','',array('class'=>'ui-icon ui-icon-calendar'))."Dias",'#',array('escape'=>false,'id'=>'tipo-dia')).'</li>';
                  echo '</ul>';
            ?>
         </div>
         
         
   <?php endif; ?>

         