<?php 

if(isset($_POST['get_weather'])){
      $location = $_POST['location'];
      //  API kEY fOR the Weather Check  AAfter Login The Weather Api 
      $apiKey="8cdb7c7e6dfe4590b0a140614242810";
      // Full Link Agter Including Api Key And State And Date   
      $data = "http://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$location}";
        // Get Api Data Link With The File_get_contents funtion 
      $api = file_get_contents($data);
      // converting Data in to Json Format To get Data in Understanding And Array Format 
      $response_data = json_decode($api,true);
      if(empty($response_data["location"]["name"])){
        ?>
<script>
alert("This Is Not a City or Not a Country");
window.location.href("index.php");
session
</script>
<?php 
      }
      // View The Araay OF Api 
      // echo "<pre>";
      // print_r($response_data);
      // echo "</pre>";
 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        background-color: aqua;
        color: #fff;
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 20px;
    }

    .weather-card {
        max-width: 500px;
        margin: auto;
        padding: 30px;
        background: rgba(0, 0, 0, 0.8);
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        transition: transform 0.2s;
    }

    .weather-card:hover {
        transform: scale(1.02);
    }

    h2 {
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    #weatherResult {
        margin-top: 20px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    .result-icon {
        font-size: 50px;
        color: #ffcc00;
    }

    @media (max-width: 576px) {
        .weather-card {
            padding: 20px;
        }
    }
    </style>
</head>

<body>

    <div class="weather-card">
        <h2><i class="fas fa-sun"></i> Weather App</h2>
        <form id="weatherForm" method="POST" action="">
            <div class="form-group">
                <label for="location">Enter The Correct City or Country:</label>
                <input type="text" class="form-control" name="location" id="location"
                    placeholder="e.g. Usa,India,Mumubia,Coimbatore" required>

            </div>
            <div class="form-group">
                <label for="location">Enter The Email</label>
                <input type="text" class="form-control" name="email" id="location"
                    placeholder="Enter The Email To Get Weather Report On Email">

            </div>
            <button type="submit" name="get_weather" class="btn btn-warning btn-block">Get Weather Report</button>
            <button type="submit" name="get_weather_email" class="btn btn-success btn-block">Get Weather Data On
                Email</button>
        </form>

    </div>
    <div class="contanier ">
        <div class="row mt-5">
            <div class="col-md-12 mt-5 col-lg-3 ">
                <div class="card text  " style=" background-color:black; max-width: 18rem;">
                    <div class="card-body">
                        <div style="font-weight:900; font-size:26px; ">Weather Address</div>
                        <h5 class="card-title"></h5>
                        <p style="font-weight:900; font-size:16px; ">Country :
                            <?php if(!empty($response_data["location"]["country"])){print_r($response_data["location"]["country"]);}?>
                        </p>
                        <p style="font-weight:900; font-size:16px; ">State :
                            <?php  if(!empty($response_data["location"]["region"])){print_r($response_data["location"]["region"]);}?>
                        </p>
                        <p style="font-weight:900; font-size:16px; ">City :
                            <?php  if(!empty($response_data["location"]["name"])){print_r($response_data["location"]["name"]);}?>
                        </p>
                        <p style="font-weight:900; font-size:16px; ">Date & Time :
                            <?php  if(!empty($response_data["location"]["localtime"])){print_r($response_data["location"]["localtime"]);}?>
                        </p>
                        <p style="font-weight:900; font-size:16px; ">Latitude :
                            <?php  if(!empty($response_data["location"]["lat"])){print_r($response_data["location"]["lat"]);}?>
                        </p>
                        <p style="font-weight:900; font-size:16px; ">Longitude :
                            <?php  if(!empty($response_data["location"]["lon"])){print_r($response_data["location"]["lon"]);}?>
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-md-12 mt-5  col-lg-3 ">
                <div class="card text pb-3 " style=" background-color:black; ">
                    <div class="card-body">
                        <div style="font-weight:900; font-size:26px; ">Current Weather </div>

                        <?php if(!empty($response_data["current"]["condition"]["icon"])){ ?><img
                            src="<?php if(!empty($response_data["current"]["condition"]["icon"])){print_r("https:".$response_data["current"]["condition"]["icon"]);}?>"
                            width="120px" height="120px;" alt="Weather Image"><?php } ?>
                        <span class=" " style="font-weight:900; font-size:30px;">
                            <?php if(!empty($response_data["current"]["temp_c"])){print_r($response_data["current"]["temp_c"]);}?>
                            <i class="fa fa-thermometer-half" style="font-weight:900; font-size:50px;"
                                aria-hidden="true"></i>

                        </span>
                        <p class="pb-4" style="font-weight:900; font-size:20px; ;">Condition :
                            <?php  if(!empty($response_data["current"]["condition"]["text"])){print_r($response_data["current"]["condition"]["text"]);}?>
                        </p>

                    </div>
                </div>

            </div>
            <div class="col-md-12 mt-5  col-lg-3 ">
                <div class="card text  " style=" background-color:black; max-width: 18rem;">
                    <div class="card-body">
                        <div style="font-weight:900; font-size:26px; " class="pb-4">Weather Air Details</div>
                        <h5 class="card-title"></h5>
                        <p style="font-weight:900; font-size:16px; ">Wind Meter Per-Hour :
                            <?php if(!empty($response_data["current"]["wind_mph"])){print_r($response_data["current"]["wind_mph"]);}?>
                        </p>
                        <p style="font-weight:900; font-size:16px; ">Wind Kilo Per-Hour :
                            <?php  if(!empty($response_data["current"]["wind_kph"])){print_r($response_data["current"]["wind_kph"]);}?>
                        </p>
                        <p class="pb-5" style="font-weight:900; font-size:16px; ">Wind Degree :
                            <?php  if(!empty($response_data["current"]["wind_degree"])){print_r($response_data["current"]["wind_degree"]);}?>
                        </p>

                    </div>
                </div>

            </div>
            <div class="col-md-12 mt-5  col-lg-3 ">
                <div class="card text  " style=" background-color:black; max-width: 18rem;">
                    <div class="card-body">
                        <div style="font-weight:900; font-size:26px; ">Weather Other Details</div>
                        <h5 class="card-title"></h5>
                        <p style="font-weight:900; font-size:16px; ">Humidity :
                            <?php if(!empty($response_data["current"]["humidity"])){print_r($response_data["current"]["humidity"]);}?>
                        </p>
                        <p style="font-weight:900; font-size:16px; ">Clouds :
                            <?php  if(!empty($response_data["current"]["cloud"])){print_r($response_data["current"]["cloud"]);}?>
                        </p>
                        <p style="font-weight:900; font-size:16px; ">Health Index Fahrenheit :
                            <?php  if(!empty($response_data["current"]["heatindex_f"])){print_r($response_data["current"]["heatindex_f"]);}?>
                        </p>
                        <p style="font-weight:900; font-size:16px; ">Health Index Celsius :
                            <?php  if(!empty($response_data["current"]["heatindex_c"])){print_r($response_data["current"]["heatindex_c"]);}?>
                        </p>

                    </div>
                </div>

            </div>
        </div>
        <?php if(!empty($response_data["location"]["name"])){?>
        <div class="row">
            <div class="col-md-12 mt-5  col-lg-12 ">
                <div class="card text  " style=" background-color:black; ">
                    <div class="card-body">
                        <div style="font-weight:900; font-size:26px; ">Weather Description </div>
                        
                            
                        <p class= "mt-2">Today's weather brings a mix of sun and clouds with mild temperatures <?php if(!empty($response_data["current"]["temp_c"])){print_r($response_data["current"]["temp_c"]);}?>.  gradually   <?php  if(!empty($response_data["current"]["condition"]["text"])){print_r($response_data["current"]["condition"]["text"]);}?> as the day
                            progresses. Expect light southwest winds at<?php if(!empty($response_data["current"]["wind_mph"])){print_r($response_data["current"]["wind_mph"]);}?> mph, keeping the air pleasant and
                            refreshing. but there may be a slight increase in cloud cover by the
                            Day. Humidity will stay moderate at <?php if(!empty($response_data["current"]["humidity"])){print_r($response_data["current"]["humidity"]);}?>throughout the day, 
                            Visibility is excellent, so any outdoor activities should be enjoyable. The Day cools down
                            to <?php if(!empty($response_data["current"]["temp_f"])){print_r($response_data["current"]["temp_f"]);}?>°F  under  <?php  if(!empty($response_data["current"]["condition"]["text"])){print_r($response_data["current"]["condition"]["text"]);}?>  on  The <?php  if(!empty($response_data["location"]["localtime"])){print_r($response_data["location"]["localtime"]);}?> </p>
                    </div>
                </div>

            </div>

        </div>
        <?php } ?>
    </div>


</body>

</html>
<?php 
//  Get Weather Report On Email by mail Funtion
if(isset($_POST['get_weather_email'])){
      $location = $_POST['location'];
      $email = $_POST['email'];
      //  API kEY fOR the Weather Check  AAfter Login The Weather Api 
      $apiKey="8cdb7c7e6dfe4590b0a140614242810";
      // Full Link Agter Including Api Key And State And Date   
      $data = "http://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$location}";
        // Get Api Data Link With The File_get_contents funtion 
      $api = file_get_contents($data);
      // converting Data in to Json Format To get Data in Understanding And Array Format 
      $email_data = json_decode($api,true);
      if(empty($email_data["location"]["name"])){
        ?>
<script>
alert("This Is Not a City or Not a Country");
window.location.href("index.php");
session
</script>
<?php 
      }
    //   which person u want To send 
      $to = "$email";
				$subject = "Weather  Mail ";
				$message = "
					<html>
						<head>
							<title>Weather Email </title>
						</head>
						<body>
							<p>Weather Report</p>
							<table border='1' width='100%'>
								<tr>
									<th>Country </th>
									<td>" .$email_data["location"]["country"]. "</td>
								</tr>
                                <tr>
									<th>State </th>
									<td>" .$email_data["location"]["region"]. "</td>
								</tr>
                                <tr>
									<th>City </th>
									<td>" .$email_data["location"]["name"]. "</td>
								</tr>
								<tr>
									<th>Date & Time</th>
									<td>" . $email_data["location"]["localtime"] . "</td>
								</tr>
								<tr>
									<th>Temperature Celsius </th>
									<td>" . $email_data["current"]["temp_c"]  . "</td>
								</tr>
								<tr>
									<th>Condition</th>
									<td>" . $email_data["current"]["condition"]["text"] . "</td>
								</tr>
                                <tr>
									<th>Weather Wind Per kilo-meter</th>
									<td>" .$email_data["current"]["wind_kph"] . "</td>
								</tr>
                                <tr>
									<th>Weather Wind Degree</th>
									<td>" . $email_data["current"]["wind_degree"] . "</td>
								</tr>
                                <tr>
									<th>Humidity </th>
									<td>" . $email_data["current"]["humidity"] . "</td>
								</tr>

								
							</table>
                            <p>Today's weather brings a mix of sun and clouds with mild temperatures " .$email_data["current"]["temp_c"] . "gradually " . $email_data["current"]["condition"]["text"] . "as the day
                            progresses. Expect light southwest winds at" .$email_data["current"]["wind_mph"]. " mph, keeping the air pleasant and
                            refreshing. but there may be a slight increase in cloud cover by the
                            Day. Humidity will stay moderate at ". $email_data["current"]["humidity"]. "throughout the day, 
                            Visibility is excellent, so any outdoor activities should be enjoyable. The Day cools down
                            to " .$email_data["current"]["temp_f"]. "°F  under " .$email_data["current"]["condition"]["text"]. " on  The". $email_data["location"]["localtime"]." </p>
						</body>
					</html>
				";
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				if (mail($to, $subject, $message, $headers)) {
          ?>
<script>
alert("Email Send Successfully");
window.location.href("index.php");
session
</script>
<?php 
				}
				else {
          ?>
<script>
alert("Email Not Send Successfully");
window.location.href("index.php");
session
</script>
<?php 
				 
					
				}	
 
}
?>