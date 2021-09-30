// navbar change colour on scroll
$(function () {
  $(document).scroll(function () {
    var $nav = $(".bg-light");
    $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
  });
});
var element = document.getElementById("next_event");
if (element) {
  var myInput = element.value;
  // Set the date we're counting down to
  var countDownDate = new Date(myInput).getTime();
  // Update the count down every 1 second
  var x = setInterval(function () {
    // Get today's date and time
    var now = new Date().getTime();
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    // Output the result in an element with id="demo"
    document.getElementById("days").innerHTML = (days < 10 ? "0" : "") + days;
    document.getElementById("hours").innerHTML =(hours < 10 ? "0" : "") + hours;
    document.getElementById("minutes").innerHTML =(minutes < 10 ? "0" : "") + minutes;
    document.getElementById("seconds").innerHTML =(seconds < 10 ? "0" : "") + seconds;
  }, 1000);
}

