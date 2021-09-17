<!DOCTYPE html>
<!--                       ___
                        __/_  `.  .-"'"-.
Author: David Calabrese \_,` | \-'  /   )`-')
Date: 09/13/2021         "") `"` DC  \  ((`"`
                        ___Y  ,    .'7 /|
                      (_,___/...-` (_/_/ -->
<html lang='en'>
   <head>    
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
       <link rel="stylesheet" href="style.css">
        <title>Badlibs Exercise Chapter 13</title>
   </head>
   <body>
    <h1>Project 1 - Badlibs</h1>

        <div class="container">
            <?php if (!isset($_POST['submit'])) { ?>
                <h2>Fill out the following fields:</h2>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        Enter a color: <br />
                        <input type="text" name="color" /><br />
                        Enter another color: <br />
                        <input type="text" name="color_two" /><br />
                        Enter an adjective: <br />
                        <input type="text" name="adjective" /><br />
                        Enter a number: <br />
                        <input type="text" name="a_number" /><br />
                        Enter a plural noun: <br />
                        <input type="text" name="plural_noun" /><br />
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Create Badlib</button>
                </form>
                <?php } else { ?> 

                <h2>Here's the badlib!</h2>
                    <?php
                        // open db connection
                        $dbc = mysqli_connect('localhost', 'student', 'student', 'Badlibs') 
                            or trigger_error('Error connecting to MySQL server.', E_USER_ERROR);
                        
                        $color = $_POST['color'];
                        $color_two = $_POST['color_two'];
                        $adjective  = $_POST['adjective'];
                        $plural_noun = $_POST['plural_noun'];
                        $a_number = $_POST['a_number'];

                        $story = "<br><br>Roses are " . $color .
                            "<br>Violets are " . $color_two .
                            "<br>Relationships are " . $adjective  . 
                            "<br>I would rather have " . $a_number . " " . $plural_noun; 

                        $insert_query = "INSERT INTO badlibs  (color, 
                                                        color_two, 
                                                        adjective, 
                                                        plural_noun, 
                                                        a_number, 
                                                        story) " . 
                                "VALUES ('$color', 
                                        '$color_two', 
                                        '$adjective', 
                                        '$plural_noun', 
                                        '$a_number', 
                                        '$story')";
                                        
                        $insert_result = mysqli_query($dbc, $insert_query);

                        if (!$insert_result) 
                        {
                            trigger_error("Query error description: " .
                                mysqli_error($dbc), E_USER_WARNING);
                        }

                        $select_query = "SELECT story FROM badlibs ORDER BY id DESC"; 

                        $select_result = mysqli_query($dbc, $select_query) or 
                            trigger_error('Error querying database.', E_USER_ERROR);

                        while ($row = mysqli_fetch_array($select_result))
                        {
                            echo "Story: " . $row['story'];
                        }

                        mysqli_close(($dbc)); 
                    ?>

                    <?php } ?>
        </div>
    
   </body>
</html>