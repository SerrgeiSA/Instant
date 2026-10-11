<?php

// PhotoSwipe
$this->addCSS('templates/'.$this->name.'/assets/fields/gmimagesgrid/PhotoSwipe/photoswipe.css');
$this->addCSS('templates/'.$this->name.'/assets/fields/gmimagesgrid/PhotoSwipe/default-skin/default-skin.css');
$this->addJS('templates/'.$this->name.'/assets/fields/gmimagesgrid/PhotoSwipe/photoswipe.min.js');
$this->addJS('templates/'.$this->name.'/assets/fields/gmimagesgrid/PhotoSwipe/photoswipe-ui-default.min.js');

// neoimages
$this->addJS('templates/'.$this->name.'/assets/fields/gmimagesgrid/thumbsEdit.js');
$this->addJS('templates/'.$this->name.'/assets/fields/gmimagesgrid/field_imagesgrid.js');
$this->addCSS('templates/'.$this->name.'/assets/fields/gmimagesgrid/field_imagesgrid.css');

?>
<div
    id="<?php echo $uniqueKey; ?>"
    class="neoimages-images"
    style="height: <?php echo $container_height; ?>px;max-width: <?php echo $container_width; ?>px;min-width: <?php echo $container_min_width; ?>px;"
    data-margin="<?php echo $margin; ?>"
>

    <?php 
	
	foreach ($thumbs as $key => $thumb) {
        $class = "neoimages-image";
        $style = "";
        $thumb_href = html_image_src($thumb, "src", true);
        $full_href = html_image_src($thumb[$full_preset], "src", true);
        $thumb_size = $thumb['width'] . "x" . $thumb['height'];
        $full_size = $thumb[$full_preset]['width'] . "x" . $thumb[$full_preset]['height'];

        if (!$full_href) {
            $full_href = $thumb_href;
            $full_size = $thumb_size;
        }

        $styles = array(
            "margin" => "0 " . $margin . "px " . $margin . "px 0",
            "width" => $thumb['width'] . "px",
            "height" => $thumb['height'] . "px",
            "background-image" => "url(" . $thumb_href . ")"
        );

        if (count($thumbs) === 1) {
            $class .= " neoimages-image-single";
        }

        if ($thumb['lastRow']) {
            $class .= " neoimages-image-last-row";
        }

        if ($thumb['lastColumn']) {
            $class .= " neoimages-image-last-column";
        }

        foreach ($styles as $key => $value) {
            $style .= $key . ":" . $value . ";";
        }
    ?>
        <?php if ($clickable_photos) { ?>
            <a
                href="<?php echo $full_href; ?>"
                class="<?php echo $class; ?>"
                style="<?php echo $style; ?>"
                onclick="return icms.neoimages.photoShow(this, event);"
                data-thumb-size="<?php echo $thumb_size; ?>"
                data-thumb-src="<?php echo $thumb_href; ?>"
                data-size="<?php echo $full_size; ?>"
                data-src="<?php echo $full_href; ?>"
            ></a>
        <?php } else { ?>
            <div
                class="<?php echo $class; ?> neoimages-no-clickable"
                style="<?php echo $style; ?>"
                data-thumb-size="<?php echo $thumb_size; ?>"
                data-thumb-src="<?php echo $thumb_href; ?>"
                data-size="<?php echo $full_size; ?>"
                data-src="<?php echo $full_href; ?>"
            ></div>
        <?php } ?>
    <?php } ?>

</div>
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<script type="text/x-template" id="neoimages-pswp-root-<?php echo $uniqueKey; ?>">
    <div class="pswp neoimages-pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe. 
            It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides. 
                PhotoSwipe keeps only 3 of them in the DOM to save memory.
                Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                    <button class="pswp__button pswp__button--share" title="Share"></button>

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div> 
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>

        </div>

    </div>
</script>
<script>
    icms.neoimages.init("<?php echo $uniqueKey; ?>");
</script>