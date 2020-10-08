<?php
$carga=round(($result["bateria"]/5)*100);
if ($carga > 85){
    $class='fa fa-battery-full';
    $style='background-image: linear-gradient(to right, #ccc , #fff);';
}elseif ($carga > 55) {
    $class='fa fa-battery-three-quarters ';
    $style='background-image: linear-gradient(to right, #ccc , #fff);';
}elseif ($carga > 44) {
    $class='fa fa-battery-half';
    $style='background-image: linear-gradient(to right, #ccc , #fff);';
}elseif ($carga > 20){
    $class = 'fa fa-battery-quarter';
    $style='background-image: linear-gradient(to right, #ccc , #fff);';
    //$color = 'background:#0275d8;';
}else{
    $class = 'fa fa-battery-empty';
    $style='background-image: linear-gradient(to right, #ff0000 , #8f1b20);';
    //$color = 'background:#ff0000;';
}
?>
<div class="wrapper">
    <div><?php echo $carga.'% ';?><span class="<?php echo $class;?>"></span></div>
    <div class="progress-bar" role="progressbar">
        <div class="progress-bar-fill" style="<?php echo 'width:'.$carga.'%; '.$style ?>"> 
        </div>
    </div>
</div>
