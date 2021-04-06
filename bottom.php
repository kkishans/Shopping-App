<div class="mt-5 pt-5"></div>
<?php
    $query = "SELECT facebook_link, insta_link, twitter_link, youtube_link from admin_details LIMIT 1";
    $a_res = mysqli_query($conn,$query);

    if (mysqli_num_rows($a_res)) {
        $data = mysqli_fetch_assoc($a_res);
        $facebook = $data['facebook_link'];
        $insta = $data['insta_link'];
        $twitter = $data['twitter_link'];
        $youtube = $data['youtube_link'];
    }
?>
<div class="footer  ">
<div class="row text-center py-2">

    <div class="copyright-text col-xl-4 col-md-11 col-sm-12">
      <p>Copyright © 2021 Pooja Electricals, All rights reserved.</p>
    </div>
    <div class="copyright col-xl-3 col-md-11 col-sm-12">
    
        <?php 
            if ($facebook != "") {
                echo "<a href='$facebook' target='_blank'> <i class='fa fa-facebook facebook'></i></a>";
            }
            if ($insta != "") {
                echo "<a href='$insta' target='_blank'> <i class='fa fa-instagram insta'></i></a>";
            }
            if ($twitter != "") {
                echo "<a href='$twitter' target='_blank'> <i class='fa fa-twitter twitter'></i></a>";
            }
            if ($youtube != "") {
                echo "<a href='$youtube' target='_blank'> <i class='fa fa-youtube youtube'></i></a>";
            }
        ?>
    </div>
</div>
</div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html