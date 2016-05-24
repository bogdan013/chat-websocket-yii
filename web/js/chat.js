        $(function(){
            document.cookie = '';
            function wsStart() {
                ws = new WebSocket("ws://127.0.0.1:8004/userId=" + Math.round(Math.random()*10000));
                ws.onopen = function() { $("#chat").append("<p>система: соединение открыто</p>"); };
                ws.onclose = function() { $("#chat").append("<p>система: соединение закрыто, пытаюсь переподключиться</p>"); setTimeout(wsStart, 1000);};
                ws.onmessage = function(evt) { $("#chat").append("<p>"+evt.data+"</p>"); $('#chat').scrollTop($('#chat')[0].scrollHeight);};
            }
            wsStart();
            $('#chat').height($(window).height() - 80);
            $('#input').focus();
        });