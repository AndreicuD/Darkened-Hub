var date = new Date("Dec 13, 2024 19:00:00")
var countDownDate = date.getTime();
document.getElementById("date").innerHTML = date.toDateString();
document.getElementById("date").innerHTML += " - " + date.getHours() + ":";
if(date.getMinutes>9) document.getElementById("date").innerHTML += date.getMinutes();
else document.getElementById("date").innerHTML += "0" + date.getMinutes();
// Update the count down every 1 second
getTime();
setInterval(getTime, 1000);

function getTime() {
    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("clock").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";

    // If the count down is finished, write some text
    if (distance < 0) {
        document.getElementById("clock").innerHTML = "Please wait while we announce the next concert";
        document.getElementById("clock").style = "font-size: 2vw;";
        document.getElementById("date").style = "display:none;";
    }
}