<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="myCtrl">

<?php

include 'header.php';
include 'getContent.php';

$agencyTag="ttc"; //could be changed later to use a different transit system

?>

<?php

    $url='http://webservices.nextbus.com/service/publicXMLFeed?command=routeList&a=ttc&r=5';
    $arr = get_content($url);

    $p = xml_parser_create();
    $vals = NULL;
    $index = NULL;
    xml_parse_into_struct($p, $arr, $vals, $index);
    xml_parser_free($p);

?>


<div class='row'>
<div class='chooseRoute'>

    <h2>Choose your route</h2>

    <form ng-model="findRouteTag" class="form-horizontal" method="post" action="index.php">
    
    <div class="input-field col l12">

    <select id='userRouteTag' ng-model='userRouteTag' material-select>

    <?php

    foreach ($vals as $val)
    {
        if (isset($val['attributes']))
        {
            if (isset($val['attributes']['TAG']))
            {
            echo "<option value='{$val['attributes']['TAG']}'>{$val['attributes']['TITLE']}</option>";
            }
        }
    }

    ?>

    </select>
    </div> <!--end input-field class-->
    <!--could use ng-switch-once route option is chosen-->

    <button class="btn waves-effect waves-light" type="submit" name="getRouteTag" id="getRouteTag">Choose Route</button>


      </form>



       <?php
        //once route is submitted
        if(isset($_POST['getRouteTag']))
        {
          $routeTag = $_POST['userRouteTag'];
        }

    ?>


    <?php

        $url2='http://webservices.nextbus.com/service/publicXMLFeed?command=routeConfig&a=ttc&r=' . $routeTag;
        $arr2 = get_content($url2);

        $p2 = xml_parser_create();
        $vals2 = NULL;
        $index2 = NULL;
        xml_parse_into_struct($p2, $arr2, $vals2, $index2);
        xml_parser_free($p2);


    ?>


<br/>
<br/>

    <h2>Then enter your stop</h2>

    <form name="findStopId" class="form-horizontal" method="post" action="displayInfo.php" >


    <div class="input-field col l12">

    <select id='userStopId' name='userStopId' material-select>

    <?php

    foreach ($vals2 as $val)
    {
        //once stop is submitted
        if (isset($val['attributes']))
        {
            if (isset($val['attributes']['STOPID']))
            {
            echo "<option value='{$val['attributes']['STOPID']}|" . $routeTag . "|{$val['attributes']['LAT']}|{$val['attributes']['LON']}'>{$val['attributes']['TITLE']}</option>";
            }
        }
    }

    ?>

    </select>
    </div><!--end input-field div-->
    

    <button class="btn waves-effect waves-light" type="submit" name="getStopId" id='getStopId'>Choose Stop ID</button>


    </form>



</div> <!--end col wrap-->



<!--<div class='indexPicsCar'>
    
<?php/*
    $increment=0;
    while($increment<24)
    {
    echo "<div class='rainClass'><img src='images/rain.jpg' class='rainImg'></div>";
    $increment++;*/
    }

?>



</div>end col and index wrap-->




<?php

include 'footer.php';

?>
</div>

</body>
</html>