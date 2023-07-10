<!DOCTYPE html>
<html>
    <head>
        <title>Rorschach</title>
        <meta charset="utf-8" />
        <link href="<?php echo BASE; ?>css/global.css" rel="stylesheet"/>
        <link href="<?php echo BASE; ?>css/style.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="palavras-chave,do,meu,site">
        <meta name="description" content="Descrição do meu website">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    </head>
    <body>
    <?php
        $id = $_SESSION['id'];
        include('C:\xampp\htdocs\Rorschach\views\connectdb.php');
        // Validação
        $sql = "SELECT * FROM Utilizador"; 
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        $sql2 = "SELECT * FROM Pile WHERE UserID='$id'";
        $result2 = $conn->query($sql2);

        $sql3 = "SELECT * FROM Activity WHERE UserID='$id'";
        $result3 = $conn->query($sql3);

        $sql4 = "SELECT * FROM Shelf WHERE UserID='$id'";
        $result4 = $conn->query($sql4);
        \controllers\usersController::logout(); 
        if($slug !== 'login' && $slug !== 'register'){
    ?>
    <aside class="aside displayInlineFlexColumn hideDeviceSmall">
        <div class="wrap itemsFlex flexWrap">
            <div class="logo marginDownSmall w100">
                <h1 class="titleStrong">Rorschach<span style="color:var(--myRad);">.</span></h1>
            </div>
            <div class="row marginDownSmall">
                <h6 class="marginDownSmallIn" style="color:var(--myBlue3);">Menu</h6>
                <ul class="menu">
                    <li><a href="<?php echo BASE; ?>"><i class="ri-compasses-2-line marginRightSmall" style="color:var(--myBlue1);"></i> <h6>Home</h6></a></li>
                    <?php if($_SESSION['type'] === 'admin' || $_SESSION['type'] === 'user'){ ?>
                        <?php if($result2->num_rows > 0) {?>
                            <li><a href="<?php echo BASE; ?>Pile"><i class="ri-contrast-drop-2-line marginRightSmall" style="color:var(--myBlue1);"></i> <h6>A Pilha</h6></a></li>
                        <?php }?>
                        <?php if($result3->num_rows > 0) {?>
                            <li><a href="<?php echo BASE; ?>Activity"><i class="ri-flashlight-fill marginRightSmall" style="color:var(--myBlue1);"></i> <h6>Atividade</h6></a></li>
                        <?php }?>
                        <?php if($result4->num_rows > 0) {?>
                            <li><a href="<?php echo BASE; ?>Shelf"><i class="ri-book-open-line marginRightSmall" style="color:var(--myBlue1);"></i> <h6>A Estante</h6></a></li>
                        <?php }?>
                    <?php }?>
                    <li><a href="<?php echo BASE; ?>movies"><i class="ri-airplay-line marginRightSmall" style="color:var(--myBlue1);"></i> <h6>Filmes</h6></a></li>
                    <li><a href="<?php echo BASE; ?>series"><i class="ri-tv-line marginRightSmall" style="color:var(--myBlue1);"></i> <h6>Séries</h6></a></li>
                </ul>
            </div>
            <div class="row marginDownSmall w100">
                <ul class="menu">
                    <?php if($_SESSION['type'] === 'admin'){ ?>
                        <h6 class="marginDownSmallIn" style="color:var(--myBlue3);">Social</h6>
                        <li><a href="<?php echo BASE; ?>profileUser"><i class="ri-user-3-line marginRightSmall" style="color:var(--myBlue1);"></i> <h6>Perfil</h6></a></li>
                        <li><a href="<?php echo BASE; ?>users"><i class="ri-group-line marginRightSmall" style="color:var(--myBlue1);"></i> <h6>Utilizadores</h6></a></li>
                        <?php if($_SESSION['id'] === '1'){ ?>
                            <li><a href="<?php echo BASE; ?>admins"><i class="ri-shield-user-line marginRightSmall" style="color:var(--myBlue1);"></i><h6>Administradores</h6></a></li>
                        <?php } ?>
                    <?php }else if($_SESSION['type'] === 'user'){ ?>
                        <h6 class="marginDownSmallIn" style="color:var(--myBlue3);">Social</h6>
                        <li><a href="<?php echo BASE; ?>profileUser"><i class="ri-user-3-line marginRightSmall" style="color:var(--myBlue1);"></i> <h6>Perfil</h6></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="row marginDownDefault w100">
            <h6 class="marginDownSmallIn" style="color:var(--myBlue3);">Geral</h6>
                <ul class="menu">
                    <?php if(isset($_SESSION['login'])){ ?>
                    <li><a href="?logout"><i class="ri-logout-box-r-line marginRightSmall" style="color:var(--myBlue1);"></i> <h6>Logout</h6></a></li>
                    <?php }else{ ?>
                    <li><a href="<?php echo BASE; ?>login"><i class="ri-logout-box-r-line marginRightSmall" style="color:var(--myBlue1);"></i> <h6>Login</h6></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    </aside>

    <main class="w75 h100 displayInlineFlexColumn w100DeviceSmall">

    <header class="marginDownDefault">
        <div class="wrap w95 center itemsFlex justSpaceBetween">
            <div class="col w50 itemsFlex alignCenter" id="colResponsive">
                <form method="post" class="w60 positionRelative itemsFlex alignCenter hideDeviceSmall">
                    <input type="text" name="name" placeholder="Procurar..." class="search w100" autocomplete="off" />
                    <button name="search" class="styleNone"><i class="ri-search-line"></i></button>
                    <div class="searchContainer">
                        <?php
                            if(isset($_POST['search'])){
                                $searchMovie = new \models\moviesModel;
                                $responseSearch = $searchMovie->searchMovie($_POST['name']);
                                foreach($responseSearch->results as $key => $value){
                                    echo '<p class="marginDownSmallIn"><a href="'.BASE.'movie/'.$value->id.'">'.$value->title.'</a></p>';
                                }
                                $searchShow = new \models\tvModel;
                                $response = $searchShow->searchShow($_POST['name']);
                                foreach($response->results as $key => $value){
                                    echo '<p class="marginDownSmallIn"><a href="'.BASE.'show/'.$value->id.'">'.$value->name.'</a></p>';
                                }
                            }
                        ?>
                    </div>
                </form>
                <a class="positionRelative toggleMenu hideDeviceBigger"><i class="ri-menu-line iconBigger"></i></a>
            </div>
            <div class="col itemsMenuHeader w50 itemsFlex alignCenter justEnd w100DeviceSmall">
                <?php if($_SESSION['type'] === 'admin' || $_SESSION['type'] === 'user') { ?>
                    <?php if($result2->num_rows > 0) {?>
                        <a href="<?php echo BASE; ?>Pile" class="marginRightDefault positionRelative"><i class="ri-contrast-drop-2-line"></i><?php if(isset($_SESSION['login'])){ ?><span class="notificationCount"><?php $countPileList = \models\usersModel::getPileList(); echo count($countPileList); ?></span><?php } ?></a>
                        <?php } ?>
                    <?php if($result3->num_rows > 0) {?>
                        <a href="<?php echo BASE; ?>Activity" class="marginRightDefault positionRelative"><i class="ri-flashlight-fill"></i><?php if(isset($_SESSION['login'])){ ?><span class="notificationCount"><?php $countActivityList = \models\usersModel::getActivityList(); echo count($countActivityList); ?></span><?php } ?><a>
                    <?php } ?>
                    <?php if($result4->num_rows > 0) {?>
                        <a href="<?php echo BASE; ?>Shelf" class="marginRightDefault positionRelative"><i class="ri-book-open-line"></i><?php if(isset($_SESSION['login'])){ ?><span class="notificationCount"><?php $countShelfList = \models\usersModel::getShelfList(); echo count($countShelfList); ?></span><?php } ?></a>
                    <?php } ?>
                <?php } ?>
                <?php if($_SESSION['type'] === 'admin' || $_SESSION['type'] === 'user') { ?>
                    <a href="<?php echo BASE; ?>profileUser">
                        <div class="itemsFlex">
                            <figure class="imgSmallUser marginRightSmall">
                                <img src="<?php echo BASE;?>uploads/<?php echo $_SESSION['image']; ?>" class="imgSmallUser" />
                            </figure>
                            <div>
                                <h6 ><?php echo $_SESSION['name']; ?></h6>
                                <p><?php if ($_SESSION['type'] === 'user') {echo "Utilizador";} else if ($_SESSION['type'] === 'admin') {echo "Administrador";}?></p>
                            </div>
                        </div>
                    </a>
                <?php } else {?>
                    <div class="itemsFlex">
                        <figure class="imgSmallUser marginRightSmall">
                            <img src="<?php echo BASE;?>uploads/<?php echo $_SESSION['image']; ?>" class="imgSmallUser" />
                        </figure>
                        <div>
                            <h6><?php echo $_SESSION['name']; ?></h6>
                            <p><?php echo $_SESSION['type']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </header>

<?php $conn->close(); }?>