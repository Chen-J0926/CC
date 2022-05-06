<?php
/**
 * @param $title    表头数组
 * @return string   表头表格
 */
function createHeader($title)
{
    $header = "<tr>";
    foreach ($title as $c) {
        $header = $header . "<th>" . $c . "</th>";
    }
    $header = $header . "</tr>";
    echo $header;
}

/**
 * @param $date     要显示数据的数组
 * @return string
 */
function showDate($date)
{
    $showDate = "<tr>";
    foreach ($date as $c) {
        $showDate = $showDate . "<td>" . $c . "</td>";
    }
    $showDate = $showDate . "</tr>";

    echo $showDate;
}

function checkData($data,$disabled)
{
    $showData = "<tr>";
    $i=0;       //input标识
    foreach ($data as $datum) {

        if (!is_numeric($datum)){
            $showData = $showData . "<td class='reactor' >" . $datum . "</td>";
//            echo $datum;
            continue;
        }
        $check = $datum==1? "checked":"";
        if ($disabled==-1){ //是否可以编辑
            $disabled = "";
        }elseif($disabled==-2){
            $disabled = "disabled";
        }
        $showData = $showData . "<td><input type='checkbox' ".$check."  ".$disabled." name='check".$i."'></td>";
        $i++;
    }
    $showData = $showData . "</tr>";

    echo $showData;
}

