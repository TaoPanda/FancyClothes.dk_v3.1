<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Forside | FancyClothes.dk</title>
    <meta name="description" content="Velkommen til FancyClothes.dk">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Karla|Lato|Oswald" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/slider.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <?php
      require_once 'includes/connect.php';
      $statement = $dbh->prepare('SELECT products.overskrift, products.imgPath, products.imgAlt, products.uploadDate, products.infotext, products.starAmount, products.kategori, users.username FROM products LEFT JOIN users ON products.userid=users.id');
      $statement->execute();
    ?>
    <div class="top container">
        <div class="language">
            <div class="flag">
                <img src="img/ikon.png" alt="Dansk ikon">
                <span>Dansk</span>
            </div>
            <span>DKK</span>
        </div>
        <div class="search">
            <input type="text" placeholder="Indtast søgning"><input type="submit" value="Søg">
        </div>
    </div>
    <hr>
    <div class="container home">
        <a href="index.php"><img src="img/homeIcon.png" alt="Forside ikon"></a>
        <!-- Velkomstbesked -->
        <?php
            if(isset($_SESSION["username"])){
                echo "<h2>Velkommen: " . $_SESSION["username"] . "<h2>";
            }
        ?>
    </div>
    <hr>
    <div class="container navbar">
        <nav>
            <ul>
                <li class="active"><a href="./index.php">Forside</a></li>
                <li><a href="#">Produkter</a></li>
                <li><a href="#">Nyheder</a></li>
                <li><a href="#">Handelsbetingelser</a></li>
                <li><a href="#">Om os</a></li>
                <?php
                if(isset($_SESSION["username"])){
                ?>
                    <li><a href="includes/logout.php">Log ud</a></li>
                <?php
                }else{
                ?>
                    <li><a href='#' class='loginBtn'>Log ind</a></li>
                    <li><a href='register.php' class='loginBtn'>Opret bruger</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
        <div class="basket">
            <div class="basketContent">
                <p>Din indkøbskurv er tom</p>
            </div>
            <div class="shopIcon">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <div class="login container">
        <form action="includes/login.php" method="POST">
            <label for="formUsername">Bruger:</label>
            <input type="text" id="formUsername" name="formUsername" placeholder="Brugernavn" required>
            <label for="formPassword">Password:</label>
            <input type="password" id="formPassword" name="formPassword" placeholder="Password" required>
            <input type="submit" value="Log ind">
        </form>
        <a id="newUser" href="register.php">Ny bruger?</a>
    </div>
    <?php
    if(isset($_SESSION["loginFail"])){
        echo '<h4 class="container" style="color:red">' . $_SESSION["loginFail"] . "<h4>";
    }
    ?>
    <hr>
    <div class="container">
        <ul class="slider" id="slider">
            <li><img src="img/slide1.jpg" alt=""></li>
            <li><img src="img/slide2.jpg" alt=""></li>
            <li><img src="img/slide3.jpg" alt=""></li>
        </ul>
    </div>
    <hr class="hide400">
    <h1 class="tagline">FancyClothes.DK - tøj, kvalitet, simpelt!</h1>
    <hr>
    <?php
    if(isset($_SESSION["username"])){
    ?>
        <div class="createArticle container">

            <h3 class="center errorMsg">Opret ny vare:</h3>
            <form action="includes/insertArticle.php" method="post">
                <div>
                    <label for="imgSrc">Billede</label>
                    <input type="text" id="imgSrc" name="imgSrc" placeholder="Vælg billede" required>
                </div>
                <div>
                    <label for="imgAlt">Alt tekst</label>
                    <input type="text" id="imgAlt" name="imgAlt" placeholder="Billedets alttekst..." required>
                </div>
                <div>
                    <label for="heading">Overskrift</label>
                    <input type="text" id="heading" name="heading" placeholder="Overskrift..." required>
                </div>
                <div>
                    <label for="content">Brødtekst</label>
                    <textarea name="content" id="content" cols="30" rows="10" placeholder="Brødtekst..."></textarea>
                </div>
                <div>
                    <label for="stars">Antal stjerner</label>
                    <select name="stars" id="stars">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div>
                    <label for="category">Kategori</label>
                    <select name="category" id="category" required>
                        <option value="jakker">Jakker</option>
                        <option value="bukser">Bukser</option>
                        <option value="skjorter">Skjorter</option>
                        <option value="strik">Strik</option>
                        <option value="tshirts">T-shirts og tanktops</option>
                        <option value="tasker">Tasker</option>
                    </select>
                </div>
                <div>
                    <input type="submit" value="Opret" name="value">
                </div>
            </form>

        </div>
    <?php
    }
    ?>
    </div>
    <main class="container">
        <aside>
            <div class="categories">
                <div class="catTop">
                    <h4>Kategorier:</h4>
                </div>
                <div class="catMain">
                    <ul>
                        <li><a href="#">Jakker</a></li>
                        <li><a href="#">Bukser</a></li>
                        <li><a href="#">Skjorter</a></li>
                        <li><a href="#">Strik</a></li>
                        <li><a href="#">T-shirts & Tank tops</a></li>
                        <li><a href="#">Tasker</a></li>
                    </ul>
                </div>
            </div>

            <div class="newsletter">
                <div class="newsTop">
                    <h4>Tilmeld nyhedsbrev</h4>
                </div>
                <div class="newsMain">
                    <form action="">
                        <input type="text" placeholder="Navn">
                        <input type="email" placeholder="Email">
                </div>
                <div class="newsBottom">
                    <input type="submit" value="Tilmeld">
                    </form>
                </div>
            </div>
        </aside>
        <div class="products">
            <h3>INSPIRATION</h3>
            <hr>
            <div class="inspiration">
                <div class="catMen">
                    <img src="img/kategoriHerre.jpg" alt="">
                    <h5>Herretøj</h5>
                    <div class="action">Lær mere</div>
                </div>
                <div class="catWomen">
                    <img src="img/kategoriKvinde.jpg" alt="">
                    <h5>Kvindetøj</h5>
                    <div class="action">Lær mere</div>
                </div>
            </div>
            <div class="frontProducts">
                <?php
                while($row = $statement->fetch()){
                    echo "<article>";
                    echo "<img src='./img/" . $row["imgPath"] . "' alt='" . $row["imgAlt"] . "'>";
                    echo '<div class="info">';
                    echo "<h3>" . $row["overskrift"] . "</h3>";
                    echo '<div class="stars">';
                    for($x = 1; $x <= 5; $x++) {
                        if($x <= $row["starAmount"]){
                            echo "<i class='fa fa-star' aria-hidden='true'></i>";
                        }else{
                            echo " <i class='fa fa-star-o' aria-hidden='true'></i>";
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                    echo '<div class="description">';
                    echo '<div class="published">' . 'Oprettet: ' . $row['uploadDate'] . ' af ' . $row['username'] . '</div>';
                    echo '<p>' . $row["infotext"] . '<a href="#">Læs mere...</a></p>';
                    echo "</div>";
                    echo "</article>";
                }
                ?>
                <article>
                    <img src="img/produkt1.jpg" alt="Lækker læderjakke>">
                    <div class="info">
                        <h3>Lækker læderjakke</h3>
                        <div class="stars">
                            <i class='fa fa-star' aria-hidden='true'></i>
                            <i class='fa fa-star' aria-hidden='true'></i>
                            <i class='fa fa-star' aria-hidden='true'></i>
                            <i class='fa fa-star-o' aria-hidden='true'></i>
                            <i class='fa fa-star-o' aria-hidden='true'></i>
                        </div>
                    </div>
                    <div class="description">
                        <div class="published">
                            Oprettet: Mandag d. 24/6-2019 af Mark
                        </div>
                        <p>Odd Molly er et svensk luksusbrand stiftet af Per Holknekt – tidligere pro skateboarder. Verdenseliten tiltrak dengang mange kvindelige fans, og de fleste af dem gjorde, hvad de kunne for at få fyrenes opmærksomhed. Alle undtagen én. Hun forblev tro mod sig selv - en unik, selvsikker og uforanderlig skønhed - hende, alle fyrene ville ha'. En Odd Molly! - som ikke er et koncept, men autentisk! – et brand, hvis kollektioner er vildt smukke og inderlige, som der altid vil være brug for - dengang, nu, såvel som i fremtiden.
                            <a href="#">Læs mere...</a></p>
                        <!-- Mulighed for sletning herunder -->
                    </div>
                </article>
                <article>
                    <img src="img/produkt1.jpg" alt="Lækker læderjakke>">
                    <div class="info">
                        <h3>Lækker læderjakke</h3>
                        <div class="stars">
                            <i class='fa fa-star' aria-hidden='true'></i>
                            <i class='fa fa-star' aria-hidden='true'></i>
                            <i class='fa fa-star' aria-hidden='true'></i>
                            <i class='fa fa-star-o' aria-hidden='true'></i>
                            <i class='fa fa-star-o' aria-hidden='true'></i>
                        </div>
                    </div>
                    <div class="description">
                        <div class="published">
                            Oprettet: Mandag d. 24/6-2019 af Mark
                        </div>
                        <p>Odd Molly er et svensk luksusbrand stiftet af Per Holknekt – tidligere pro skateboarder. Verdenseliten tiltrak dengang mange kvindelige fans, og de fleste af dem gjorde, hvad de kunne for at få fyrenes opmærksomhed. Alle undtagen én. Hun forblev tro mod sig selv - en unik, selvsikker og uforanderlig skønhed - hende, alle fyrene ville ha'. En Odd Molly! - som ikke er et koncept, men autentisk! – et brand, hvis kollektioner er vildt smukke og inderlige, som der altid vil være brug for - dengang, nu, såvel som i fremtiden.
                            <a href="#">Læs mere...</a></p>
                        <!-- Mulighed for sletning herunder -->
                    </div>
                </article>
            </div>
        </div>
    </main>
    <hr>
    <footer>
        <div class="contact container">
            <ul>
                <li class="bold">FancyClothes.dk</li>
                <li>Skrædderstien 7</li>
                <li>4321 Fredensvang</li>
                <li>E-mail: info@fancyness@gmail.com</li>
                <li>Sitemap</li>
            </ul>
            <div class="social">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                <i class="fa fa-twitter-square" aria-hidden="true"></i>
                <i class="fa fa-youtube-square" aria-hidden="true"></i>
            </div>
        </div>
    </footer>

    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->

    <!-- Add your site or application content here -->


    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')
    </script>
    <script src="js/plugins.js"></script>
    <script src="js/slider.min.js"></script>
    <script src="js/myScript.js"></script>
    <script>
        $(window).on("load", function() {
            $("#slider").slider();
        });
    </script>
</body>

</html>
