<?php

// 60 nguyên âm có dấu đi kèm

function vna_acc_char_array()
{ // mảng nguyên âm đơn có dấu, mã hóa hex phổ thông, gồm 60 ký tự

    $acc = array("á", "à", "ả", "ã", "ạ", "ắ", "ằ", "ẳ", "ẵ", "ặ", "ấ", "ầ", "ẩ", "ẫ", "ậ", "é", "è", "ẻ", "ẽ", "ẹ", "ế", "ề", "ể", "ễ", "ệ", "ó", "ò", "ỏ", "õ", "ọ", "ố", "ồ", "ổ", "ỗ", "ộ", "ờ", "ớ", "ở", "ỡ", "ợ", "ú", "ù", "ủ", "ũ", "ụ", "ứ", "ừ", "ử", "ữ", "ự", "ý", "ỳ", "ỷ", "ỹ", "ỵ", "í", "ì", "ỉ", "ĩ", "ị");



    return $acc;
}



function pop_hex_convert($strx)
{ // chuyển từ mã hóa hex ít phổ biến sang mã hóa phổ biến hơn dành cho ký tự thường

    $str2 = trim($strx, ' '); // bỏ khoảng trắng trước và sau chuỗi

    $str3 = preg_replace('/\s+/', ' ', $str2); // loại bỏ khoảng trắng thừa trong chuỗi, chỉ giữ lại một khoảng trắng giữa các từ

    $str = mb_strtolower($str3, 'UTF-8'); // chuyển tất cả thành ký tự thường



    $phothong = array();  // tạo mảng chữ cái mã hóa phổ biến

    $itdung = array();  //tạo mảng chữ cái mã hóa ít dùng



    // Vần y



    $phothong[0] = 'ỵ';
    $itdung[0] = 'ỵ';



    // Vần a thường xong



    $phothong[1] = 'á';
    $itdung[1] = 'á';



    $phothong[2] = 'à';
    $itdung[2] = 'à';



    $phothong[3] = 'ả';
    $itdung[3] = 'ả';



    $phothong[4] = 'ã';
    $itdung[4] = 'ã';



    $phothong[5] = 'ạ';
    $itdung[5] = 'ạ';



    // ///////////////////////////



    // Vần ă thường xong



    $phothong[6] = 'ắ';
    $itdung[6] = 'ắ';



    $phothong[7] = 'ằ';
    $itdung[7] = 'ằ';



    $phothong[8] = 'ẳ';
    $itdung[8] = 'ẳ';



    $phothong[9] = 'ẵ';
    $itdung[9] = 'ẵ';



    $phothong[10] = 'ặ';
    $itdung[10] = 'ặ';



    /////////////////////////////



    // Vần â thường xong



    $phothong[11] = 'ấ';
    $itdung[12] = 'ấ';



    $phothong[12] = 'ầ';
    $itdung[11] = 'ầ';



    $phothong[13] = 'ậ';
    $itdung[13] = 'ậ';



    $phothong[14] = 'ẩ';
    $itdung[14] = 'ẩ';



    $phothong[15] = 'ẫ';
    $itdung[15] = 'ẫ';





    /////////////////////



    // Vần e thường xong



    $phothong[16] = 'é';
    $itdung[16] = 'é';



    $phothong[17] = 'è';
    $itdung[17] = 'è';



    $phothong[18] = 'ẻ';
    $itdung[18] = 'ẻ';



    $phothong[19] = 'ẽ';
    $itdung[19] = 'ẽ';



    $phothong[20] = 'ẹ';
    $itdung[20] = 'ẹ';





    // ////////////////////////



    // Vần ê thường xong



    $phothong[21] = 'ế';
    $itdung[21] = 'ế';



    $phothong[22] = 'ề';
    $itdung[22] = 'ề';



    $phothong[23] = 'ể';
    $itdung[23] = 'ể';



    $phothong[24] = 'ễ';
    $itdung[24] = 'ễ';



    $phothong[25] = 'ệ';
    $itdung[25] = 'ệ';





    // //////////////////////



    // Vần o thường xong



    $phothong[26] = 'ó';
    $itdung[26] = 'ó';



    $phothong[27] = 'ò';
    $itdung[27] = 'ò';



    $phothong[28] = 'ỏ';
    $itdung[28] = 'ỏ';



    $phothong[29] = 'õ';
    $itdung[29] = 'õ';



    $phothong[30] = 'ọ';
    $itdung[30] = 'ọ';



    // ////////////////



    // Vần ô thường xong



    $phothong[31] = 'ố';
    $itdung[31] = 'ố';



    $phothong[32] = 'ồ';
    $itdung[32] = 'ồ';



    $phothong[33] = 'ổ';
    $itdung[33] = 'ổ';



    $phothong[34] = 'ỗ';
    $itdung[34] = 'ỗ';



    $phothong[35] = 'ộ';
    $itdung[35] = 'ộ';



    // //////////////////////



    // Vần ơ thường xong



    $phothong[36] = 'ớ';
    $itdung[36] = 'ớ';



    $phothong[37] = 'ờ';
    $itdung[37] = 'ờ';



    $phothong[38] = 'ở';
    $itdung[38] = 'ở';



    $phothong[39] = 'ỡ';
    $itdung[39] = 'ỡ';



    $phothong[40] = 'ợ';
    $itdung[40] = 'ợ';



    // ////////////////////



    // Vần i thường xong



    $phothong[41] = 'í';
    $itdung[41] = 'í';



    $phothong[42] = 'ì';
    $itdung[42] = 'ì';



    $phothong[43] = 'ỉ';
    $itdung[43] = 'ỉ';



    $phothong[44] = 'ĩ';
    $itdung[44] = 'ĩ';



    $phothong[45] = 'ị';
    $itdung[45] = 'ị';



    // // //////////////////



    // Vần u thường xong



    $phothong[46] = 'ú';
    $itdung[46] = 'ú';



    $phothong[47] = 'ù';
    $itdung[47] = 'ù';



    $phothong[48] = 'ủ';
    $itdung[48] = 'ủ';



    $phothong[49] = 'ũ';
    $itdung[49] = 'ũ';



    $phothong[50] = 'ụ';
    $itdung[50] = 'ụ';



    // ///////////////



    // Vần ư thường xong



    $phothong[51] = 'ứ';
    $itdung[51] = 'ứ';



    $phothong[52] = 'ừ';
    $itdung[52] = 'ừ';



    $phothong[53] = 'ử';
    $itdung[53] = 'ử';



    $phothong[54] = 'ữ';
    $itdung[54] = 'ữ';



    $phothong[55] = 'ự';
    $itdung[55] = 'ự';



    // ////////////////////



    // Vần y thường xong



    $phothong[56] = 'ý';
    $itdung[56] = 'ý';



    $phothong[57] = 'ỳ';
    $itdung[57] = 'ỳ';



    $phothong[58] = 'ỷ';
    $itdung[58] = 'ỷ';



    $phothong[59] = 'ỹ';
    $itdung[59] = 'ỹ';



    // ////////////////////



    for ($j = 0; $j < 60; $j++) { // chạy vòng lặp để chuyển ký tự

        $pattern = '/' . $itdung[$j] . '/';

        $str = preg_replace($pattern, $phothong[$j], $str);
    }



    return $str;
}







function vn_num_acc_char($str)
{ // tìm số lượng ký tự có dấu trong một từ

    $rs = 0; // rs có thể lớn hơn 1, những từ đơn có hơn một dấu sẽ được xem là lỗi chính tả

    $acc = vna_acc_char_array(); // lấy mảng các nguyên âm đơn có dấu

    $strx = pop_hex_convert($str); // chuyển về dạng mã hóa phổ biến, và chuyển về ký tự thường

    foreach ($acc as $acc_char) {

        $pt = '/' . $acc_char . '/';

        if (preg_match_all($pt, $strx)) {
            $rs += preg_match_all($pt, $strx);
        }
    }



    return $rs;
}



// $tiengviet = "4 Fun Science Experiments To Try At Home With Your Kids | #E2xTwinkl Series";

// echo $tiengviet;

// echo "</br> số ký tự có dấu là:";

// echo vn_num_acc_char($tiengviet);



/////////////////////////////////////////////////////////////////////// End code