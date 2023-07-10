<section class="containerMovies containerResultMovies marginTopSmall">
    <div class="wrap w90 center">
        <div class="itemsFilter">
            <ul class="listMovies itemsFlex flexWrap">
            <?php
                if(isset($_GET['delete'])){
                    \controllers\usersController::deleteActivityList($_GET['id']);
                }
                $getActivityList = \models\usersModel::getActivityList();
                foreach($getActivityList as $key => $value){
            ?>
                <li class="positionRelative">
                    <a href="?delete&id=<?php echo @$value['MovieID']; ?>" class="iconButton"><i class="ri-close-fill"></i></a>
                    <a href="<?php echo BASE ?>movie/<?php echo $value['MovieID']; ?>" class="box itemsFlex alignCenter justCenter w100 h100">
                        <div class="col w100">
                            <figure class="imgDefaultMovie">
                                <img src="<?php echo BASE_IMAGES_MOVIES . $value['Image']; ?>" />
                            </figure>
                            <div class="row textCenter">
                                <h4 class="marginDownSmallIn limitLineClampOne"><?php echo $value['Nome'] ?></h4>
                            </div>
                        </div>
                    </a>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</section>