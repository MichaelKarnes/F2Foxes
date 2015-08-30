<?php

    #collect score data from the form in pt.php
    $date = $_POST['date'];
    $pushUpsRaw = $_POST['pushUpsRaw'];
    $sitUpsRaw = $_POST['sitUpsRaw'];
    $runRaw = $_POST['runRaw'];

    #form validation for the date
    if (strlen($date) != 10 || substr($date,2,1) != '-' || substr($date,5,1) != '-') {
        echo "The date you have inputted does not have the correct form.
        For example, September 24th, 2015 would be typed in as 09-24-2015." . 
        "<br>" . '<a href ="pt.php"> Please Try Again </a>' . "<br>" . "<br>";
    }
    if (is_numeric($pushUpsRaw) == 0 || is_numeric($sitUpsRaw) == 0) {
        echo "The request was invalid. Raw Push Up Scores and Raw Sit Up 
        Scores should be numbers." . "<br>" . '<a href ="pt.php"> Please Try Again </a>' .
        "<br>" . "<br>";
    }

    #if the above is false, change push ups and sit ups to integers
    $pushUpsRaw = intval($pushUpsRaw);
    $sitUpsRaw = intval($sitUpsRaw);

    if (strlen($runRaw) != 5 || substr($runRaw,2,1) != ':') {
        echo "The run time you have inputted does not have the correct form.
        For example, 14 minutes and 5 seconds, would be typed in as 14:05" . 
        "<br>" . '<a href ="pt.php"> Please Try Again </a>' . "<br>" . "<br>";
    }


    #for the run Score, convert to seconds
    #substr picks off the minutes and the seconds from the form run input xx:xx
    #for the minutes, convert to seconds by multiplying by 60,
    #both minutes and seconds converted to integers, add!!!!
    $runRaw = (intval(substr($runRaw,0,2))*60) + intval(substr($runRaw,-2));
    #if the form has been set, do some calculations and communicate with
    #the PT table in the database. Notice if statements for male or female.
    
    if($_POST['gender'] == "male") {
        #raw push ups to score using linear regression on score tables
        #from military.com
            if($pushUpsRaw <= 71) { 
                $pushUpsScore = ($pushUpsRaw*1.37925) + 2.06930;
                $pushUpsScore = round($pushUpsScore);
            } else {
                #calculate score over 100
                $pushUpsScore = 100 + ($pushUpsRaw - 71);
            }

            #regression for mens running scores
            if ($runScore >= 780) {
                 $runScore = ($runRaw * -.22988) + 279.298; 
                 $runScore = round($runScore);
            } else {
                 #extra point for every 6 seconds below 13:00 or 780 secs
                 #5 is negative to increase score rather than decrease
                 $runScore = 100 + (($runRaw - 780) / -5);
                 
            }
                        
            #sit Ups Scores calculated same way for both genders, done at end
            } else {
                #female so new regression
                if($pushUpsRaw <= 42) { 
                    $pushUpsScore = ($pushUpsRaw*1.73996) + 26.9508;
                    $pushUpsScore = round($pushUpsScore);
                } else {
                    #calculate score over 100
                    $pushUpsScore = 100 + ($pushUpsRaw - 42);
                }

                if ($runScore >= 936) {
                    $runScore = ($runRaw * -.2020765) + 289.1643;
                } else {
                    #extra point for every 6 seconds below 15:36 or 936 secs
                    #5 is negative to increase score rather than decrease
                    $runScore = 100 + (($runRaw - 936) / -5);
                }

           }

           #finally calculate sit Ups Score
           if($sitUpsRaw < 21) {
		        $sitUpsScore = 0;
	       } elseif($sitUpsRaw >=21 && $sitUpsRaw <= 78) {
		        $sitUpsScore = (1.5996*$sitUpsRaw) - 24.786;
                $sitUpsScore = round($sitUpsScore);
	       } else {
	            $sitUpsScore = 100 + ($sitUpsRaw - 78);
	       }

           $overallScore = $pushUpsScore + $sitUpsScore + $runScore;
           #input data into database 
           echo "Date: " . $date . "Push Ups:" . $pushUpsRaw . $pushUpsScore .
           "Sit Ups: " . $sitUpsRaw . $sitUpsScore . 
           "Run: " . $runRaw . $runScore . "Overall: " . $overallScore; 
                
                
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
