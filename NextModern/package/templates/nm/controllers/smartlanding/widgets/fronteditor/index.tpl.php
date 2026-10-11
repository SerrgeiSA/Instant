<link rel="stylesheet" type="text/css" href="/templates/admincoreui/controllers/admin/styles.css">
<?php $this->addControllerJS('fronteditor', 'smartlanding');
$this->addTplJSName('jquery-ui');
$this->addTplCSSName('jquery-ui');
?>
<script>
    var positionName = ".positions";
</script>

<div class="col-sm-auto quickview-wrapper" id="left-quickview" style="
position: fixed;
left: 10px;
top: 20px;
background: black;
border: 1px black;
padding: 1px;
z-index: 9999;
max-height: 900px;
overflow-y: auto;
">
    <a class="quickview-toggle close" data-toggle="quickview" data-toggle-element="#left-quickview" href="#"><span
                aria-hidden="true">×</span></a>
    <div class="card-body h-100 pt-3 no-overflow"  style="background: white;">
       <div class="dragdiv" style="padding: 10px; color:black;">Перенести</div>
        <ul class="nav nav-tabs">
        </ul>
        <div class="tab-content border-right-0 border-bottom-0 border-left-0">
            <div class="tab-pane p-0 pt-2 show active" id="all-widgets" role="tabpanel">
                <div id="cp-widgets-list" class="mt-3">
                    <div class="form-group">
                        <select class="form-control" id="pages" name="page">
                            <?php print_r($matched_pages);
                            foreach ($matched_pages as $key => $page) {
                                $name = $page['title'] != '' ? $page['title'] : $page['title_const'];
                                if ($key == 0) {
                                    $name = "Все страницы";
                                } else if ($key == 1) {
                                    $name = "Главная страница";
                                } else {
                                    $name = $page['title'] != '' ? $page['title'] : $page['title_const'];
                                    $name = !empty($page['title']) ?
                                        $page['title'] :
                                        sprintf(constant($page['title_const']), $page['title_subject']);
                                }
                                ?>
                                <option <?php echo $page['selected']; ?> value="<?php echo $key; ?>"><?php echo $name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <?php if ($widgets_list) { ?>
                    <div id="accordion">
                        <?php foreach ($widgets_list as $controller_name => $widgets) { ?>
                            <div class="section">
                                <?php $controller_title = $controller_name ? constant("LANG_" . mb_strtoupper($controller_name) . "_CONTROLLER") : LANG_CP_WIDGETS_MISC; ?>

                                <a class="btn btn-primary btn-block mb-1 text-left rounded-0" href="#"
                                   rel="<?php echo $controller_name; ?>" data-toggle="collapse"
                                   data-target="#w-<?php echo $controller_name; ?>">
                                    <?php echo $controller_title; ?>
                                </a>
                                <ul class="mt-3 px-2 list-unstyled collapse <?php echo !$controller_name ? 'show' : ''; ?>"
                                    id="w-<?php echo $controller_name; ?>" data-parent="#accordion">
                                    <?php foreach ($widgets as $w) { ?>
                                        <li rel="new" data-id="<?php echo $w['id']; ?>">
                                            <div id="widget_wrapper_<?php echo $w['id']; ?>" class="dragwidget icms-widget" data-id="<?php echo $w['id']; ?>">
                                                <div class="widgetcontent"><span
                                                            class="title"><?php echo $w['title']; ?></span></div>
                                            </div>
                                            <?php if ($w['is_external']) { ?>
                                                <span class="actions float-md-right d-flex">
                                                            <a class="delete" href="#"
                                                               title="<?php echo LANG_DELETE; ?>">
                                                                <i class="icon-close icons font-xl d-block"></i>
                                                            </a>
                                                        </span>
                                            <?php } ?>
                                            <?php if ($w['image_hint_path']) { ?>
                                                <img src="<?php echo $w['image_hint_path']; ?>">
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>

                            </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dragwidget, .dragdiv {
        cursor: move;
    }
    #accordion li {
        padding: 10px;

    }
    .ui-draggable-dragging{
        visibility: visible !important;
    }
</style>



