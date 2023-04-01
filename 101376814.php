<!-- Student Number: 101376814 Class Friday @ 4pm-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Casey's Store</title>
    <meta name="description" content="Assignment 1">
    <meta name="author" content="Casey Hsu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
// Assigning variables to take information from the Super Server variable
$ipAddress = $_SERVER['REMOTE_ADDR']; // Accessing the values store in the SERVER array for visiting IP
$browserInfo = $_SERVER['HTTP_USER_AGENT']; // Accessing the values store in the SERVER array for user browser
date_default_timezone_set('US/Eastern'); // Setting the default timezone to Eastern
$date = date('Y-m-d h:i:s'); // Formatting to

// Outputting the header information
echo "<h1>The Visiting Client's Information:</h1>";
echo "<p>IP address is: $ipAddress </p>";
echo "<p>Browser info is: $browserInfo</p>";
echo "<p>Accessed on: $date</p>";
echo "<hr>";

// Declaring my data array with 3 products and 3 sub-products each for a total of 9
$miceList = array(
    "Logitech" => array (
        "SuperLight" => 899,
        "PROX" => 799,
        "MX518" => 699),
    "Razer" => array (
        "DeathAdder" => 599,
        "Basilisk" => 400,
        "Viper" => 300),
    "Zowie" => array (
        "EC" => 200,
        "FK" => 100,
        "S" => 99));

// I placed my store heading in right above my form
echo '<h1>Casey\'s Store.</h1>';
echo '<hr>';
echo '<br>';

// I chose to do the form within the controller to make it dynamic
echo '<form action="101376814.php" method="GET">';
echo '<select name="miceList">';

// Using my array of data to implement dynamic option choices
foreach ($miceList as $key => $value) {
    // This took me two days to implement lol but finally working so option is checked if user selects sub-category!
    if($_GET['miceList'] == $key){
            echo '<option name="' . $key . "\" selected>$key</option>";
        }else echo '<option name="' . $key . '">' . $key . '</option>';
}

echo '</select>';
echo '<br><br>';

// This is my implementation of the checkbox form portion that only comes into scope when the super global variable
// $_GET is set with the name miceList
if(isset($_GET['miceList'])){
    // Checking to see if the choice submitted that is stored in the $_GET array matches my array categories
    if($_GET['miceList'] == "Logitech")
        // Same implementation of menu but using checkboxes
        foreach ($miceList['Logitech'] as $key => $value) {
            echo '<label>'. $key;
// In order to evaluate what the user selects I made a collection of numbers stored in the $_GET named 'mousePrice'
            if (isset($_GET['mousePrice']) && $_GET['mousePrice'] == $value) {
                // I tried to implement the checked for checkboxes the same way as my option menu but had some issue
                // Would love to know the solution to this if possible
                echo '<input checked type="checkbox" name="mousePrice[]" value="' . $value . '">';
            } else
                echo '<input type="checkbox" name="mousePrice[]" value="' . $value . '">';
            echo '$' . $value . '</label><br>';
        }elseif ($_GET['miceList'] == "Razer"){
        foreach ($miceList['Razer'] as $key => $value) {
            echo '<label>'. $key;
            if (isset($_GET['mousePrice']) && $_GET['mousePrice'] == $value) {
                echo '<input checked type="checkbox" name="mousePrice[]" value="' . $value . '">';
            } else
                echo '<input type="checkbox" name="mousePrice[]" value="' . $value . '">';
            echo '$' . $value . '</label><br>';
        }
    }elseif ($_GET['miceList'] == "Zowie") {
        foreach ($miceList['Zowie'] as $key => $value) {
            echo '<label>' . $key;
            if (isset($_GET['mousePrice']) && $_GET['mousePrice'] == $value) {
                echo '<input checked type="checkbox" name="mousePrice[]" value="' . $value . '">';
            } else
                echo '<input type="checkbox" name="mousePrice[]" value="' . $value . '">';
                echo '$' . $value . '</label><br>';
        }
    }
}

echo '<br>';
echo '<input type="submit" value="Checkout">';
echo '</form>';
echo '<br>';

// My solution for evaluating what the user has checked is checking if a variable mousePrice exists
if(isset($_GET['mousePrice'])){
    // Making two temp variables to manipulate the array of numbers
    $mousePrice = $_GET['mousePrice'];
    $total = 0;
    foreach($mousePrice as $key => $value){
// Total starts at 0 and adds any choices selected
        $total += $value;
    }// Using the number_format function to display decimal format in a heading tag
    echo '<h3> Your total is $' . number_format($total, 2) . '</h3>';
}

echo show_source(__FILE__);
?>

</body>
</html>