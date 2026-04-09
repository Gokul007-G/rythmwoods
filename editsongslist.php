<!DOCTYPE html>
<html lang="en">
<style>
  .form-group input[type="checkbox"] {
    margin-left: 25px;
  }

  .btn .btn-danger:hover {
    background: lightgoldenrodyellow;
  }

  #label11 {
    font-size: 25px;
    font-weight: 500;

  }

  #songname {
    font-size: 22px;
    font-weight: 500;
  }

  /* === BASE HEADING === */

  h1 {
    position: relative;
    padding: 0;
    margin: 0;
    font-family: "Raleway", sans-serif;
    font-weight: 300;
    font-size: 40px;
    color: #080808;
    -webkit-transition: all 0.4s ease 0s;
    -o-transition: all 0.4s ease 0s;
    transition: all 0.4s ease 0s;
  }

  h1 span {
    display: block;
    font-size: 0.5em;
    line-height: 1.3;
  }

  h1 em {
    font-style: normal;
    font-weight: 600;
  }

  /* Style 7
   ----------------------------- */
  .seven h1 {
    text-align: center;
    font-size: 30px;
    font-weight: 600;
    color: deeppink;
    letter-spacing: 1px;
    text-transform: uppercase;
    display: grid;
    grid-template-columns: 1fr max-content 1fr;
    grid-template-rows: 27px 0;
    grid-gap: 20px;
    align-items: center;
  }

  .seven h1:after,
  .seven h1:before {
    content: " ";
    display: block;
    border-bottom: 1px solid #c50000;
    border-top: 1px solid #c50000;
    height: 5px;
    background-color: #f8f8f8;
  }

  .buttonadd {
    width: 80px;
    border: none;
    border-radius: 8px;
    background: #33cc33;
    color: white;
    margin: 0 43px;
  }

  .buttonadd:hover {
    width: 80px;
    border: none;
    border-radius: 8px;
    background: green;
    color: white;
    margin: 0 43px;
  }
</style>

<body>
  <form action="addsonginsert.php" method="post" autocomplete="off">
    <?php
    require("./connect.php");
    $id = $_REQUEST['id'];
    //echo $id.'kokok';
    $query11 = $con->query("select * from `daily_event` where id='$id'");
    $eventdata = $query11->fetch();
    $eventid = $eventdata['id'];
    $conceptname = $eventdata['title'];
    $date = $eventdata['date'];
    $time = $eventdata['time'];
    ?>
    <div class="container">
      <div class="card card-pink">
        <div class="card-header">
          <h3 class="card-title">
            <font size="5"><b> UPDATE SONGSLIST</b></font>
          </h3>
          <a onclick="return_back()" style="float:right;margin-top:-5px;background:lightyellow;color:black" data-toggle="modal" class="btn btn-danger"></i>Back</a>
        </div>
        <br>
        <input type="hidden" id="eventid" name="eventid" value="<?php echo $eventid; ?>">
        <input type="hidden" id="eventname" name="eventname" value="<?php echo $conceptname; ?>">
        <input type="hidden" id="eventdate" name="eventdate" value="<?php echo $date; ?>">
        <input type="hidden" id="eventtime" name="eventtime" value="<?php echo $time; ?>">
        <div style="display:flex;justify-content: space-around;">
          <label id="label11"><span style="font-weight:600;color:orange;">EVENT NAME:</span><?php echo strtoupper($conceptname); ?></label>
          <label id="label11"><span style="font-weight:600;color:orange;">DATE:</span><?php echo $date; ?></label>
          <label id="label11"><span style="font-weight:600;color:orange;">TIME:</span><?php echo $time; ?></label>
        </div>
        <br>
        <div class="seven">
          <h1>
            <font size="5"><b>SONGS LIST</b></font>
          </h1>
        </div>
        <?php
        $sql1 = $con->query("SELECT * FROM song_master");
        while ($row = $sql1->fetch()) {
          $songId = $row['id'];
          $songTitle = $row['title'];

          // Retrieve rows from addsongsinevent for the specified event
          $sql2 = $con->query("SELECT * FROM addsongsinevent WHERE eventid='$id' AND songslistid='$songId'");

          // Check if the song is part of the event
          $isChecked = $sql2->rowCount() > 0;
        ?>
          <div class="form-group">
            <input type="checkbox" name="selectedSongs[]" value="<?php echo $songId; ?>" <?php echo $isChecked ? 'checked' : ''; ?>>
            <label id="songname"><?php echo ucfirst($songTitle); ?></label>
          </div>
        <?php
        }
        ?>
        <?php
        ?>
        <button type="submit" class="buttonadd">Update</button>
        <br>
      </div>
  </form>

  <script>
    function return_back()
    var rightcontent = $("#rightcontent").hide();
    {
      $.ajax({
        type: "GET",
        url: "/rythm/professional_singer/calendar/calendar_form.php",
        success: function(data) {

          $("#centerconteid").css("marginLeft", "450px");
          $("#centerconteid").html(data);
        }
      })
    }
  </script>
</body>

</html>