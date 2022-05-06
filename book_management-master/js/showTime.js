function getDate() {
    /*
    创建日期对象，获取当前日期 时间 星期
     */
    var date = new Date();
    var year = date.getFullYear();
    var month = change(date.getMonth() + 1);
    var day = change(date.getDate());
    var hour = change(date.getHours());
    var minute = change(date.getMinutes());
    var second = change(date.getSeconds());

    var weekday = new Array(7);
    weekday[0] = "星期日";
    weekday[1] = "星期一";
    weekday[2] = "星期二";
    weekday[3] = "星期三";
    weekday[4] = "星期四";
    weekday[5] = "星期五";
    weekday[6] = "星期六";
    var d = weekday[date.getDay()];

    function change(t) {
        if (t < 10) {
            return "0" + t;
        } else {
            return t;
        }
    }

    var time = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second + ' ' + d;
    var times = document.getElementById("times");
    times.innerHTML = time;
}

//使用定时器每秒向span写入当前时间
setInterval("getDate()", 1000);