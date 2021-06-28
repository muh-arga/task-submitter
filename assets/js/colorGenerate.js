$(document).ready(function() {
    $("a.card-block div.card-subject").each(function() {
        let colors = ["#fad2e1", "#f2d2fa", "#d7d2fa", "#d2e3fa", "#d2fae3", "#d8fad2", "#eefad2", "#faecd2", "#fadcd2"];

        var x = Math.floor((Math.random() * 10));
        var color = colors[x];

        $(this).css("background.color", color);
    });
});