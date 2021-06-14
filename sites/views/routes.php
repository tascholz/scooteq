<?php include("template.php");?>
<?php include("javascript.js");?>


<div class="container">
    <div class="row pt-2 d-flex justify-content-center">
        <div class="col-4">
            <h1>Routenplaner</h1>
        </div>
    </div>

    <div class="row pt-2 d-flex justify-content-center"> 
        <div class="col-4">
            <?php
                foreach($routes as $key => $route){
                    ?>
                    <button 
                        class="btn btn-primary"
                        id="<?php echo $key?>"
                        onClick="showRoute(<?php echo $key?>)">Route <?php echo $key?></button>
                    <?php
                }
            ?>
        
        </div>
    </div>

    <div class="row pt-2 d-flex justify-content-center">
        <div class="col">
            <div id="test"></div>
        </div>
    </div>
</div>

