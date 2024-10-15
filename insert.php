<!DOCTYPE html>
<html lang="nl">

<head>
    <title>TechnoTV</title>
    <?php include 'php/Meta.php'; ?>
    <link href="css/index.css" rel="stylesheet">

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

    $commandRunner = new DatabaseCommands($conn);

    function insertFlash()
    {
        if (!isset($_SESSION["flash-image2-log"]))  {
            $_SESSION["flash-image2-log"] = null;
        } 
        if (isset($_SESSION["flash-image1-log"])){
            global $commandRunner;
            $commandRunner->insertNieuwsflash($_POST["flash-header1"], $_POST["flash-desc1"], $_SESSION["flash-image1-log"], $_SESSION["flash-image2-log"]);
        }
        unset($_SESSION["flash-image1-log"]);
        unset($_SESSION["flash-image2-log"]);
    }
    function insertGallery(){
        global $commandRunner;

    
        // Call the insertGallery function with the gallery title and image paths
        $commandRunner->insertGallery($_POST["gallery-header1"],
        $_SESSION["gallery-image1-log"],
        $_SESSION["gallery-image2-log"],
        $_SESSION["gallery-image3-log"],
        $_SESSION["gallery-image4-log"],
        $_SESSION["gallery-image5-log"],
        $_SESSION["gallery-image6-log"],
        $_SESSION["gallery-image7-log"],
        $_SESSION["gallery-image8-log"],
        $_SESSION["gallery-image9-log"],
        $_SESSION["gallery-image10-log"]);
    }


    function insertStory(){
        global $commandRunner;

    
        // Call the insertGallery function with the gallery title and image paths
        $commandRunner->insertStory($_POST["Story-header1"], $_POST["Story-desc1"], $_POST["Story-desc2"]);
    }
    ?>
</head>

<body id="index-body">
    <?php include 'php/Header.php'; ?>

    <main>
        <?php
        $uploadCounter = 0;
        function appendImageFile($formName, $formType){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $encodedString = random_bytes(30);
                $DecodedString = bin2hex($encodedString);
                $insertCheckResults = 0;
                global $uploadCounter;
                $fileName = basename($_FILES["$formName"]["name"]);
                $securityCheckResults = 0;
                $imgDir = "newsImages/";
                $formNameConst = "$formName-log";
                $imageFileType = strtolower(pathinfo($_FILES["$formName"]["name"], PATHINFO_EXTENSION));
                

                $FileInfo = $imgDir . $DecodedString . "." . $imageFileType;
                print_r($_FILES["flash-image2"]["error"]);
                if (file_exists($FileInfo)) {
                    echo "File already exists. ";
                    $securityCheckResults = 1;
                }

                $check = getimagesize($_FILES["$formName"]["tmp_name"]);
                if ($check == false) {
                    echo "Gekozen file is geen foto.";
                    $securityCheckResults = 1;
                }

                if ($_FILES["$formName"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $securityCheckResults = 1;
                }

                if (isset($_SESSION[$formName]) && $_SESSION[$formName] == $fileName) {
                    echo "Error: The file '$fileName' has already been uploaded.<br>";
                    $securityCheckResults = 1;
                    $insertCheckResults = 1;
                } else {
                    $_SESSION[$formName] = $fileName;
                }

                if ($securityCheckResults == 0) {
                    echo "No Errors found!";
                    if (move_uploaded_file($_FILES["$formName"]["tmp_name"], $FileInfo)) {
                        echo $fileName . " was uploaded as " . $FileInfo . " YIPPIE!!!!!!!!!!!!!<br>"; 
                        $_SESSION[$formNameConst] = $FileInfo;
                        $uploadCounter++;
                    } else {
                        echo "Something went wrong while uploading your file, Please try again!";
                    }
                }
            }
        }
        ?>

        <form id="buttons" action="insert.php" method="get">
            <section id="insert-form-select-knop">
                <input type="submit" name="Nieuwsflash" class="insert-button" value="Nieuwsflash">
                <!-- Unfinished <input type="submit" name="VisioStory" class="insert-button" value="Visueel Verhaal">-->
                <input type="submit" name="Gallery" class="insert-button" value="Gallerij">
                <input type="submit" name="Story" class="insert-button" value="Verhaal">
                <!--Unfinished <input type="submit" name="invite" class="insert-button" value="Invitatie">-->
            </section>
        </form>
        <section id="form-input-section"><!-- This is the section where all the forms get put into.-->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formType = $_POST['form_type'] ?? '';
        
            if ($formType === 'VisioStory') {
                // Handle VisioStory submission
            } else if ($formType === 'Story') {
                insertStory();
            } else if ($formType === 'Gallery') {
                if (!isset($_POST['Gallery-image1'])) {
                    appendImageFile("gallery-image1", "Gallery");
                    appendImageFile("gallery-image2", "Gallery");
                    appendImageFile("gallery-image3", "Gallery");
                    appendImageFile("gallery-image4", "Gallery");
                    appendImageFile("gallery-image5", "Gallery");
                    appendImageFile("gallery-image6", "Gallery");
                    appendImageFile("gallery-image7", "Gallery");
                    appendImageFile("gallery-image8", "Gallery");
                    appendImageFile("gallery-image9", "Gallery");
                    appendImageFile("gallery-image10", "Gallery");

                    if ($uploadCounter === 10) {
                        insertGallery();   
                        $uploadCounter = 0;
                    } 
                }
            } else if ($formType === 'NieuwsFlash') {
                if (!isset($_POST['flash-image1'])) {
                    appendImageFile("flash-image1", "Nieuwsflash");
                    if ($_FILES["flash-image2"]["error"] != 4) {
                    appendImageFile("flash-image2", "Nieuwsflash");
                    }
                    insertFlash();
                }
            }
        }
     
            if (isset($_GET['VisioStory'])) {
                echo "
                <h2 id='form-h2'>Visieel verhaal</h2>
                <form id='uploadForm' action='insert.php' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='form_type' value='VisioStory'>
                    <input type='text' name='visioS-header1' id='visioS-header1' placeholder='Voer hier de Header in.'>
                    <input type='text' name='visioS-desc1' id='visioS-desc1' placeholder='Voer hier het artikel in.'>
                    <input type='file' name='visioS-image1' id='visioS-image1' accept='image/*' required>
                    <input type='file' name='visioS-image2' id='visioS-image2' accept='image/*' required>
                    <br>
                    <button type='submit' name='submit' class='btn'>Upload</button>
                </form>";
            } else if (isset($_GET['Gallery'])) {
                echo "
                <h2 id='form-h2'>Gallery</h2>
                <form id='uploadForm' action='insert.php' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='form_type' value='Gallery'>
                    <input type='text' name='gallery-header1' id='gallery-header1' placeholder='Voer hier de Header in.' required><br><br>
                    <input type='file' name='gallery-image1' id='gallery-image1' accept='image/*' required><br><br>
                    <input type='file' name='gallery-image2' id='gallery-image2' accept='image/*' required><br><br>
                    <input type='file' name='gallery-image3' id='gallery-image3' accept='image/*' required><br><br>
                    <input type='file' name='gallery-image4' id='gallery-image4' accept='image/*' required><br><br>
                    <input type='file' name='gallery-image5' id='gallery-image5' accept='image/*' required><br><br>
                    <input type='file' name='gallery-image6' id='gallery-image6' accept='image/*' required><br><br>
                    <input type='file' name='gallery-image7' id='gallery-image7' accept='image/*' required><br><br>
                    <input type='file' name='gallery-image8' id='gallery-image8' accept='image/*' required><br><br>
                    <input type='file' name='gallery-image9' id='gallery-image9' accept='image/*' required><br><br>
                    <input type='file' name='gallery-image10' id='gallery-image10' accept='image/*'><br><br>
                    <button type='submit' name='submit' class='btn'>Upload</button>
                </form>";
            } else if (isset($_GET['invite'])) {
                echo "<img class='kaart' src='../img/special.jpg' alt='logo'>";
            } else if (isset($_GET['Story'])) {
                echo "<h2 id='form-h2'>Verhaal</h2>
                <form id='uploadForm' action='insert.php' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='form_type' value='Story'>
                    <input type='text' name='Story-header1' id='Story-header1' placeholder='Voer hier een header in.' required>
                    <input type='text' name='Story-desc1' id='Story-desc1' placeholder='Voer hier het artikel in.' required>
                    <input type='text' name='Story-desc2' id='Story-desc2' placeholder='Voer hier het artikel in.' required>
                    <br>
                    <button type='submit' name='submit' class='btn'>Upload</button>
                </form>";
            } else {
                echo "
                <h2 id='form-h2'>NieuwsFlash</h2>
                <form id='uploadForm' action='insert.php' method='post' enctype='multipart/form-data'>
                    <input type='hidden' class='flash-form-elements' name='form_type' value='NieuwsFlash'>
                    <input type='text' class='flash-form-elements' name='flash-header1' id='flash-header1' placeholder='Voer hier een header in.' required>
                    <input type='text' class='flash-form-elements' name='flash-desc1' id='flash-desc1' placeholder='Voer hier het artikel in.' required>
                    <label for='flash-image1' class='custom-file-upload'>
                        <i class='fa fa-cloud-upload'></i> Upload Image 1
                    </label>
                    <input type='file' class='flash-form-elements' name='flash-image1' id='flash-image1' accept='image/*' required>

                    <label for='flash-image2' class='custom-file-upload'>
                        <i class='fa fa-cloud-upload'></i> Upload Image 2
                    </label>
                    <input type='file' class='flash-form-elements' name='flash-image2' id='flash-image2' accept='image/*'>

                    <br>
                    <button type='submit' name='submit' class='btn'>Upload</button>
                </form>";
            
            }
            
        ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Mijn Webpagina</p>
    </footer>
</body>

</html>
