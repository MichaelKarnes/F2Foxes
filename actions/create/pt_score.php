<?php
    chdir(dirname(__FILE__));
    //core init required for all pages
    require_once '../../core/init.php';

    if(Input::exists()) { // if at least one input has been submitted
    // if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	    if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {
            $user = new User();  //calls constructor of User.php
            $date = Input::get('date');
            $pushUpsRaw = Input::get('pushUpsRaw');
            $sitUpsRaw = Input::get('sitUpsRaw');
            $runRaw = Input::get('runRaw');
            $runTime = Input::get('runRaw');
            $type = Input::get('type');

            $db = DB::getInstance();

            $error = "";

            #form validation for the date and push up/sit up scores
            if (strlen($date) != 10 || substr($date,2,1) != '-' || substr($date,5,1) != '-') {
                $error = "The date you have inputed does not have the correct form.
                For example, September 24th, 2015 would be typed in as 09-24-2015." . 
                "<br>" . '<a href ="index.php"> Please Try Again </a>' . "<br>" . "<br>";
                break;
            }
            if (is_numeric($pushUpsRaw) == 0 || is_numeric($sitUpsRaw) == 0) {
                $error = "The request was invalid. Raw Push Up Scores and Raw Sit Up 
                Scores should be numbers." . "<br>" . '<a href ="index.php"> Please Try Again </a>' .
                "<br>" . "<br>";
                break;
            }

            #if the above is false, change push ups and sit ups to integers for future calculations
            $pushUpsRaw = intval($pushUpsRaw);
            $sitUpsRaw = intval($sitUpsRaw);

            #form validation for running score input
            if (strlen($runRaw) != 5 || substr($runRaw,2,1) != ':') {
                $error = "The run time you have inputed does not have the correct form.
                For example, 14 minutes and 5 seconds, would be typed in as 14:05" . 
                "<br>" . '<a href ="index.php"> Please Try Again </a>' . "<br>" . "<br>";
                break;
            }

            if (!empty($error)) {
                Session::put("error", $error);
            }
    

    #collect score data from the form in pt.php
    /*$date = $_POST['date'];
    $pushUpsRaw = $_POST['pushUpsRaw'];
    $sitUpsRaw = $_POST['sitUpsRaw'];
    $runRaw = $_POST['runRaw'];
    $runTime = $_POST['runRaw'];
    $type = $_POST['type']; */

    #form validation for the date and push up/sit up scores


    #for the run Score, convert to seconds and the integer data type
    #substr picks off the minutes and the seconds from the form run input xx:xx
    #runRaw = first two characters (minutes->secs) + last two characters (already secs) 
    $runRaw = (intval(substr($runRaw,0,2))*60) + intval(substr($runRaw,-2));
    
    
    #if the form has been set, do some calculations and communicate with
    #the PT table in the database. Notice if statements for male or female.
    if($user->data()->gender == 1) {
        #raw push ups to score using linear regression on score tables
        #from military.com. Regressions made in Excel like application. 
        #luckily error reduces to 0 for each case.
            if($pushUpsRaw <= 71) { 
                $pushUpsScore = ($pushUpsRaw*1.37925) + 2.06930;
                $pushUpsScore = round($pushUpsScore);
            } else {
                #calculate score over 100. 1 extra point for each push up over 71.
                $pushUpsScore = 100 + ($pushUpsRaw - 71);
            }

            #regression for mens running scores
            if ($type == "army") {
                if ($runRaw >= 780) {
                    #make sure that runRaw is divisible by 6. Otherwise regression will error
                    if($runRaw % 6 != 0) {
                        #go to the next highest time divisible by 6 to calculate score
                        $runRaw = $runRaw + (6 - ($runRaw % 6));
                    }
                        $runScore = round(($runRaw * -.229754412) + 279.18682); 
                } else {
                    #Above 100! extra point for every 5 seconds below 13:00 or 780 secs
                    #5 is negative to increase score rather than decrease
                    $runRaw = $runRaw + (5 - ($runRaw % 5));
                    $runScore = 100 + (($runRaw - 780) / -5); 
                }
            } else {
                //enter regression code here
            }
                        
            #sit Ups Scores calculated same way for both genders, done at end

            } elseif ($user->data()->gender == 0) {
                #female so new regression
                if($pushUpsRaw <= 42) { 
                    $pushUpsScore = ($pushUpsRaw*1.73996) + 26.9508;
                    $pushUpsScore = round($pushUpsScore);
                } else {
                    #calculate score over 100
                    $pushUpsScore = 100 + ($pushUpsRaw - 42);
                }

                if ($_POST['type'] == "army") {
                    if ($runRaw >= 936) {
                        if($runRaw % 6 != 0) {
                            #go to the next highest time divisible by 6 to calculate score
                            $runRaw = $runRaw + (6 - ($runRaw % 6));
                        }
                        $runScore = round(($runRaw * -.2020765) + 289.1643);
                    } else {
                        #extra point for every 5 seconds below 15:36 or 936 secs
                        #5 is negative to increase score rather than decrease
                        $runRaw = $runRaw + (5 - ($runRaw % 5));
                        $runScore = 100 + (($runRaw - 936) / -5);
                    }
                } else {
                    //enter regression code here
                }
           }

           #check for negative run score which is not allowed!
           if ($runScore < 0) {
               $runScore = 0;
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

           #overall score is useful to have!
           $overallScore = $pushUpsScore + $sitUpsScore + $runScore;

           //if user does not max all events, user cannot acheive over 300!!!
           if ($overallScore > 300 && ($pushUpsScore < 100 || $sitUpsScore < 100 || $runScore < 100)) {
               if ($pushUpsScore > 100) {
                   $pushUpsScore = 100;
               }
               if ($sitUpsScore > 100) {
                   $sitUpsScore = 100;
               }
               if ($runScore > 100) {
                   $runScore = 100;
               }
               $overallScore = $pushUpsScore + $sitUpsScore + $runScore;
           }
                    
          
           #check if any event has been failed, ie < 60.
           if ($pushUpsScore >= 60 && $sitUpsScore >= 60 && $runScore >= 60) {
               $passOrF = "Pass";
           } else {
               $passOrF = "Fail";
           }

           
           #input data into database table called pt, see cPanel for more info
           #the null field is for the auto increment unique row key
           #runTime was set near the very top of this file
           $query = $db->query("INSERT INTO pt VALUES('', 
           '$userid', '$lastName', '$firstName', '$type', '$date', '$pushUpsRaw',
           '$pushUpsScore', '$sitUpsRaw',
           '$sitUpsScore', '$runRaw', '$runTime', '$runScore',
           '$overallScore', '$passOrF')");

           $db->insert("pt", array(
                "user_id"=>$user->data()->id,
                "last"=>$user->data()->last,
                "first"=>$user->data()->first,
                "type"=>$type,
                "date"=>$date,
                "push_ups_raw"=>$pushUpsRaw,
                "push_ups_score"=>$pushUpsScore,
                "sit_ups_raw"=>$sitUpsRaw,
                "sit_ups_score"=>$sitUpsScore,
                "run_time"=>$runTime,
                "run_score"=>$runScore,
                "total_score"=>$overallScore,
                "pass"=>$passOrF));

            #Session::put("success", "Thank you. Your response has been recorded. 
            #Redirecting you to your PT Scores.");

          }
    }  
          
    Redirect::to($_SERVER['HTTP_REFERER']);  
?>



