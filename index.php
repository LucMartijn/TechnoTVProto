<!DOCTYPE html>
<html lang="nl">
<head>
    <title>TechnoTV</title>
    <?php include 'php/Meta.php';?>
    <link href="css/index.css" rel="stylesheet">
    <script src="Script.js" type="text/javascript" defer></script>
    <?php
        session_start();
        $mySQLservername = "localhost";
        $database = "techno_tv_prototype";
        $mySQLusername = "root";
        $mySQLpassword = "";
    
        try {
            $conn = new PDO("mysql:host=$mySQLservername;dbname=$database", $mySQLusername, $mySQLpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        //fetch data functions
        $commandRunner = new DatabaseCommands($conn);
        $sql = "SELECT * FROM nieuwsflash";
        $nieuwsdata = $commandRunner->customFetch($sql, 'fetchAll');
        $_SESSION['nieuwsdata'] = $nieuwsdata;

        $sql = "SELECT * FROM gallery";
        $GalleryData = $commandRunner->customFetch($sql, 'fetchAll');
        $_SESSION['GalleryData'] = $GalleryData;
        
        $sql = "SELECT * FROM Story";
        $StoryData = $commandRunner->customFetch($sql, 'fetchAll');
        $_SESSION['StoryData'] = $StoryData;
        
    ?>
    
</head>
<body id="index-body">
    <?php include 'php/Header.php';?>
<?php
?>
    <main>
<!--TODO add additional templates-->
<!--TODO add styling to templates-->
<!--TODO ask what kind of slides are needed-->
<!--Idea: Slides for daily and weekly activities, like a birthday for daily and a sheet of what got done in a week for weekly-->
        <template id="index-slide-1">
            <section><!--id and classes get added later-->
                <h1 id="template-h1-1" ></h1>
                <article id="template-article-1"></article>
                <img id="template-image-1" src="">
                <img id="template-image-2" src="">
            </section>
        </template>
        
        <template id="index-slide-2">
            <section><!--id and classes get added later-->
                <h1 id="gallery-h1-1"></h1>
                <img class="gallery-img" id="gallery-image-1" src="">
                <img class="gallery-img" id="gallery-image-2" src="">
                <img class="gallery-img" id="gallery-image-3" src="">
                <img class="gallery-img" id="gallery-image-4" src="">
                <img class="gallery-img" id="gallery-image-5" src="">
                <img class="gallery-img" id="gallery-image-6" src="">
                <img class="gallery-img" id="gallery-image-7" src="">
                <img class="gallery-img" id="gallery-image-8" src="">
                <img class="gallery-img" id="gallery-image-9" src="">
                <img class="gallery-img" id="gallery-image-10" src="">
            </section>
        </template>
        <template id="index-slide-3">
            <section class="Story-section"><!--id and classes get added later-->
                <h1 id="Story-h1-1" ></h1>
                <article id="Story-article-1"></article>
                <article id="Story-article-2"></article>
            </section>
        </template>


        <section id="index-section">
            <button onclick="var el = document.getElementById('index-slideshow-frame'); el.requestFullscreen();">
                Go Full Screen!
            </button>

            <section id="index-slideshow-frame">
            </section>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Mijn Webpagina</p>
    </footer>

</body>
</html>
