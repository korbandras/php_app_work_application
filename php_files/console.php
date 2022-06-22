<?php
function consolelog($output, $with_script_tags = true): void{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if($with_script_tags){
        //add script
        $js_code = '<script>' . $js_code . '</script>';
    }
    //send script
    echo $js_code;
}
