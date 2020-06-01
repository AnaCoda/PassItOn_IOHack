// This sorts the cards by how long ago they were posted
// By reading the number of minutes from the HTML tags and then sorting them
// TODO: This doesn't really work unless I hardcode values because I haven't implemented timing
$('#btnSort').click(function() {
    $('.card-deck .card').sort(function(a, b) {
        return $(a).find(".card-title").text() < $(b).find(".card-title").text() ? 1 : -1;
    }).appendTo(".card-deck");
})