<?php

  $weather = "";
  $error = "";

  if (array_key_exists('city', $_GET))
  {
    $city = str_replace(' ', '', $_GET['city']);

    $file = 'https://www.weather-forecast.com/locations/'.$city.'/forecasts/latest';
    $file_headers = @get_headers($file);

    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
    {
      $error = "The city could not be found";
    }
    else 
    {

      $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");


      $firstPageArray = explode('3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);

      if (sizeof($firstPageArray) > 1)
      {

        $secondPageArray = explode('</span>', $firstPageArray[1]);

        if (sizeof($secondPageArray) > 1)
        {
          $weather =  $secondPageArray[0];
        }
        else
        {
          $error = "The city could not be found";
        }
      }
      else
      {
        $error = "The city could not be found";
      }
      

    }
  }

?>

<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <title>Weather Teller</title>

    <style type="text/css">

      body
      {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0 auto;
        background-image: url(https://images.hdqwalls.com/download/soothing-nature-ql-1366x768.jpg);
        display: flex;
        background-position: top center;
        background-attachment: fixed;
        background-size: cover;
      }

      .container
      {
        width:800px;
        margin-top:130px;
        text-align: center;
      }

      h1
      {
        color:white;
        font-size:60px;
        font-weight: lighter;
      }

      h4
      {
        font-weight:lighter;
        color:rgba(255, 255, 255, 0.521);
      }

      #city
      {
        width:250px;
        height:40px;
        margin-top:20px;
        padding:0px 10px 0px 10px;
        border-radius: 5px;
        border:none;
      }

      #city:focus
      {
        outline:none;
      }

      #submit
      {
        margin-bottom:5px;
        padding: 7px 20px 7px 20px;
      }

      .weather
      {
        margin-top:20px;
      }

    </style>

  </head>

  <body>

    <div class="container">

      <h1>Welcome to Weather Teller</h1>
      <h4>Enter the name of a city.</h4>

      <form>

        <input type="text" id="city" name="city" placeholder="E.g. Delhi" value="<?php if (array_key_exists('city', $_GET)) { echo $_GET['city']; } ?>">
        <input type="submit" id="submit" class="btn btn-dark" value="Go">

      </form>

      <div class="weather">
        <?php
          if ($weather)
          {
            echo '<div class="alert alert-dark" role="alert">'.$weather.'</div>';
          }
          else if ($error)
          {
            echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
          }
        ?>
      </div>

    </div>

    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>

</html>