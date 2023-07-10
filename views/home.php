<section class="bannerMovie marginDownDefault">
    <div class="wrap w90 center">
    <?php
        $movie = new \models\moviesModel;
        $responseMovie = $movie->getMoviesLatest();
    ?>
        <figure class="banner w100 itemsFlex alignEnd" style="background-image:url('<?php echo BASE_IMAGES_MOVIES . $responseMovie->results[1]->backdrop_path ?>');">
            <div class="row w100">
                <div class="marginDownSmall">
                    <h2><?php echo $responseMovie->results[1]->title ?></h2>
                    <h6><?php echo $responseMovie->results[1]->vote_count ?> Votos</h6>
                </div>
                <div class="itemsFlex alignCenter">
                    <a href="<?php echo BASE; ?>movie/<?php echo $responseMovie->results[1]->id ?>" class="button buttonBgRad w15 marginRightSmall w30DeviceSmall">Detalhes</a>
                </div>
            </div>
        </figure>
    </div>
    <?php  ?>
</section>

<section class="containerMovies marginDownSmall">
    <div class="wrap w90 center">
        <div class="title marginDownSmall">
            <h2>Novos filmes</h2>
        </div>
        <div class="slide">
            <ul class="listMovies itemsFlex flexRow">
            <?php
                $api = new \models\moviesModel;
                $response = $api->getMoviesLatest();
                foreach($response->results as $key => $value){
            ?>
                <li class="embla">
                    <a href="<?php echo BASE ?>movie/<?php echo $response->results[$key]->id ?>" class="box itemsFlex alignCenter justCenter w100 h100">
                        <div class="col w70">
                            <figure class="imgSmallMovie marginDownSmallIn">
                                <img src="<?php echo BASE_IMAGES_MOVIES . $response->results[$key]->backdrop_path ?>" />
                            </figure>
                            <h6 class="marginDownSmallIn limitLineClampOne"><?php echo $response->results[$key]->title ?></h6>
                            <p>Nota: <?php echo $response->results[$key]->vote_average ?>/10</p>
                        </div>
                        <div class="col w40 h100 itemsFlex ">
                            <p><?php echo $response->results[$key]->popularity ?> Popularidade</p>
                        </div>
                    </a>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</section>

<section class="containerMovies marginTopSmall">
    <div class="wrap w90 center">
        <div class="title marginDownSmall">
            <h2>Melhores Filmes</h2>
        </div>
        <div class="slide positionRelative itemsFlex alignCenter justSpaceBetween">
            <a class="iconArrow leftAction"><i class="ri-arrow-left-s-line"></i></a>
            <ul class="listMovies itemsFlex flexRow slideUl w100">
            <?php
                $api = new \models\moviesModel;
                $response = $api->getMoviesTopsRateds();
                foreach($response->results as $key => $value){
            ?>
                <li>
                    <a href="<?php echo BASE ?>movie/<?php echo $response->results[$key]->id ?>" class="box itemsFlex alignCenter justCenter w100 h100">
                        <div class="col w100">
                            <figure class="imgDefaultMovie">
                                <img src="<?php echo BASE_IMAGES_MOVIES . $response->results[$key]->backdrop_path ?>" />
                            </figure>
                            <div class="row textCenter">
                                <h4 class="marginDownSmallIn limitLineClampOne"><?php echo $response->results[$key]->title ?></h4>
                                <p><?php
                                    $percent = ($response->results[$key]->vote_average / 10) * 100;
                                    echo "Votação: ".$percent."%";
                                ?></p>
                            </div>
                        </div>
                    </a>
                </li>
            <?php } ?>
            </ul>
            <a class="iconArrow rightAction"><i class="ri-arrow-right-s-line"></i></a>
        </div>
    </div>
</section>

