<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div id="accordionContenido">
<h3>Error 500</h3>
<div>
    <div style="text-align: center;">
        <?php echo $this->Html->image('error.png',array('style'=>'display: block; margin: auto;'));?>
        <h3 class="error ui-state-error">
            <?php echo $name; ?>
        </h3>
    </div>
    <?php 
    if (Configure::read('debug') > 0 ):  ?>
        <strong><?php echo __d('cake', 'Error'); ?>: </strong>
        <?php echo __d('cake', 'An Internal Error Has Occurred.');
        echo $this->element('exception_stack_trace');
    endif;
    ?>
</div>
</div>
<script>
   refrescarContenido();
</script>