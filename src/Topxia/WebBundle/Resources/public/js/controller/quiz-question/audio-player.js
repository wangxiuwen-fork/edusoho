define(function(require, exports, module) {

    require('mediaelementplayer');

    var Notify = require('common/bootstrap-notify');

    var audioPlayers = [];

    $('body').on('click', '.audio-paly-trigger', function() {
        var $this = $(this);

        var fileId = $this.data('fileId');
        var orgHtml = $this.html();

        $this.html('正在载入音频...');

        $.get('/question_ajax/file_url', {id:fileId}, function(response) {
            if (response.status == 'waiting') {
                Notify.warning(response.message);
                $this.html(orgHtml);
                return ;
            }

            if (response.status == 'error') {
                Notify.danger(response.message);
                $this.html(orgHtml);
                return ;
            }

            if (response.status != 'ok') {
                Notify.danger('音频载入失败，请重试。');
                $this.html(orgHtml);
                return ;
            }

            var id = 'audio-player-' + audioPlayers.length;
            $this.replaceWith('<audio id="' + id + '" style="display:inline-block;width:400px;height:30px;"></audio>');

            var audioPlayer = new MediaElementPlayer('#' + id, {
                type: ['audio/mp3'],
                mode:'auto_plugin',
                enablePluginDebug: false,
                enableAutosize:true,
                success: function(media) {
                    var sources = [
                        { src: response.url, type: 'audio/mp3' }
                    ];
                    media.setSrc(sources);
                    media.load();
                    media.play();
                }
            });

            audioPlayers.push(audioPlayer);

        }, 'json');


    });

    $("#modal").on('hidden.bs.modal', function(){
        $.each(audioPlayers, function(i, audioPlayer) {
            audioPlayer.remove();
        });
    });

    module.exports = audioPlayers;

});