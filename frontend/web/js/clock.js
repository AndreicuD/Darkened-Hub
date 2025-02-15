var date;
if(document.getElementById('concert_time')) {
    setDate(document.getElementById('concert_time').innerText);
}
if(date == null) no_concert();
else {
    if(document.getElementById("date")) {
        document.getElementById("date").innerHTML = date.toDateString();
        document.getElementById("date").innerHTML += " - " + date.getHours() + ":";
        if(date.getMinutes()>9) document.getElementById("date").innerHTML += date.getMinutes();
        else document.getElementById("date").innerHTML += "0" + date.getMinutes();
    }
    // Update the count down every 1 second
    getTime();
    setInterval(getTime, 1000);
}

//-----------------------------------------------

function getTime() {
    const get_date = updateDate();
    if (!get_date) {
        no_concert();
        return;
    }

    // Get today's date and time
    const countDownDate = get_date.getTime();
    const now = new Date().getTime();

    // Find the distance between now and the count down date
    const distance = countDownDate - now;

    // Time calculations for days, hours, minutes, and seconds
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="clock"
    if(document.getElementById("clock")) {
        document.getElementById("clock").innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
    }

    // If the count down is finished
    if (distance < 0) {
        no_concert();
    }
}

function setDate(string) {
    console.log('timp setat');
    if (string) {
        date = new Date(string);
        if(document.getElementById("date")) {
            document.getElementById("date").style = "display:block;";
        }
    } else {
        date = null;
    }
}

// Update the original JavaScript logic to handle a null `date`
function updateDate() {
    return date ? new Date(date) : null;
}

function no_concert() {
    if(document.getElementById("date")) {
        document.getElementById("date").style = "display:none;";
    }
    if(document.getElementById("clock")) {
        document.getElementById("clock").innerHTML = "Următorul concert nu a fost încă anunțat.";
        document.getElementById("clock").style = "font-size: 2rem;";
    }
}