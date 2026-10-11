    <?php if($ctype['options']['cover_preset']){ ?>
        <div class="row mb-n3">
            <?php foreach($cats as $c){ ?>
                <div class="col-md-4 col-sm-6 mb-3 mb-md-4 <?php echo $c['list_params']['class']; ?>">
                    <div class="card border-0 bg-light">
                        <?php if($c['list_params']['cover_img']){ ?>
                            <a class="d-block overflow-hidden rounded-lg" href="<?php echo $c['list_params']['href']; ?>">
                                <img class="d-block w-100" src="<?php echo $c['list_params']['cover_img']; ?>" alt="<?php html($c['title']); ?>">
                            </a>
                        <?php } ?>
                        <div class="card-body">
                            <h2 class="h5 m-0">
                                <a href="<?php echo $c['list_params']['href']; ?>">
                                    <?php echo $c['title']; ?>
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <ul class="list-inline icms-content-subcats">
            <?php foreach($cats as $c){ ?>
                <li class="list-inline-item h4 text-warning mr-3 <?php echo $c['list_params']['class']; ?>">
                    <?php html_svg_icon('solid', 'folder'); ?>
                    <a href="<?php echo $c['list_params']['href']; ?>">
                        <?php echo $c['title']; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>