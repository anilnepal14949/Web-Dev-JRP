var countDownDate = new Date("Jan 01, 2023 00:00:00").getTime();

var countInterval = setInterval(function() {
    // var now = new Date("Jan 02, 2023").getTime();
    var now = new Date().getTime();
    var timeLeft = countDownDate - now;
    document.getElementById('countdown').style.display = 'block';
    if (timeLeft < 0) {
        clearInterval(countInterval);
        document.getElementById('countdown').classList.add("finished");
        document.getElementById('countdown').innerHTML = "<h3 class='finished'> HAPPY NEW YEAR!!! </h3>";
    } else {
        var millisecondsInDay = (1000 * 60 * 60 * 24); 
        var millisecondsInHour = (1000 * 60 * 60);
        var millisecondsInMinute = (1000 * 60);
        var millisecondsInSecond = 1000;
        
        var days = Math.floor(timeLeft / millisecondsInDay);
        var hours = Math.floor((timeLeft % millisecondsInDay) / (millisecondsInHour));
        var minutes = Math.floor((timeLeft % millisecondsInHour) / (millisecondsInMinute));
        var seconds = Math.floor((timeLeft % millisecondsInMinute) / millisecondsInSecond);

        // Result is output to the specific element
        document.getElementById("days").innerHTML = (days < 10) ? "0"+days : days;
        document.getElementById("hours").innerHTML = (hours < 10) ? "0"+hours : hours; 
        document.getElementById("mins").innerHTML = (minutes < 10) ? "0"+minutes : minutes; 
        document.getElementById("secs").innerHTML = (seconds < 10) ? "0"+seconds : seconds; 
    }
}, 1000);