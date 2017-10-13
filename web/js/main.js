fixClub = {
    visitors: {},
    playlist: {},
    currentSong: 0,
    activeTrigger: false,
    initTimeout: false,
    load: function() {
        fixClub.setClubHeight();
        fixClub.setTriggers();
        fixClub.getSavedData();
    },
     getSavedData: function() {
        this.getSavedDancers();
        this.getSavedPlaylist();
    },
    getSavedDancers: function() {
        $.ajax({
            url: '/site/get_visitors',
            dataType: 'json',
            success: function(msg) {
                fixClub.setVisitors(msg);
            }
        });
    },
    getSavedPlaylist: function() {
        $.ajax({
            url: '/site/get_playlist',
            dataType: 'json',
            success: function(msg) {
                fixClub.setPlaylist(msg);
            }
        });
    },
    setTriggers: function() {
        $('button.add-dancers').on('click', this.getDancersWindow);
        $('button.add-songs').on('click', this.getSongsWindow);
        $('button.prev-song').on('click', this.prevSong);
        $('button.next-song').on('click', this.nextSong);
    },
    setVisitors: function(visitors) {
        for (vId in visitors) {
            this.visitors[vId] = visitors[vId];
        }
        this.renderDancers();
    },
    setPlaylist: function(songs) {
        var hasSongs = false;

        for (pId in songs) {
            this.playlist[pId] = songs[pId];
            hasSongs = true;
        }

        if (!this.currentSong && hasSongs) {
            this.playSong();
        }
    },
    playSong: function() {
        $('div.buttons').hide();
        $('div.player').show();
        this.initTimeout = setInterval('fixClub.changeMovement()', 1000);
        this.nextSong();
    },
    nextSong: function() {
        fixClub.selectSong('next');
    },
    prevSong: function() {
        fixClub.selectSong('prev')
    },
    selectSong: function(direction) {
        $.ajax({
            url: '/site/select_song',
            method: 'post',
            data: {currentSong: this.currentSong, direction: direction},
            success: function(msg) {
                fixClub.changeSong(msg);
            }
        });
    },
    changeSong: function(songId) {
        this.currentSong = songId;
        selectedSong = this.playlist[songId];
        $('.now-play').html(selectedSong.name);
        this.renderDancers();
    },
    changeMovement: function() {
        var movements = this.playlist[this.currentSong]['movements'];
        var randMovement = this.getRandom(0, movements.length - 1);
        $('.active_dancer span.action').html(movements[randMovement]);
    },
    getRandom: function(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    },
    renderDancers: function() {
        var minTop = $('.top-club .dancezone').offset().top;
        var maxTop = $('.top-club .dancezone').height() - 100;
        var minLeft = $('.top-club .dancezone').offset().left;
        var maxLeft = $('.top-club .dancezone').width() - 50;

        for (dId in this.visitors) {
            var dancer = this.visitors[dId];
            if (!dancer.view) {
                $('.top-club .dancezone').append('<span class="dancer" id="dancer_' + dId + '"><img src="/images/' + dancer.sex + '-dancer.png" /><br /><span class="action"></span></span>');
                var dTop = this.getRandom(minTop, maxTop);
                var dLeft = this.getRandom(minLeft, maxLeft);
                $('#dancer_' + dId).css({top: dTop + 'px', left: dLeft + 'px'})
                this.visitors[dId]['view'] = 1;
            }

            if (this.currentSong) {
                var nowPlay = this.playlist[this.currentSong];

                if (dancer.skills[nowPlay.style]) {
                    $('#dancer_' + dId).addClass('active_dancer');
                } else {
                    $('#dancer_' + dId).removeClass('active_dancer');
                    $('#dancer_' + dId + ' span.action').html('Пьёт водку');
                }
            }
        }
    },
    getDancersWindow: function() {
        fixClub.openDancersWindow(undefined);
    },
    openDancersWindow: function(data) {
        fixClub.getWindow('Добавить персонажей', '/site/dancer_form', fixClub.triggerDancers, data);
    },
    getSongsWindow: function() {
        fixClub.openSongsWindow(undefined);
    },
    openSongsWindow: function(data) {
        fixClub.getWindow('Сформировать плейлист', '/site/playlist_form', fixClub.triggerPlaylist, data);
    },
    triggerDancers: function() {
        $('.modal-footer .btn-primary').off('click');
        $('#modal_window .modal-body form').on('submit', function(){return false})
        $('.modal-footer .btn-primary').on('click', function() {
            $('#modal_window .modal-body form').submit();
        });

        $('#modal_window .modal-body form').on('afterValidate', fixClub.activeFormSubmit);
        fixClub.activeTrigger = fixClub.openDancersWindow;
    },
    triggerPlaylist: function() {
        $('.modal-footer .btn-primary').off('click');
        $('#modal_window .modal-body form').on('submit', function(){return false})
        $('.modal-footer .btn-primary').on('click', function() {
            $('#modal_window .modal-body form').submit();
        });

        $('#modal_window .modal-body form').on('afterValidate', fixClub.activeFormSubmit);
        fixClub.activeTrigger = fixClub.openSongsWindow;
    },
    getWindow: function(title, url, trigger, post) {
        $('#modal_window').modal('show');
        $('#modal_window .modal-title').html(title);
        $('.modal-footer .btn-primary').show();

        var ajaxData = {
            url: url,
            success: function(msg) {
                $('#modal_window .modal-body').html(msg);
                trigger();
            }
        };

        if (typeof(post) != 'undefined') {
            ajaxData['method'] = 'POST';
            ajaxData['data'] = post;
        }

        $.ajax(ajaxData);
    },
    setClubHeight: function() {
        var topHeight = $(document).height() - 270;
        $('.top-club .cells').height(topHeight);
    },
    activeFormSubmit: function(event, fields, errors) {
        var form = $('#modal_window .modal-body form');
        var data = {};
        checkboxes = {};

        for (fieldId in fields) {
            var fieldName = $('#' + fieldId).attr('name');
            var fieldType = $('#' + fieldId).attr('type');

            if ($('#' + fieldId).find('input').size()) {
                fieldName = $('#' + fieldId).prev('input[type=hidden]').attr('name');
                fieldValue = {};

                $('#' + fieldId).find('input').each(function(){
                    var subtype = $(this).attr('type');

                    if (subtype == 'checkbox' && this.checked) {
                        if (typeof(checkboxes[fieldName]) == 'undefined') {
                            checkboxes[fieldName] = 0;
                        } else {
                            checkboxes[fieldName]++;
                        }


                        fieldValue[checkboxes[fieldName]] = $(this).val();
                    }
                });
            } else {
                var fieldValue = $('#' + fieldId).val();
            }

            data[fieldName] = fieldValue;
        }

        if (fixClub.activeTrigger) {
            fixClub.activeTrigger(data);
        }
    }
}

$(document).ready(fixClub.load);