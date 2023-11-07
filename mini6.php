<!DOCTYPE html>
<html>
    <body>
           <?php

                /*
                COLLECTING HTML FORM INPUT TO CSV FILE
                */

                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    //collect user input
                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $book = $_POST['some_books'];
                    $OS = $_POST['OS'];

                    //store input into an array
                    $data = array($first_name, $last_name, $email, $phone, $book, $OS);

                    //specify csv file relative path
                    $csvfile = './mini6.csv';
                    
                    //append mode
                    $file = fopen($csvfile, 'a'); 

                    //If the csv file cannot be opened
                    if ($file === false){
                        die('Error opening the file ' . $file);
                    }

                    //append information to the csv file as a row
                    fputcsv($file, $data);

                    //close the file
                    fclose($file);

                }

                $csvFile = fopen('mini6.csv', 'r');

                //if csvfile is empty, display header
            

                /*
                DISPLAYING CSV DATA TO HTML
                */

                if ($csvFile) {

                    //assume csv file is empty
                    $isEmpty = true;

                    //counter for alternating row colors
                    $row_color = 0;

                    //open table
                    echo '<table border="1">';

                    echo '<tr style="background-color: orange;">';
                    echo '<td>' . '&nbsp;&nbsp;' . "First Name" . '&nbsp;&nbsp;' . '</td>';
                    echo '<td>' . '&nbsp;&nbsp;' . "Last Name" . '&nbsp;&nbsp;' . '</td>';
                    echo '<td>' . '&nbsp;&nbsp;' . "Email" . '&nbsp;&nbsp;' . '</td>';
                    echo '<td>' . '&nbsp;&nbsp;' . "Phone" . '&nbsp;&nbsp;' . '</td>';
                    echo '<td>' . '&nbsp;&nbsp;' . "Book" . '&nbsp;&nbsp;' . '</td>';
                    echo '<td>' . '&nbsp;&nbsp;' . "OS" . '&nbsp;&nbsp;' . '</td>';
                    echo '</tr>';


                    while (($data = fgetcsv($csvFile)) !== false) {

                        if (!empty($data)){

                            //csv file not empty
                            $isEmpty = false;

                            //new row
                            //toggle color
                            if ($row_color % 2 == 0){
                                echo '<tr style="background-color: yellow;">';
                            } else {
                                echo '<tr style="background-color: pink;">';
                            }
                            
                            //add each element in different columns
                            foreach ($data as $element) {
                                echo '<td>' . '&nbsp;&nbsp;' . $element . '&nbsp;&nbsp;' . '</td>';
                            }
                            
                            //end row
                            echo '</tr>';

                            //increment color variable
                            $row_color++;
                        }
                    }

                    /*
                    EMPTY CSV FILE
                    */
                    if($isEmpty){

                        //display special row
                        echo '<tr style="background-color: red;">';
                        echo '<td colspan="6" style="text-align: center; color: white">Empty CSV File</td>';
                        echo '</tr>';
                    }
                    
                    // Close the table
                    echo '</table>';
                    
                    // Step 6: Close the CSV file
                    fclose($csvFile);

                } else {

                    die('Error opening the file ' . $File);

                }

           ?>
     </body>
</html>