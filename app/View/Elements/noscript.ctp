<div class="noscript">
    <noscript>
            <div id="nojs" class="ui-widget-content">
                    <div id="central" class="ui-widget" style="max-width: 400px;">
                    <div class="ui-widget-header ui-state-active ui-corner-top" style="padding: .2em;">
                        <?php echo $this->element('icono',array('icono'=>'informacion','label'=>'Necesita Activar JavaScript')); ?>
                    </div>
                    <div class="ui-widget-content ui-corner-bottom" style="padding: 1em;">
                    Para ver esta aplicaci&oacute;n de manera optima, es necesario tener <strong>Javascript habilitado</strong> en tu navegador.<br />
                    Disculpa las molestias.
                    </div>
                    </div>
                    <style>
                            #central{
                                position:absolute;
                                top:50%;
                                left: 50%;
                                margin-top: -200px;
                                margin-left: -100px;
                            }

                            #nojs {
                                    position:absolute;
                                    top: 0px;
                                    left: 0px;
                                    right:0px; 
                                    bottom:0px;
                                    display:block;
                                    position:fixed;
                            /*	background-image: url(/content/media/img/overlay.png);  */
    /*				background: #dfeffc; */
                                    width:100%; 
                                    height:100%; 
                                    z-index:1000;
                            }
                    </style>
            </div>
    </noscript>
</div>