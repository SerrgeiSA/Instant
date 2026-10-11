<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="Bootstrap 4 Interface Builder | LayoutIt!" />
    <meta name="language" content="ru" />
    <title>Конструктор лендинга</title>

    <?php cmsTemplate::getInstance()->addMainTplCSSName(['theme']); ?>
    <?php cmsTemplate::getInstance()->onDemandTplCSSName(['photoswipe']); ?>
    <?php cmsTemplate::getInstance()->printCssTags(); ?>

    <link rel="shortcut icon" href="<?php echo cmsTemplate::getInstance()->getTemplateFilePath('images/favicons/favicon.ico'); ?>">
<script><?php echo cmsTemplate::getInstance()->getLangJS('LANG_LOADING', 'LANG_ALL'); ?></script>

    <script type="text/javascript" src="/templates/default/controllers/smartlanding/js/jquery.min.js"></script>
    <script type="text/javascript" src="/templates/default/controllers/smartlanding/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/templates/default/controllers/smartlanding/js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="/templates/default/controllers/smartlanding/js/jquery.html-clean.min.js"></script>

    <script type="text/javascript" src="/templates/default/controllers/smartlanding/js/general.js"></script>
    <script type="text/javascript" src="/templates/default/controllers/smartlanding/js/builder.js?26"></script>

    <script type="text/javascript" src="/templates/default/controllers/smartlanding/js/tether.min.js"></script>
    <script type="text/javascript" src="/templates/default/controllers/smartlanding/js/popper.min.js"></script>

    <?php //cmsTemplate::getInstance()->addMainTplJSName('vendors/popper.js/js/popper.min'); ?>
    <?php //cmsTemplate::getInstance()->onDemandTplJSName(['vendors/photoswipe/photoswipe.min']); ?>
    <?php //cmsTemplate::getInstance()->addMainTplJSName('core'); ?>
    <?php //cmsTemplate::getInstance()->addMainTplJSName('modal'); ?>


    <?php
            $this->addTplJSName([
                'datatree',
                'admin-widgets'
            ]);
            cmsTemplate::getInstance()->printJavascriptTags();
    ?>





    <link rel="stylesheet" href="/templates/default/controllers/smartlanding/css/bootstrap.min.css">


    <link rel="stylesheet" href="/templates/admincoreui/css/style.css">
    <script src="/templates/default/controllers/smartlanding/js/bootstrap.min.js" ></script>
    <!-- LESS include for dev only -->

    <script src="/templates/modern/js/vendors/popper.js/js/popper.min.js?1604042979"></script>
    <script src="/templates/modern/js/core.js?1604042979"></script>
    <script src="/templates/modern/js/modal.js?1604042979"></script>
    <script src="/templates/modern/js/vendors/toastr/toastr.min.js?1604042979"></script>
    <script src="/templates/modern/js/widgets.js?1604042979"></script>

    <link rel="stylesheet/less" type="text/css" href="/templates/default/controllers/smartlanding/less/common.css" />
    <link rel="stylesheet/less" type="text/css" href="/templates/default/controllers/smartlanding/less/homepage.css" />
    <link rel="stylesheet/less" type="text/css" href="/templates/default/controllers/smartlanding/less/builder.css" />
    <link rel="stylesheet/less" type="text/css" href="/templates/default/controllers/smartlanding/less/profile.css" />
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:400,400i,700,700i,900,900i" rel="stylesheet">

    <script src="/templates/default/controllers/smartlanding/js/less.min.js" ></script>
    <script defer src="/templates/default/controllers/smartlanding/js/all.js"></script>



    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-33375730-1', 'layoutit.com');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
    </script>

</head>

<body class="edit builder">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navbar-layoutit">
    <div class="navbar-header">
        <a class="navbar-brand" href=""> Конструктор</a>
        <ul class="navbar-nav mr-auto" id="menu-layoutit">
            <li class="tools-btns">
                <div data-toggle="buttons-radio">
                    <button id="edit" class="active btn btn-primary"><i class="fas fa-edit"></i> <span> Редактирование </span></button>
                    <button class="btn btn-primary" id="sourcepreview"><i class="fas fa-eye"></i>  <span> Просмотр </span> </button>
                    <?php /*<button class="btn btn-primary" id="button-download-modal" href="build_v4/downloadAjax" data-target="#layoutitModal" data-toggle="modal"><i class="fas fa-download"></i>  <span> Загрузить код </span> </button>
                    <button class="btn btn-primary" id="button-share-modal" href="share/indexV4" data-toggle="modal" data-target="#layoutitModal" data-toggle="modal"><i class="fas fa-share"></i> <span> Ссылка </span> </button>*/?>
                    <button class="btn btn-primary" href="#clear" id="clear"><i class="fas fa-trash-alt"></i><span> Удалить всё </span></button>
                </div>
            </li>
        </ul>
    </div>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="demo">
            <div class="lyrow ui-draggable" style="">
                <a href="#close" class="remove badge badge-danger"><svg class="svg-inline--fa fa-times fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"></path></svg><!-- <i class="fas fa-times"></i> --> Удалить</a>
                <span class="drag badge badge-default ui-draggable-handle ui-sortable-handle"><svg class="svg-inline--fa fa-arrows-alt fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="arrows-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M352.201 425.775l-79.196 79.196c-9.373 9.373-24.568 9.373-33.941 0l-79.196-79.196c-15.119-15.119-4.411-40.971 16.971-40.97h51.162L228 284H127.196v51.162c0 21.382-25.851 32.09-40.971 16.971L7.029 272.937c-9.373-9.373-9.373-24.569 0-33.941L86.225 159.8c15.119-15.119 40.971-4.411 40.971 16.971V228H228V127.196h-51.23c-21.382 0-32.09-25.851-16.971-40.971l79.196-79.196c9.373-9.373 24.568-9.373 33.941 0l79.196 79.196c15.119 15.119 4.411 40.971-16.971 40.971h-51.162V228h100.804v-51.162c0-21.382 25.851-32.09 40.97-16.971l79.196 79.196c9.373 9.373 9.373 24.569 0 33.941L425.773 352.2c-15.119 15.119-40.971 4.411-40.97-16.971V284H284v100.804h51.23c21.382 0 32.09 25.851 16.971 40.971z"></path></svg><!-- <i class="fas fa-arrows-alt"></i> --> drag</span>
                <div class="preview"><input type="text" value="4 4 4" placeholder="Enter your own" class="form-control"></div>
                <div class="view">
                    <div class="row">
                        <div class="col-md-4 column ui-sortable"><div class="box box-element ui-draggable" style="">
                                <a href="#close" class="remove badge badge-danger"><svg class="svg-inline--fa fa-times fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"></path></svg><!-- <i class="fas fa-times"></i> --> Удалить</a>
                                <span class="drag badge badge-default ui-draggable-handle ui-sortable-handle"><svg class="svg-inline--fa fa-arrows-alt fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="arrows-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M352.201 425.775l-79.196 79.196c-9.373 9.373-24.568 9.373-33.941 0l-79.196-79.196c-15.119-15.119-4.411-40.971 16.971-40.97h51.162L228 284H127.196v51.162c0 21.382-25.851 32.09-40.971 16.971L7.029 272.937c-9.373-9.373-9.373-24.569 0-33.941L86.225 159.8c15.119-15.119 40.971-4.411 40.971 16.971V228H228V127.196h-51.23c-21.382 0-32.09-25.851-16.971-40.971l79.196-79.196c9.373-9.373 24.568-9.373 33.941 0l79.196 79.196c15.119 15.119 4.411 40.971-16.971 40.971h-51.162V228h100.804v-51.162c0-21.382 25.851-32.09 40.97-16.971l79.196 79.196c9.373 9.373 9.373 24.569 0 33.941L425.773 352.2c-15.119 15.119-40.971 4.411-40.97-16.971V284H284v100.804h51.23c21.382 0 32.09 25.851 16.971 40.971z"></path></svg><!-- <i class="fas fa-arrows-alt"></i> --> drag</span>
                                <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Styles <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" rel="badge-default">Default</a>
				<a href="#" class="dropdown-item" rel="badge-primary">Primary</a>
				<a href="#" class="dropdown-item" rel="badge-success">Success</a>
				<a href="#" class="dropdown-item" rel="badge-info">Info</a>
				<a href="#" class="dropdown-item" rel="badge-warning">Warning</a>
				<a href="#" class="dropdown-item" rel="badge-danger">Danger</a>
			</div>
</span>
	</span>
                                <div class="preview">Label</div>
                                <div class="view">
                                    <span class="badge badge-default" contenteditable="true">Label</span>
                                </div>
                            </div></div>
                        <div class="col-md-4 column ui-sortable"></div>
                        <div class="col-md-4 column ui-sortable"></div>
                    </div>
                </div>
            </div><div class="lyrow ui-draggable" style="">
                <a href="#close" class="remove badge badge-danger"><svg class="svg-inline--fa fa-times fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"></path></svg><!-- <i class="fas fa-times"></i> --> Удалить</a>
                <span class="drag badge badge-default ui-draggable-handle ui-sortable-handle"><svg class="svg-inline--fa fa-arrows-alt fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="arrows-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M352.201 425.775l-79.196 79.196c-9.373 9.373-24.568 9.373-33.941 0l-79.196-79.196c-15.119-15.119-4.411-40.971 16.971-40.97h51.162L228 284H127.196v51.162c0 21.382-25.851 32.09-40.971 16.971L7.029 272.937c-9.373-9.373-9.373-24.569 0-33.941L86.225 159.8c15.119-15.119 40.971-4.411 40.971 16.971V228H228V127.196h-51.23c-21.382 0-32.09-25.851-16.971-40.971l79.196-79.196c9.373-9.373 24.568-9.373 33.941 0l79.196 79.196c15.119 15.119 4.411 40.971-16.971 40.971h-51.162V228h100.804v-51.162c0-21.382 25.851-32.09 40.97-16.971l79.196 79.196c9.373 9.373 9.373 24.569 0 33.941L425.773 352.2c-15.119 15.119-40.971 4.411-40.97-16.971V284H284v100.804h51.23c21.382 0 32.09 25.851 16.971 40.971z"></path></svg><!-- <i class="fas fa-arrows-alt"></i> --> drag</span>
                <div class="preview"><input type="text" value="12" placeholder="Enter your own" class="form-control"></div>
                <div class="view">
                    <div class="row">
                        <div class="col-md-12 column ui-sortable"></div>
                    </div>
                </div>
            </div><div class="lyrow" style="display: block;">
                <a href="#close" class="remove badge badge-danger"><svg class="svg-inline--fa fa-times fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"></path></svg><!-- <i class="fas fa-times"></i> --> Удалить</a>
                <span class="drag badge badge-default ui-sortable-handle"><svg class="svg-inline--fa fa-arrows-alt fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="arrows-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M352.201 425.775l-79.196 79.196c-9.373 9.373-24.568 9.373-33.941 0l-79.196-79.196c-15.119-15.119-4.411-40.971 16.971-40.97h51.162L228 284H127.196v51.162c0 21.382-25.851 32.09-40.971 16.971L7.029 272.937c-9.373-9.373-9.373-24.569 0-33.941L86.225 159.8c15.119-15.119 40.971-4.411 40.971 16.971V228H228V127.196h-51.23c-21.382 0-32.09-25.851-16.971-40.971l79.196-79.196c9.373-9.373 24.568-9.373 33.941 0l79.196 79.196c15.119 15.119 4.411 40.971-16.971 40.971h-51.162V228h100.804v-51.162c0-21.382 25.851-32.09 40.97-16.971l79.196 79.196c9.373 9.373 9.373 24.569 0 33.941L425.773 352.2c-15.119 15.119-40.971 4.411-40.97-16.971V284H284v100.804h51.23c21.382 0 32.09 25.851 16.971 40.971z"></path></svg><!-- <i class="fas fa-arrows-alt"></i> --> drag</span>
                <div class="preview">4 4 4</div>
                <div class="view">
                    <div class="row">
                        <div class="col-md-4 column ui-sortable" style="">
                            <div class="box box-element ui-draggable" style="">
                                <a href="#close" class="remove badge badge-danger"><svg class="svg-inline--fa fa-times fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"></path></svg><!-- <i class="fas fa-times"></i> --> Удалить</a>
                                <span class="drag badge badge-default ui-draggable-handle ui-sortable-handle"><svg class="svg-inline--fa fa-arrows-alt fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="arrows-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M352.201 425.775l-79.196 79.196c-9.373 9.373-24.568 9.373-33.941 0l-79.196-79.196c-15.119-15.119-4.411-40.971 16.971-40.97h51.162L228 284H127.196v51.162c0 21.382-25.851 32.09-40.971 16.971L7.029 272.937c-9.373-9.373-9.373-24.569 0-33.941L86.225 159.8c15.119-15.119 40.971-4.411 40.971 16.971V228H228V127.196h-51.23c-21.382 0-32.09-25.851-16.971-40.971l79.196-79.196c9.373-9.373 24.568-9.373 33.941 0l79.196 79.196c15.119 15.119 4.411 40.971-16.971 40.971h-51.162V228h100.804v-51.162c0-21.382 25.851-32.09 40.97-16.971l79.196 79.196c9.373 9.373 9.373 24.569 0 33.941L425.773 352.2c-15.119 15.119-40.971 4.411-40.97-16.971V284H284v100.804h51.23c21.382 0 32.09 25.851 16.971 40.971z"></path></svg><!-- <i class="fas fa-arrows-alt"></i> --> drag</span>
                                <div class="preview">Modal</div>
                                <div class="view">
                                    <!-- Button to trigger modal -->
                                    <a id="modal-946284" href="#modal-container-946284" role="button" class="btn" data-toggle="modal">Launch demo modal</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-container-946284" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel" contenteditable="true">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body" contenteditable="true">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" contenteditable="true">Save changes</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" contenteditable="true">Close</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                </div>
                            </div><div class="box box-element" style="position: relative; opacity: 1; left: 0px; top: 0px;">
                                <a href="#close" class="remove badge badge-danger"><svg class="svg-inline--fa fa-times fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"></path></svg><!-- <i class="fas fa-times"></i> --> Удалить</a>
                                <span class="drag badge badge-default ui-sortable-handle"><svg class="svg-inline--fa fa-arrows-alt fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="arrows-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M352.201 425.775l-79.196 79.196c-9.373 9.373-24.568 9.373-33.941 0l-79.196-79.196c-15.119-15.119-4.411-40.971 16.971-40.97h51.162L228 284H127.196v51.162c0 21.382-25.851 32.09-40.971 16.971L7.029 272.937c-9.373-9.373-9.373-24.569 0-33.941L86.225 159.8c15.119-15.119 40.971-4.411 40.971 16.971V228H228V127.196h-51.23c-21.382 0-32.09-25.851-16.971-40.971l79.196-79.196c9.373-9.373 24.568-9.373 33.941 0l79.196 79.196c15.119 15.119 4.411 40.971-16.971 40.971h-51.162V228h100.804v-51.162c0-21.382 25.851-32.09 40.97-16.971l79.196 79.196c9.373 9.373 9.373 24.569 0 33.941L425.773 352.2c-15.119 15.119-40.971 4.411-40.97-16.971V284H284v100.804h51.23c21.382 0 32.09 25.851 16.971 40.971z"></path></svg><!-- <i class="fas fa-arrows-alt"></i> --> drag</span>
                                <div class="preview">Text</div>
                                <div class="view">
                                    <h2 contenteditable="true">Heading</h2>
                                    <p spellcheck="false" contenteditable="true">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                                    <p><a class="btn" href="#" contenteditable="true">View details »</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 column ui-sortable" style="">
                            <div class="box box-element"><grammarly-extension style="position: absolute; top: 0px; left: 0px; pointer-events: none;" class="_1KJtL"></grammarly-extension>
                                <a href="#close" class="remove badge badge-danger"><svg class="svg-inline--fa fa-times fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"></path></svg><!-- <i class="fas fa-times"></i> --> Удалить</a>
                                <span class="drag badge badge-default ui-sortable-handle"><svg class="svg-inline--fa fa-arrows-alt fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="arrows-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M352.201 425.775l-79.196 79.196c-9.373 9.373-24.568 9.373-33.941 0l-79.196-79.196c-15.119-15.119-4.411-40.971 16.971-40.97h51.162L228 284H127.196v51.162c0 21.382-25.851 32.09-40.971 16.971L7.029 272.937c-9.373-9.373-9.373-24.569 0-33.941L86.225 159.8c15.119-15.119 40.971-4.411 40.971 16.971V228H228V127.196h-51.23c-21.382 0-32.09-25.851-16.971-40.971l79.196-79.196c9.373-9.373 24.568-9.373 33.941 0l79.196 79.196c15.119 15.119 4.411 40.971-16.971 40.971h-51.162V228h100.804v-51.162c0-21.382 25.851-32.09 40.97-16.971l79.196 79.196c9.373 9.373 9.373 24.569 0 33.941L425.773 352.2c-15.119 15.119-40.971 4.411-40.97-16.971V284H284v100.804h51.23c21.382 0 32.09 25.851 16.971 40.971z"></path></svg><!-- <i class="fas fa-arrows-alt"></i> --> drag</span>
                                <div class="preview">Text</div>
                                <div class="view">
                                    <h2 contenteditable="true">Heading</h2>
                                    <p spellcheck="false" contenteditable="true">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                                    <p><a class="btn" href="#" contenteditable="true">View details »</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 column ui-sortable" style="">
                            <div class="box box-element">
                                <a href="#close" class="remove badge badge-danger"><svg class="svg-inline--fa fa-times fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"></path></svg><!-- <i class="fas fa-times"></i> --> Удалить</a>
                                <span class="drag badge badge-default ui-sortable-handle"><svg class="svg-inline--fa fa-arrows-alt fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="arrows-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M352.201 425.775l-79.196 79.196c-9.373 9.373-24.568 9.373-33.941 0l-79.196-79.196c-15.119-15.119-4.411-40.971 16.971-40.97h51.162L228 284H127.196v51.162c0 21.382-25.851 32.09-40.971 16.971L7.029 272.937c-9.373-9.373-9.373-24.569 0-33.941L86.225 159.8c15.119-15.119 40.971-4.411 40.971 16.971V228H228V127.196h-51.23c-21.382 0-32.09-25.851-16.971-40.971l79.196-79.196c9.373-9.373 24.568-9.373 33.941 0l79.196 79.196c15.119 15.119 4.411 40.971-16.971 40.971h-51.162V228h100.804v-51.162c0-21.382 25.851-32.09 40.97-16.971l79.196 79.196c9.373 9.373 9.373 24.569 0 33.941L425.773 352.2c-15.119 15.119-40.971 4.411-40.97-16.971V284H284v100.804h51.23c21.382 0 32.09 25.851 16.971 40.971z"></path></svg><!-- <i class="fas fa-arrows-alt"></i> --> drag</span>
                                <div class="preview">Text</div>
                                <div class="view">
                                    <h2 contenteditable="true">Heading</h2>
                                    <p contenteditable="true">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                                    <p><a class="btn" href="#" contenteditable="true">View details »</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>			</div>
        <div class="sidebar-nav">

            <ul class="nav nav-list flex-column accordion-group">
                <li class="nav-item nav-header">
                    <div class="float-right popover-info"><i class="fas fa-question-circle"></i>
                        <div class="popover fade right"><div class="arrow"></div>
                            <h3 class="popover-title">Help</h3>
                            <div class="popover-content">To change the column configuration you can edit the different values in the input (they should add 12). If you need more info please visit <a target="_blank" href="http://getbootstrap.com/css/#grid">Bootstrap grid system.</a></div></div>
                    </div>
                    <i class="fas fa-plus"></i> Grid system
                </li>
                <li class="rows" id="estRows">

                    <div class="lyrow">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default "><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview"><input type="text" value="12" placeholder="Enter your own" class="form-control"></div>
                        <div class="view">
                            <div class="row">
                                <div class="col-md-12 column"></div>
                            </div>
                        </div>
                    </div>
                    <div class="lyrow">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default "><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview"><input type="text" value="6 6" placeholder="Enter your own" class="form-control"></div>
                        <div class="view">
                            <div class="row">
                                <div class="col-md-6 column"></div>
                                <div class="col-md-6 column"></div>
                            </div>
                        </div>
                    </div>
                    <div class="lyrow">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default "><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview"><input type="text" value="8 4" placeholder="Enter your own" class="form-control"></div>
                        <div class="view">
                            <div class="row">
                                <div class="col-md-8 column"></div>
                                <div class="col-md-4 column"></div>
                            </div>
                        </div>
                    </div>
                    <div class="lyrow">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default "><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview"><input type="text" value="4 4 4" placeholder="Enter your own" class="form-control"></div>
                        <div class="view">
                            <div class="row">
                                <div class="col-md-4 column"></div>
                                <div class="col-md-4 column"></div>
                                <div class="col-md-4 column"></div>
                            </div>
                        </div>
                    </div>
                    <div class="lyrow">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default display-none"><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview"><input type="text" value="" placeholder="Enter your own" class="form-control"></div>
                        <div class="view">
                            <div class="row">
                            </div>
                        </div>
                    </div>	</li>
            </ul>

            <?php
                foreach ($widgets_list as $key=>$items){
                    ?>
            <ul class="nav flex-column accordion-group">
                <li class="nav-item nav-header"><i class="fas fa-plus"></i> <?php echo $key == '' ? "Базовые" : $key;?>
                    <div class="float-right popover-info"><i class="fas fa-question-circle"></i>
                        <div class="popover fade right"><div class="arrow"></div>
                            <h3 class="popover-title">Описание </h3>
                            <div class="popover-content">Drag &amp; Drop the elements inside the columns where you want to insert it. And from there, you can configure the style of that element. If you need more info please visit <a target="_blank" href="http://getbootstrap.com/css">Base CSS.</a></div></div>
                    </div>
                </li>
                <li class="boxes" id="elmBase">
                <?php
                    foreach ($items as $item){ ?>
                        <div class="box box-element wbox newwidget" data-id="<?php echo $item['id'];?>">
                            <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                            <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i></span>
                            <div class="preview"><?php echo $item['title'];?></div>
                            <div class="view">
                                <div class="widget" data-id="<?php echo $item['id'];?>">
                                    <div class="widgetcontent">Пустой виджет, нужно настроить</div>

                                    <div class="edit_wlinks">
                                        <span class="edit btn btn-secondary btn-sm btn-warning" href="#" title="Редактировать" data-id="" data-url="/admin/widgets/edit" data-name="modern" onclick="widgetEdit2($(this).attr('bind-id')); return false;">
                                            <svg class="icms-svg-icon w-16" fill="currentColor"><use xlink:href="/templates/modern/images/icons/solid.svg#edit"></use></svg> </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php }
                ?>
                </li>
            </ul>
                <?php
                   // break;
                }


            ?>

            <ul class="nav flex-column accordion-group">
                <li class="nav-item nav-header"><i class="fas fa-plus"></i> Base CSS
                    <div class="float-right popover-info"><i class="fas fa-question-circle"></i>
                        <div class="popover fade right"><div class="arrow"></div>
                            <h3 class="popover-title">Help</h3>
                            <div class="popover-content">Drag &amp; Drop the elements inside the columns where you want to insert it. And from there, you can configure the style of that element. If you need more info please visit <a target="_blank" href="http://getbootstrap.com/css">Base CSS.</a></div></div>
                    </div>
                </li>
                <li class="boxes" id="elmBase">
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Align <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="active" rel="">Default</a>
				<a href="#" class="dropdown-item" class="" rel="text-left">Left</a>
				<a href="#" class="dropdown-item" class="" rel="text-center">Center</a>
				<a href="#" class="dropdown-item" class="" rel="text-right">Right</a>
			</div>
</span>
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Emphasis <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="active" rel="">Default</a>
				<a href="#" class="dropdown-item" class="" rel="text-muted">Muted</a>
				<a href="#" class="dropdown-item" class="" rel="text-primary">Primary</a>
				<a href="#" class="dropdown-item" class="" rel="text-success">Success</a>
				<a href="#" class="dropdown-item" class="" rel="text-info">Info</a>
				<a href="#" class="dropdown-item" class="" rel="text-warning">Warning</a>
				<a href="#" class="dropdown-item" class="" rel="text-danger">Danger</a>
			</div>
</span>
	</span>
                        <div class="preview">Title</div>
                        <div class="view">
                            <h3 contenteditable="true">h3. Lorem ipsum dolor sit amet.</h3>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Align <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="active" rel="">Default</a>
				<a href="#" class="dropdown-item" class="" rel="text-left">Left</a>
				<a href="#" class="dropdown-item" class="" rel="text-center">Center</a>
				<a href="#" class="dropdown-item" class="" rel="text-right">Right</a>
			</div>
</span>
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Emphasis <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="active" rel="">Default</a>
				<a href="#" class="dropdown-item" class="" rel="text-muted">Muted</a>
				<a href="#" class="dropdown-item" class="" rel="text-primary">Primary</a>
				<a href="#" class="dropdown-item" class="" rel="text-success">Success</a>
				<a href="#" class="dropdown-item" class="" rel="text-info">Info</a>
				<a href="#" class="dropdown-item" class="" rel="text-warning">Warning</a>
				<a href="#" class="dropdown-item" class="" rel="text-danger">Danger</a>
			</div>
</span>

		<a class="btn btn-sm btn-default" href="#" rel="lead">Lead</a>
	</span>
                        <div class="preview">Paragraph</div>
                        <div class="view">
                            <p contenteditable="true">Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu. </small></p>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview">Address</div>
                        <div class="view">
                            <address contenteditable="true">
                                <strong>Twitter, Inc.</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<a class="btn btn-sm btn-default" href="#" rel="text-right">Pull right</a>
	</span>
                        <div class="preview">Blockquote</div>
                        <div class="view">
                            <blockquote class="blockquote" contenteditable="true">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<a class="btn btn-sm btn-default" href="#" rel="list-unstyled">Unstyled</a>
		<a class="btn btn-sm btn-default" href="#" data-class="list-item" rel="list-inline-item">Inline</a>
	</span>
                        <div class="preview">Unordered List</div>
                        <div class="view">
                            <ul contenteditable="true">
                                <li class="list-item">Lorem ipsum dolor sit amet</li>
                                <li class="list-item">Consectetur adipiscing elit</li>
                                <li class="list-item">Integer molestie lorem at massa</li>
                                <li class="list-item">Facilisis in pretium nisl aliquet</li>
                                <li class="list-item">Nulla volutpat aliquam velit</li>
                                <li class="list-item">Faucibus porta lacus fringilla vel</li>
                                <li class="list-item">Aenean sit amet erat nunc</li>
                                <li class="list-item">Eget porttitor lorem</li>
                            </ul>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<a class="btn btn-sm btn-default" href="#" rel="list-unstyled">Unstyled</a>
		<a class="btn btn-sm btn-default" href="#" data-class="list-item" rel="list-inline-item">Inline</a>
	</span>
                        <div class="preview">Ordered List</div>
                        <div class="view">
                            <ol contenteditable="true">
                                <li class="list-item">Lorem ipsum dolor sit amet</li>
                                <li class="list-item">Consectetur adipiscing elit</li>
                                <li class="list-item">Integer molestie lorem at massa</li>
                                <li class="list-item">Facilisis in pretium nisl aliquet</li>
                                <li class="list-item">Nulla volutpat aliquam velit</li>
                                <li class="list-item">Faucibus porta lacus fringilla vel</li>
                                <li class="list-item">Aenean sit amet erat nunc</li>
                                <li class="list-item">Eget porttitor lorem</li>
                            </ol>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
	</span>
                        <div class="preview">Description</div>
                        <div class="view">
                            <dl contenteditable="true">
                                <dt>Description lists</dt>
                                <dd>A description list is perfect for defining terms.</dd>
                                <dt>Euismod</dt>
                                <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                                <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                                <dt>Malesuada porta</dt>
                                <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                                <dt>Felis euismod semper eget lacinia</dt>
                                <dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Style <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="active" rel="">Default</a>
				<a href="#" class="dropdown-item" class="" rel="table-striped">Striped</a>
				<a href="#" class="dropdown-item" class="" rel="table-bordered">Bordered</a>
			</div>
</span>
		<a class="btn btn-sm btn-default" href="#" rel="table-hover">Hover</a>
		<a class="btn btn-sm btn-default" href="#" rel="table-sm">Condensed</a>
	</span>
                        <div class="preview">Table</div>
                        <div class="view">
                            <table class="table" contenteditable="true">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Payment Taken</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>TB - Monthly</td>
                                    <td>01/04/2012</td>
                                    <td>Default</td>
                                </tr>
                                <tr class="table-active">
                                    <td>1</td>
                                    <td>TB - Monthly</td>
                                    <td>01/04/2012</td>
                                    <td>Approved</td>
                                </tr>
                                <tr class="table-success">
                                    <td>2</td>
                                    <td>TB - Monthly</td>
                                    <td>02/04/2012</td>
                                    <td>Declined</td>
                                </tr>
                                <tr class="table-warning">
                                    <td>3</td>
                                    <td>TB - Monthly</td>
                                    <td>03/04/2012</td>
                                    <td>Pending</td>
                                </tr>
                                <tr class="table-danger">
                                    <td>4</td>
                                    <td>TB - Monthly</td>
                                    <td>04/04/2012</td>
                                    <td>Call in to confirm</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<a class="btn btn-sm btn-secondary" href="#" rel="form-inline">Inline</a>
	</span>
                        <div class="preview">Form</div>
                        <div class="view">
                            <form role="form">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <input type="file" class="form-control-file" id="exampleInputFile">
                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Check me out
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Styles <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="" rel="btn-primary">Primary</a>
				<a href="#" class="dropdown-item" class="" rel="btn-secondary">Secondary</a>
				<a href="#" class="dropdown-item" class="" rel="btn-success">Success</a>
				<a href="#" class="dropdown-item" class="" rel="btn-info">Info</a>
				<a href="#" class="dropdown-item" class="" rel="btn-warning">Warning</a>
				<a href="#" class="dropdown-item" class="" rel="btn-danger">Danger</a>
				<a href="#" class="dropdown-item" class="" rel="btn-link">Link</a>
				<a href="#" class="dropdown-item" class="" rel="btn-outline-primary">Primary outline</a>
				<a href="#" class="dropdown-item" class="" rel="btn-outline-secondary">Secondary outline</a>
				<a href="#" class="dropdown-item" class="" rel="btn-outline-success">Success outline</a>
				<a href="#" class="dropdown-item" class="" rel="btn-outline-info">Info outline</a>
				<a href="#" class="dropdown-item" class="" rel="btn-outline-warning">Warning outline</a>
				<a href="#" class="dropdown-item" class="" rel="btn-outline-danger">Danger outline</a>
			</div>
</span>
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Size <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="" rel="btn-lg">Large</a>
				<a href="#" class="dropdown-item" class="" rel="btn-md">Default</a>
				<a href="#" class="dropdown-item" class="" rel="btn-sm">Small</a>
			</div>
</span>

		<a class="btn btn-sm btn-secondary" href="#" rel="btn-block">Block</a>
		<a class="btn btn-sm btn-secondary" href="#" rel="active">Active</a>
		<a class="btn btn-sm btn-secondary" href="#" rel="disabled">Disabled</a>
	</span>
                        <div class="preview">Button</div>
                        <div class="view">
                            <button type="button" class="btn btn-success" contenteditable="true">Button</button>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Styles <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="" rel="btn-primary">Primary</a>
				<a href="#" class="dropdown-item" class="" rel="btn-secondary">Secondary</a>
				<a href="#" class="dropdown-item" class="" rel="btn-success">Success</a>
				<a href="#" class="dropdown-item" class="" rel="btn-info">Info</a>
				<a href="#" class="dropdown-item" class="" rel="btn-warning">Warning</a>
				<a href="#" class="dropdown-item" class="" rel="btn-danger">Danger</a>
				<a href="#" class="dropdown-item" class="" rel="btn-link">Link</a>
			</div>
</span>
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Size <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="" rel="btn-lg">Large</a>
				<a href="#" class="dropdown-item" class="" rel="btn-md">Default</a>
				<a href="#" class="dropdown-item" class="" rel="btn-sm">Small</a>
			</div>
</span>

		<a class="btn btn-sm btn-secondary" href="#" rel="btn-block">Block</a>
		<a class="btn btn-sm btn-secondary" href="#" rel="active">Active</a>
		<a class="btn btn-sm btn-secondary" href="#" rel="disabled">Disabled</a>
	</span>
                        <div class="preview">Anchor Button</div>
                        <div class="view">
                            <a href="#" class="btn btn-secondary" type="button" contenteditable="true">Button</a>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Styles <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="active" rel="">Default</a>
				<a href="#" class="dropdown-item" class="" rel="rounded">Rounded</a>
				<a href="#" class="dropdown-item" class="" rel="rounded-circle">Circle</a>
				<a href="#" class="dropdown-item" class="" rel="img-thumbnail">Thumbnail</a>
			</div>
</span>
	</span>
                        <div class="preview">Image</div>
                        <div class="view">
                            <img alt="Bootstrap Image Preview" src="https://www.layoutit.com/img/sports-q-c-140-140-3.jpg">
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="nav nav-list flex-column accordion-group">
                <li class="nav-item nav-header"><i class="fas fa-plus"></i> Components <div class="float-right popover-info"><i class="fas fa-question-circle"></i>
                        <div class="popover fade right"><div class="arrow"></div>
                            <h3 class="popover-title">Help</h3>
                            <div class="popover-content">Drag &amp; Drop the elements inside the columns where you want to insert it. And from there, you can configure the style of that component. If you need more info please visit  <a target="_blank" href="http://getbootstrap.com/components">Components.</a></div></div>
                    </div>
                </li>
                <li class="boxes" id="elmComponents">
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Size <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="active" rel="">Default</a>
				<a href="#" class="dropdown-item" class="" rel="btn-group-lg">Large</a>
				<a href="#" class="dropdown-item" class="" rel="btn-group-md">Medium</a>
				<a href="#" class="dropdown-item" class="" rel="btn-group-sm">Small</a>
			</div>
</span>
    <a class="btn btn-sm btn-secondary" href="#" rel="btn-group-vertical">Vertical</a>
  </span>
                        <div class="preview">Button Group</div>
                        <div class="view">
                            <div class="btn-group" role="group">
                                <button class="btn btn-secondary" type="button">Left</button>
                                <button class="btn btn-secondary" type="button">Center</button>
                                <button class="btn btn-secondary" type="button">Right</button>
                                <button class="btn btn-secondary" type="button">Justify</button>
                            </div>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<a class="btn btn-sm btn-secondary" href="#" rel="dropup">Dropup</a>
	</span>
                        <div class="preview">Dropdowns</div>
                        <div class="view">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" contenteditable="true">Action</button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" contenteditable="true">
                                    <a class="dropdown-item disabled" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Styles <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="" rel="nav-tabs">Default</a>
				<a href="#" class="dropdown-item" class="" rel="nav-pills">Pills</a>
			</div>
</span>
		<a class="btn btn-sm btn-secondary" href="#" rel="flex-column">Vertical</a>
	</span>
                        <div class="preview">Navs</div>
                        <div class="view">
                            <ul class="nav" contenteditable="true">
                                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                                <li class="nav-item"><a class="nav-link disabled" href="#">Messages</a></li>
                                <li class="nav-item dropdown ml-md-auto">
                                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Dropdown link
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview">Breadcrumb</div>
                        <div class="view">

                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a contenteditable="true" href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a contenteditable="true" href="#">Library</a></li>
                                    <li class="breadcrumb-item active" contenteditable="true" aria-current="page">Data</li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Size <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="" rel="pagination-lg">Large</a>
				<a href="#" class="dropdown-item" class="active" rel="">Medium</a>
				<a href="#" class="dropdown-item" class="" rel="pagination-sm">Small</a>
			</div>
</span>

			</span>
                        <div class="preview">Pagination</div>
                        <div class="view">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination" contenteditable="true">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- In bootstrap 4 labels are replaced by badges -->
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Styles <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="" rel="badge-default">Default</a>
				<a href="#" class="dropdown-item" class="" rel="badge-primary">Primary</a>
				<a href="#" class="dropdown-item" class="" rel="badge-success">Success</a>
				<a href="#" class="dropdown-item" class="" rel="badge-info">Info</a>
				<a href="#" class="dropdown-item" class="" rel="badge-warning">Warning</a>
				<a href="#" class="dropdown-item" class="" rel="badge-danger">Danger</a>
			</div>
</span>
	</span>
                        <div class="preview">Label</div>
                        <div class="view">
                            <span class="badge badge-default" contenteditable="true">Label</span>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
	</span>
                        <div class="preview">Badge</div>
                        <div class="view">
                            <ul class="nav nav-pills" contenteditable="true">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-primary" href="#">
                                        Home <span class="badge badge-light">42</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        More <span class="badge badge-secondary">16</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<a class="btn btn-sm btn-default" href="#" rel="card card-block">Well</a>
	</span>
                        <div class="preview">Jumbotron</div>
                        <div class="view">
                            <div class="jumbotron" contenteditable="true">
                                <h2>Hello, world!</h2>
                                <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                                <p><a class="btn btn-primary btn-large" href="#">Learn more</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview">Page Header</div>
                        <div class="view">
                            <div class="page-header">
                                <h1 contenteditable="true">LayoutIt! <small>Interface Builder for Bootstrap</small></h1>
                            </div>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview">Text</div>
                        <div class="view">
                            <h2 contenteditable="true">Heading</h2>
                            <p contenteditable="true">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                            <p><a class="btn" href="#" contenteditable="true">View details &raquo;</a></p>
                        </div>
                    </div>
                    <!-- In Bootstrap 4 thumbnails are replaced by cards -->
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview">Thumbnails</div>
                        <div class="view">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img class="card-img-top" alt="Bootstrap Thumbnail First" src="https://www.layoutit.com/img/people-q-c-600-200-1.jpg">
                                        <div class="card-block" contenteditable="true">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                            <p><a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img class="card-img-top" alt="Bootstrap Thumbnail Second" src="https://www.layoutit.com/img/city-q-c-600-200-1.jpg">
                                        <div class="card-block" contenteditable="true">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                            <p><a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img class="card-img-top" alt="Bootstrap Thumbnail Third" src="https://www.layoutit.com/img/sports-q-c-600-200-1.jpg">
                                        <div class="card-block" contenteditable="true">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                            <p><a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">


		<a data-class="progress-bar" class="btn btn-sm btn-secondary" href="#" rel="progress-bar-striped">Striped</a>
		<a data-class="progress-bar" class="btn btn-sm btn-secondary" href="#" rel="progress-bar-animated">Active</a>
	</span>
                        <div class="preview">Progress Bar</div>
                        <div class="view">
                            <div class="progress">
                                <div class="progress-bar w-75" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
	</span>
                        <div class="preview">Media Object</div>
                        <div class="view">
                            <div class="media">
                                <img class="mr-3" alt="Bootstrap Media Preview" src="https://www.layoutit.com/img/sports-q-c-64-64-8.jpg">
                                <div class="media-body" contenteditable="true">
                                    <h5 class="mt-0">Nested media heading</h5>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                                    <div class="media mt-3">
                                        <a class="pr-3" href="#">
                                            <img alt="Bootstrap Media Another Preview" src="https://www.layoutit.com/img/sports-q-c-64-64-2.jpg">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="mt-0">Nested media heading</h5>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
	</span>
                        <div class="preview">List group</div>
                        <div class="view">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action active">Home</a>
                                <div class="list-group-item">List header</div>
                                <div class="list-group-item">
                                    <h4 class="list-group-item-heading">List group item heading</h4>
                                    <p class="list-group-item-text">...</p>
                                </div>
                                <div class="list-group-item justify-content-between">
                                    Help <span class="badge badge-secondary badge-pill">14</span></div>
                                <a href="#" class="list-group-item list-group-item-action active justify-content-between">	Home <span class="badge badge-light badge-pill">14</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- In bootstrap 4 panels are replaced by cords -->
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Styles <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="" rel="bg-default">Default</a>
				<a href="#" class="dropdown-item" class="" rel="text-white bg-primary">Primary</a>
				<a href="#" class="dropdown-item" class="" rel="text-white bg-success">Success</a>
				<a href="#" class="dropdown-item" class="" rel="text-white bg-info">Info</a>
				<a href="#" class="dropdown-item" class="" rel="text-white bg-warning">Warning</a>
				<a href="#" class="dropdown-item" class="" rel="text-white bg-danger">Danger</a>
			</div>
</span>

	</span>
                        <div class="preview">Cards</div>
                        <div class="view">
                            <div class="card">
                                <h5 class="card-header" contenteditable="true">Card title</h5>
                                <div class="card-body" contenteditable="true">
                                    <p class="card-text">Card content</p>
                                </div>
                                <div class="card-footer" contenteditable="true">
                                    Card footer
                                </div>
                            </div>
                        </div>
                    </div>

                </li>
            </ul>

            <ul class="nav nav-list flex-column accordion-group latest-group-sidebar">
                <li class="nav-item nav-header"><i class="fas fa-plus"></i> JavaScript
                    <div class="float-right popover-info"><i class="fas fa-question-circle"></i>
                        <div class="popover fade right"><div class="arrow"></div>
                            <h3 class="popover-title">Help</h3>
                            <div class="popover-content">Drag &amp; Drop the elements inside the columns where you want to insert it. And from there, you can configure the style of that javascript. If you need more info please visit  <a target="_blank" href="http://getbootstrap.com/javascript">JavaScript.</a></div></div>
                    </div>
                </li>
                <li class="boxes mute" id="elmJS" >
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview">Modal</div>
                        <div class="view">
                            <!-- Button to trigger modal -->
                            <a id="myModalLink" href="#myModalContainer" role="button" class="btn" data-toggle="modal">Launch demo modal</a>

                            <!-- Modal -->
                            <div class="modal fade" id="myModalContainer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel" contenteditable="true">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body" contenteditable="true">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" contenteditable="true">Save changes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" contenteditable="true">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
  <span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Position <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="active" rel="">Default</a>
				<a href="#" class="dropdown-item" class="" rel="static-top">Static top</a>
				<a href="#" class="dropdown-item" class="" rel="fixed-top">Navbar fixed top</a>
				<a href="#" class="dropdown-item" class="" rel="fixed-bottom">Navbar fixed bottom</a>
			</div>
</span>
		<a class="btn btn-sm btn-secondary" href="#" rel="navbar-dark bg-dark">Navbar Dark</a>
                            <!--a class="btn btn-xs btn-default" href="#" rel="navbar-static-top">Static top</a>
                            <a class="btn btn-mini" href="#" rel="navbar-fixed-top">Navbar fixed top</a>
                            <a class="btn btn-mini" href="#" rel="navbar-fixed-bottom">Navbar fixed bottom</a-->
	</span>
                        <div class="preview">Navbar</div>
                        <div class="view">
                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <a class="navbar-brand" href="#">Brand</a>
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="navbar-nav">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="#">Link <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Dropdown link
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </li>
                                    </ul>
                                    <form class="form-inline">
                                        <input class="form-control mr-sm-2" type="text" placeholder="Search">
                                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                                    </form>
                                    <ul class="navbar-nav ml-md-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="#">Link <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Dropdown link
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
	</span>
                        <div class="preview">Tabs</div>
                        <div class="view">
                            <div class="tabbable" id="myTabs"> <!-- Only required for left/right tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link active" href="#tab1" data-toggle="tab" contenteditable="true">Section 1</a></li>
                                    <li class="nav-item"><a class="nav-link"href="#tab2" data-toggle="tab" contenteditable="true">Section 2</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                        <p contenteditable="true">I'm in Section 1.</p>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <p contenteditable="true">Howdy, I'm in Section 2.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <span class="configuration">
		<span class="btn-group btn-group-sm">
	<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Styles <span class="caret"></span></a>
	<div class="dropdown-menu">
				<a href="#" class="dropdown-item" class="" rel="alert-success">Success</a>
				<a href="#" class="dropdown-item" class="" rel="alert-info">Info</a>
				<a href="#" class="dropdown-item" class="" rel="alert-warning">Warning</a>
				<a href="#" class="dropdown-item" class="" rel="alert-danger">Danger</a>
			</div>
</span>

	</span>
                        <div class="preview">Alerts</div>
                        <div class="view">
                            <div class="alert alert-success alert-dismissable" contenteditable="true">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>Alert!</h4>
                                <strong>Warning!</strong> Best check yo self, you're not looking too good. <a href="#" class="alert-link">alert link</a>
                            </div>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview">Collapse</div>
                        <div class="view">
                            <div id="accordionV4">
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link" data-toggle="collapse" data-parent="#accordionV4" href="#collapseOne">
                                            Collapsible Group Item #1
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse show">
                                        <div class="card-body">
                                            Anim pariatur cliche...
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordionV4" href="#collapseTwo">
                                            Collapsible Group Item #2
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse">
                                        <div class="card-body">
                                            Anim pariatur cliche...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-element">
                        <a href="#close" class="remove badge badge-danger"><i class="fas fa-times"></i> Удалить</a>
                        <span class="drag badge badge-default"><i class="fas fa-arrows-alt"></i> drag</span>
                        <div class="preview">Carousel</div>
                        <div class="view">


                            <div class="carousel slide" id="myCarousel" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-slide-to="0" data-target="#myCarousel" class="active"></li>
                                    <li data-slide-to="1" data-target="#myCarousel" class=""></li>
                                    <li data-slide-to="2" data-target="#myCarousel" class=""></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" alt="Carousel Bootstrap First" src="https://www.layoutit.com/img/sports-q-c-1600-500-1.jpg">
                                        <div class="carousel-caption">
                                            <h4>First Thumbnail label</h4>
                                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" alt="Carousel Bootstrap Second" src="https://www.layoutit.com/img/sports-q-c-1600-500-2.jpg">
                                        <div class="carousel-caption">
                                            <h4>Second Thumbnail label</h4>
                                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" alt="Carousel Bootstrap Third" src="https://www.layoutit.com/img/sports-q-c-1600-500-3.jpg">
                                        <div class="carousel-caption">
                                            <h4>Third Thumbnail label</h4>
                                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                        </div>
                                    </div>
                                </div>

                                <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div id="download-layout"><div class="container-fluid"></div></div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
    <button id="sidebar-mobile"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"><polygon points="512 120.9 391.1 0 256 135.1 120.9 0 0 120.9 135.1 256 0 391.1 120.9 512 256 376.9 391.1 512 512 391.1 376.9 256 "></polygon></svg></button>
</div>

<script>
    function saveLayout(){
        $.ajax({
            type: "POST",
            url: "/build_v4/saveLayout",
            data: { 'layout-v4': $('.demo').html() },
            success: function(data) {

            }
        });
    }

    function downloadLayout(){
        $.ajax({
            type: "POST",
            url: "/build_v4/downloadLayout",
            data: { 'layout-v4': $('#download-layout').html() },
            success: function(data) { window.location.href = '/build_v4/download'; }
        });
    }

    function downloadHtmlLayout(){
        $.ajax({
            type: "POST",
            url: "/build_v4/downloadLayout",
            data: { 'layout-v4': $('#download-layout').html() },
            success: function(data) { window.location.href = '/build_v4/downloadHtml'; }
        });
    }

    function undoLayout() {

        $.ajax({
            type: "POST",
            url: "/build_v4/getPreviousLayout",
            data: { },
            success: function(data) {
                undoOperation(data);
            }
        });
    }

    function redoLayout() {

        $.ajax({
            type: "POST",
            url: "/build_v4/getPreviousLayout",
            data: { },
            success: function(data) {
                redoOperation(data);
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        // Mobile sidebar
        $('#sidebar-mobile').on('click', function() { $(this).toggleClass('active'); $('.sidebar-nav').toggleClass('active'); });



    });

    function settings() {
//        icms.modal.openAjax('/admin/widgets/edit/258', {template:'modern', is_iframe: true});
        icms.modal.openAjax('/admin/widgets/edit/258', {template:'admincoreui', is_iframe: true}, function (){
            icms.modal.setCallback('close', function(){
                icms.forms.form_changed = false;
            });

        });
    };
</script>

<div class="modal fade" id="layoutitModal" tabindex="-1" role="dialog" aria-labelledby="layoutitModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>


<div style="display: none"
     id="cp-widgets-layout" data-scheme-row-reorder-url="/admin/reorder/layout_rows" data-scheme-col-reorder-url="/admin/reorder/layout_cols" data-scheme-row-add-url="/admin/widgets/row_add/scmobileapp" data-template="modern" data-toggle-url="/admin/widgets/toggle" data-tree-url="/admin/widgets/tree_ajax" data-load-url="/admin/widgets/load" data-add-url="/admin/widgets/add" data-edit-url="/admin/widgets/edit" data-delete-url="/admin/widgets/delete" data-remove-url="/admin/widgets/remove" data-copy-url="/admin/widgets/copy" data-files-url="/admin/package_files_list/widgets" data-edit-page-url="/admin/widgets/page_edit" data-delete-page-url="/admin/widgets/page_delete" data-reorder-url="/admin/widgets/reorder"></div>
</body>


<style>
    .widgetcontent .edit_wlinks{
        display: none;
    }

    .edit_wlinks{
        top: 35px !important;
        position: absolute;
        right: 125px;
        opacity: 0.2;
    }
    .edit_wlinks:hover{
        opacity: 1;
    }
    .builder.edit .demo .column .box .drag, .builder.edit .demo .remove,.builder.edit .demo .lyrow .drag {
        top: 35px !important;
    }

</style>
</html>

