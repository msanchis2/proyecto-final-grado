<?php ob_start() ?>
<link rel="stylesheet" href="<?php echo 'css/'.Config::$mvc_c_css ?>">

<h1>Make your reservation</h1>

<div class="content">
    <div class="calendar-container">
      <div class="calendar">
        <div class="year-header">
          <span class="year" id="label"></span>
        </div>
        <table class="months-table">
          <tbody>
            <tr class="months-row">
              <td class="month">Jan</td>
              <td class="month">Feb</td>
              <td class="month">Mar</td>
              <td class="month">Apr</td>
              <td class="month">May</td>
              <td class="month">Jun</td>
              <td class="month">Jul</td>
              <td class="month">Aug</td>
              <td class="month">Sep</td>
              <td class="month">Oct</td>
              <td class="month">Nov</td>
              <td class="month">Dec</td>
            </tr>
          </tbody>
        </table>

        <table class="days-table">
          <td class="day">Sun</td>
          <td class="day">Mon</td>
          <td class="day">Tue</td>
          <td class="day">Wed</td>
          <td class="day">Thu</td>
          <td class="day">Fri</td>
          <td class="day">Sat</td>
        </table>
        <div class="frame">
          <table class="dates-table">
            <tbody class="tbody"></tbody>
          </table>
        </div>
        <div class="buttonaula">
          <?php 
            foreach($params as $name){
              $name=$name['IdAula'];
              if($name==0){
                $value="Assembly hall";
              }
              else{
                $value=$name;
              }
              echo '<input type="button" class="button aula" value="'.$value.'" name="'.$name.'">';
            }
          ?>
        </div>
      </div>
    </div>
    <div class="events-container">
      <div class='event-card'>
        <div class='event-hour'>7:55</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>8:50</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>9:45</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>11:00</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>11:55</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>12:50</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>14:05</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>15:00</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>15:55</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>16:50</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>18:05</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>19:00</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>19:55</div>
        <button class="button">Add Event</button>
      </div>
      <div class='event-card'>
        <div class='event-hour'>21:15</div>
        <button class="button">Add Event</button>
      </div>
    </div>
  </div>
  <!-- Dialog Box-->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="../web/js/calendarioscript.js"></script>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>