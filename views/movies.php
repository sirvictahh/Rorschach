<section class="containerFilter">
    <div class="wrap w90 center">
        <form method="get" class="itemsFlex alignCenter">
            <?php 
                if(isset($_POST['filter'])){
                    $api = new \models\moviesModel;
                    $response = $api->getMovieFilter($_GET['infos']);
                }
            ?>
            <select name="infos" class="inputStyle w20 textCenter marginRightSmall w30DeviceSmall">
                <option value="popular">Populares</option>
                <option value="top_rated">Mais Votados</option>
                <option value="upcoming">Próximos</option>
                <option value="now_playing">Agora Disponíveis</option>
            </select>
            <button type="submit" name="filter" class="w20 w30DeviceSmall">Filter</button>
        </form>
    </div>
</section>

<section class="containerMovies containerResultMovies marginTopSmall">
    <div class="wrap w90 center">
        <div class="itemsFilter">
            <ul class="listMovies itemsFlex flexWrap">
            <?php
                $api = new \models\moviesModel;
                @$response = $api->getMovieFilter($_GET['infos']);
                foreach($response->results as $key => $value){
                    if(isset($_POST['addPileList'])){
                        \controllers\usersController::Pile($_SESSION['id'],  $_POST['movie_id'], $_POST['name'], $_POST['image']);
                    }

                    if(isset($_POST['addActivityList'])){
                        \controllers\usersController::Activity($_SESSION['id'],  $_POST['movie_id'], $_POST['name'], $_POST['image']);
                    }

                    if(isset($_POST['addShelfList'])){
                        \controllers\usersController::Shelf($_SESSION['id'],  $_POST['movie_id'], $_POST['name'], $_POST['image']);
                    }
            ?>
                <li class="positionRelative">
                    <form method="post">
                        <?php if($_SESSION['type'] === 'admin' || $_SESSION['type'] === 'user'){ ?>
                            <button type="submit" name="addShelfList" class="iconButton"><i class="ri-book-open-line"></i></button>
                            <button type="submit" name="addActivityList" class="iconButton"><i class="ri-flashlight-fill"></i></button>
                            <button type="submit" name="addPileList" class="iconButton"><i class="ri-contrast-drop-2-line"></i></button>
                        <?php } ?>
                        <a href="<?php echo BASE ?>movie/<?php echo $response->results[$key]->id ?>" class="box itemsFlex alignCenter justCenter w100 h100">
                            <div class="col w100">
                                <figure class="imgDefaultMovie">
                                    <img src="<?php echo BASE_IMAGES_MOVIES . $response->results[$key]->backdrop_path ?>" />
                                </figure>
                                <div class="row textCenter">
                                    <h4 class="marginDownSmallIn limitLineClampOne"><?php echo $response->results[$key]->title ?></h4>
                                    <p><?php echo $response->results[$key]->release_date ?></p>
                                </div>
                            </div>
                        </a>
                        <input type="hidden" name="name" value="<?php echo $value->title ?>" />
                        <input type="hidden" name="movie_id" value="<?php echo $value->id ?>" />
                        <input type="hidden" name="image" value="<?php echo $value->backdrop_path ?>" />
                    </form>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</section>