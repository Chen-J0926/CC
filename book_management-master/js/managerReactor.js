/**
 * 给权限设置和操作列添加事件
 */
var table = document.getElementById("content");
var set = table.rows[0].cells.length - 2;    //设置列下标
var operation = table.rows[0].cells.length - 1;    //操作列下标

for (let i = 1; i < table.rows.length; i++) {
    //权限设置
    table.rows[i].cells[set].onclick = function () {
        var iLeft = (window.screen.availWidth - 30 - 960) / 2;           //获得窗口的水平位置;
        window.open('../action/resetManager.php?userId=' + i + '', '', 'left=' + iLeft + ',width=960,height=100');
    }
    //删除
    table.rows[i].cells[operation].onclick = function () {
        var iLeft = (window.screen.availWidth - 30 - 960) / 2;           //获得窗口的水平位置;
        // window.open('../action/delete.php?from=management&userId=' + i + '');
        window.location.href = '../action/delete.php?from=management&userId=' + i + '';
    }
}


