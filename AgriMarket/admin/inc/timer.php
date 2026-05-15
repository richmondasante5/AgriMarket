<?php 

$_SESSION['timer']="expired_session";

 ?>

<script>
      function activityWatcher(){
        var secondsSinceLastActivity = 0;
        var maxInactivity=(60*30);
        setInterval(function(){
            secondsSinceLastActivity++;
            console.log(secondsSinceLastActivity + ' seconds since the user was last active');
            if(secondsSinceLastActivity > maxInactivity){
               console.log('User has been inactive for more than ' + maxInactivity + ' seconds');
                location.href = 'login.php';
            }
        }, 1000);
        //The function that will be called whenever a user is active
        function activity(){
            secondsSinceLastActivity = 0;
        }
        var activityEvents = [
            'mousedown', 'mousemove', 'keydown',
            'scroll', 'touchstart'
        ];
        activityEvents.forEach(function(eventName){
            document.addEventListener(eventName, activity, true);
        });
      }
      activityWatcher();
  </script>
  