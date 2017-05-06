<?php if($refrescarMenu){ ?>
<script>
    cargarContent('<?php echo $this->Html->url(array('controller'=>'menu','action'=>$refrescarMenu), false);?>','#left','Cargando Menu.');
</script>
<?php } ?>