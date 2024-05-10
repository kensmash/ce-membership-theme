<?php
/**
 * Template part for displaying course meta info
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* @package Bootscore
 * @version 6.0.0
 */


$date_now = date('Y-m-d H:i:s');
//seem to need to do this or WP goes by date only
$time_now = strtotime($date_now);
$time_one_day = strtotime('-4 hours', $time_now);
$endOfDay = strtotime("tomorrow") - 1;
$unixtimestamp = strtotime(get_field('start_date')); ?>


<p class="course-meta">
    <span>
        <?php 
            if (get_field('course_duration')): 
                the_field('course_duration');
            endif;
            
                the_field('course_type'); 
           
        ?>  |
    </span>

    <?php if ($unixtimestamp > $time_one_day):
   
    //Master Seminar
        if (get_field('course_type') == "Master Seminar") {
            if (get_field('course_duration') !== "1 Day") { // If Master Seminar takes place over more than one day
            echo date('l', strtotime(get_field('start_date'))); ?>, <?php echo date('F j', strtotime(get_field('start_date'))); ?> – <?php echo date('l', strtotime(get_field('end_date'))); ?>, <?php echo date('F j, Y', strtotime(get_field('end_date'))) . " |";
            } else {
                echo date('l, F j, Y', strtotime(get_field('start_date'))) . " |";
            }
            echo " " . date('g:i a', strtotime(get_field('start_date'))); ?> - <?php echo get_field('end_time') . " ET |" ;
        } 
        //Live Course
        if (get_field('course_type') == "Live Course") {
            echo date('l', strtotime(get_field('start_date'))); ?>s, <?php echo date('F j', strtotime(get_field('start_date'))); ?> – <?php echo date('F j, Y', strtotime(get_field('end_date'))); ?>
        | <?php echo date('g:i a', strtotime(get_field('start_date'))); ?> - <?php echo date('g:i a', strtotime(get_field('end_date'))); ?>
        ET | <?php if (get_field('skip_week_2') != "") { ?> | <span> Skip Weeks <?php echo date('F j', strtotime(get_field('skip_week')));?>, <?php echo date('F j', strtotime(get_field('skip_week_2'))); ?> </span>
        <?php } elseif (get_field('skip_week') != "") { ?>
        | <span> Skip Week <?php echo date('F j', strtotime(get_field('skip_week'))); ?> | </span>
        <?php }
    }
        
    endif; 

    ce_instructors('') ?>

</p>