function initLineChannel(url, adName, adUrl) {
    var $line = $("#Info p.line");
    $.ajax({
        "url": url,
        "type": "get",
        "dataType": "json",
        "success": function (channels) {
            if (channels) {
                var html = "";
                $.each(channels, function (index, channel) {
                    var chId = channel.ch_id;
                    var name = channel.name;
                    var type = channel.type;
                    var player = channel.player;
                    var link = "";
                    if (player == 11) {
                        link = '/live/iframe/player-' + chId +  '-' + type + '.html';
                    } else {
                        link = '/live/player/player-' + chId +  '-' + type + '.html';
                    }
                    //var onclick = "onclick=\"ChangeChannel('" + link + "', this)\"";
                    //html += "<button id=\"" + chId + "\" " + onclick + " >" + name + "</button>";
                    var url = window.LHB_URL + link;
                    html += "<a href='" + url + "' target='_blank'>" + name + "</a>";
                });
                if (adName) {
                    html += "<a href=\"" + adUrl + "\" target=\"_blank\" style=\"border-color: #d24545; background: #d24545; color: #fff;\">" + adName + "</a>";
                }
                if (html != "") {
                    $line.html(html);
                }
            }
            LoadVideo();
        },
        "error": function () {
            LoadVideo();
        }
    });
}