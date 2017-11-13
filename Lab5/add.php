<?php
/*
 Website allows user to enter in a site name into a database
  Through all my debugging only some of the sites I entered in actually work on view page
 sites that I debugged with that actually work: http://www.niemanlab.org
http://www.time.com
http://www.wpri.com
 */
include_once './assets/header.php';
include_once './sites.php';
include_once './assets/dbconnect.php';

$db = dbconnect();
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? NULL;

switch($action) { //ADD PAGE ADDS WEBSITES TO DATABASE!
    case "submit": // when user clicks submit button
        echo siteForm(); // shows the site form
        if(filter_var($url, FILTER_VALIDATE_URL) !==false) { // makes sure url is a real and valid url
            echo "<h2>Site is valid</h2>";
            $addAvailable = isSiteAlreadyAdded($db, $url); //checks if site is already in database, function returns bool true or false
            if ($addAvailable == true) {
                try { // grab all links in web site
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($curl);
                    preg_match_all('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $output, $matches, PREG_OFFSET_CAPTURE);
                    curl_close($curl);
                } catch (PDOException $e) {
                    echo "There was a problem getting you into your url, please try again";
                }
                $site_id = AddToSitesTable($db); // adds site to sitetable

                array_walk($matches, create_function('&$value,$key', '$value = json_encode($value);')); // makes every link unique
                $matches = array_unique($matches);
                array_walk($matches, create_function('&$value,$key', '$value = json_decode($value, true);'));
                foreach ($matches as $match) { // function to add every link to link able one at a time and outputs the link
                    foreach ($match as $link) {
                        echo $link[0] . "<br>";
                        addSiteLinks($db, $link[0], $site_id);
                    }
                }
                $rows = countRows($db, $site_id); // shows how many links were added
                echo $rows . " inserted";
            }
            else {
                echo "<h3>Site is already in Database!</h3>"; // error message if site is already in db
            }
        }
        else {
            echo "<h2>Site is not valid</h2>"; // error message is user entered in invalid site name
        }
        break;
    default:
        echo siteForm(); // default (if submit is not clicked)
        break;
}
?>


