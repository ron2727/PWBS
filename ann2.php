<?php
    include("functions2.php");

?>
<?php 

require 'functions.php';

if(!is_logged_in())
{
  redirect('login.php');
}

$id = $_GET['id'] ?? $_SESSION['PROFILE']['id'];

$row = db_query("select * from users where id = :id limit 1",['id'=>$id]);

if($row)
{
  $row = $row[0];
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/default-skin/default-skin.min.css'><link rel="stylesheet" href="./css/ann2.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="./js/ann.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head> 
    

    <title>Home</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  </head>

  <body>
  
    <br><br>  <br> <br>
  
    <div id='calendar'></div>

<div id="calendar-popup">
 
  <form id="event-form">
     <div class='calander_popip_title'><i class="fa fa-calendar" aria-hidden="true"></i>
Add Event</div>
    <ul>
      <li>
        <label for="event-start"><i class="fa fa-bell-o" aria-hidden="true"></i>

From</label>
        <input id="event-start"  class='form-control' type="datetime-local" name="start"/>
      </li>
      <li>
        <label for="event-end"><i class="fa fa-bell-slash" aria-hidden="true"></i>

To</label>
        <input id="event-end"  class='form-control' type="datetime-local" name="end"/>
      </li>
      <li>
        <label for="event-title"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
Event Name</label>
        <input id="event-title"  class='form-control' type="text" name="title"/>
      </li>
      <li>
        <label for="event-location"><i class="fa fa-map-marker" aria-hidden="true"></i>
Location</label>
        <input id="event-location"   class='form-control' type="text" name="location"/>
      </li>
      <li>
        <label for="event-details"><i class="fa fa-info-circle" aria-hidden="true"></i>
Description</label>
        <textarea id="event-details"  class='form-control' name="details"></textarea>
      </li>
      <div class="button">
        <input type="submit"  class='form-control submit_btn'/>
      </div>
    </ul>
  </form>
  
  <div id="event">
    <header></header>
    <ul>
    <li class="start-time"> 
      <p>
  Start at</p>
        <time></time>
      </li>
       <li class="end-time">
      <p>
 End</p>
        <time></time>
      </li>
      <li>
        <p>
          <i class="fa fa-map-marker" aria-hidden="true"></i>Location</p>
<p class="location"></p>
      </li>
      <li>
        <p><i class="fa fa-info" aria-hidden="true"></i>
Details:</p>
        <p class="details"></p>
      </li>
    </ul>
   
  </div>

  <div class="prong">
    <div class="bottom-prong-dk"></div>
    <div class="bottom-prong-lt"></div>
  </div>
</div>


<div class='modle' id='simplemodal'>
  <div class='modle-continer'>
      <form id="edit-form">

    <div class='modal-header'>
        <span class='close-btn' id='close-btnid'>&times</span>
      <h2>Edit Event</h2>
    </div>
   <div class='modal-body'>
  
     <lable for='eventname'>Event Name</lable>
     <input type='text' name='eventname' id='eventname' class='form-control'>
     <lable for='location'>Location</lable>
     <input type='text' name='location' id='location' class='form-control'>
     
     <label for="event-start">From</label><input id="eventstart" type="datetime-local" name="start" class='form-control'/>
     
     <label for="event-end">To</label>
        <input id="eventend" type="datetime-local" name="end" class='form-control'/>
      <label for="event-details">Details</label>
     <textarea id="eventdetails" type='text' name="details"  class='form-control'></textarea>
    
    </div>
    <div class='modal-footer'>
      <button type='submit' class='btn btn-info'>save</button>
      <button class='btn btn-dafault'>cancel</button>
      
    </div>
    </form>
  </div>
  
</div>

<div id='search_result'>result</div>
<button class='btn btn-primary'>Add Events</button>
<!-- partial -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.0/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script><script  src="./js/ann.js"></script>

</body>
</html>
