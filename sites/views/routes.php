<?php include("template.php");?>
<h1>Routenplaner</h1>
<?php
foreach($routes as $key => $route){
    if(!empty($route)){
        echo "<h1>Route: " . $key . "</h1><br>";
        foreach($route as $routeDestination){
            getTableString($routeDestination);
            echo $routeDestination->name . "<BLOCKQUOTE>";
            echo getTableString($routeDestination) . "<br></BLOCKQUOTE>";
        }
    }
}

function getTableString($destination){
    if($destination->diff > 0){
        return "Abholung: " . $destination->diff . " Roller";
    }
    else
    {
        return "Abstellen: " . abs($destination->diff) . " Roller";
    }
}
?>

<script>
</script>