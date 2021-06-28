<?php 
    function color(){
        $colors = ["#fad2e1", "#f2d2fa", "#d7d2fa", "#d2e3fa", "#d2fae3", "#d8fad2", "#eefad2", "#faecd2", "#fadcd2"];

        $x = rand(0, 8);
        $color = $colors[$x];

        return $color;
    }
?>