<?php

function getDay($element_id, $task_id, $job_id, $day = 'monday'){
    $day = \DB::table('days')->where('element_id',$element_id)
        ->where('days',$day)->where('job_id',$job_id)->where('task_id',$task_id)->first();
    if (is_null($day)) {
        return '';
    } else {
        return "X";
    }
}
