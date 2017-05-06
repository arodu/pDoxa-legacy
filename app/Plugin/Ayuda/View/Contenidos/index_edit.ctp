<div class="ayudaContenidos index">
	<h2><?php echo __('Ayuda Contenidos'); ?></h2>


	<?php // debug($ayudaContenidos);?>

	<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span> New Item'), array('controller' => 'contenidos', 'action' => 'add'), array('class'=>'btn btn-primary btn-xs','escape'=>false)); ?>

	<hr/>

	<table cellpadding="0" cellspacing="0" class="table">
		<tr>
			<th><?php echo 'id' ?></th>
			<th>
				<?php echo 'titulo' ?>
			</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>

		<?php foreach ($ayudaContenidos as $ayudaContenido['id'] => $ayudaContenido['titulo']): ?>
			<tr>
					<td><?php echo $ayudaContenido['id']; ?></td>
					<td>
						<?php echo $this->Html->link(__($ayudaContenido['titulo']), array('controller' => 'contenidos', 'action' => 'view',$ayudaContenido['id']), array('escape'=>false)); ?>
					</td>
					<td class="actions">
						<div class="btn-group">							
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-chevron-up"></span>', array('action' => 'move', 'up', $ayudaContenido['id']),array('class'=>'btn btn-primary btn-xs','escape'=>false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-chevron-down"></span>', array('action' => 'move', 'down', $ayudaContenido['id']),array('class'=>'btn btn-primary btn-xs','escape'=>false)); ?>
						</div>

						<div class="btn-group">
							<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span> Edit'), array('action' => 'edit', $ayudaContenido['id']),array('class'=>'btn btn-primary btn-xs','escape'=>false)); ?>
							<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span> Delete'), array('action' => 'delete', $ayudaContenido['id']),array('class'=>'btn btn-danger btn-xs','escape'=>false), __('Are you sure you want to delete # %s?', $ayudaContenido['id'])); ?>
						</div>
					</td>
			</tr>
		<?php endforeach; ?>
	</table>

</div>
