/**
 * 给修改，删除项添加事件
 */
var table = document.getElementsByTagName("table")[0];
var set = table.rows[0].cells.length - 2;    //修改列下标
var operation = table.rows[0].cells.length - 1;    //删除列下标

for (let i = 1; i < table.rows.length; i++) {
    //修改设置
    table.rows[i].cells[set].onclick = function () {
        var id = table.rows[i].cells[0].innerHTML;
        var name = table.rows[i].cells[1].innerHTML;
        // alert(set);
        var iLeft = (window.screen.availWidth - 30 - 960) / 2;           //获得窗口的水平位置;
        if (set == 3) {
            window.open('../action/resetReader.php?user='+name+'&recordId=' + id + '', '', 'left=' + iLeft + ',width=960,height=150');
        }
        if (set == 8) {
            window.open('../action/resetBook.php?name='+name+'&recordId=' + id + '', '', 'left=' + iLeft + ',width=960,height=260');
        }
    }
    //删除
    table.rows[i].cells[operation].onclick = function () {
        var id = table.rows[i].cells[0].innerHTML;
        // alert(operation);
        var iLeft = (window.screen.availWidth - 30 - 960) / 2;           //获得窗口的水平位置;
        // window.open('../action/delete.php?from=management&userId=' + i + '');
        if (operation == 4) {
            window.location.href = '../action/delete.php?from=readerRecord&recordId=' + id + '';
        }
        if (operation == 9) {
            window.location.href = '../action/delete.php?from=bookRecord&recordId=' + id + '';
        }

    }
}


