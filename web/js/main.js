fixClub = {
    load: function() {
        fixClub.setClubHeight();
    },
    resize: function() {
        //fixClub.setClubHeight();
    },
    setClubHeight: function() {
        console.log($(document).height());
        var topHeight = $(document).height() - 270;
        $('.top-club .cells').height(topHeight);
    }
}

$(document).ready(fixClub.load);
$(window).resize(fixClub.resize);