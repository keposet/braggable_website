<?php
require 'includes/travel-dbConfig.inc.php'; 

try {
    
    $result = new ContinentGateway($connection);
    $cntIDName = $result -> findByStatement(2);
    $result = new CountriesGateway($connection);
    $cntryIDName = $result -> findByStatement(2);
    $result = new CitiesGateway($connection); 
    $ctyIDName = $result -> findByStatement(2);
    
    $result = new ImageDetailsGateway($connection); 
    $imageRec = $result -> findByStatement(6, null);
    
    
    
} catch (Exception $e ) {
    die($e ->getMessage()); 
} finally{
    $connection = null;
}


function insertBR(){
    echo "</br>";
}

function echoString($text){
    echo $text; 
}



function populateDropDown($records, $id, $class){
    foreach ($records as $r) {
        $code = $r[0];
        $name = $r[1];
        echo "<option class =$class id= $id$code value = $code>$name</option>";
                            
        }
}

function opDropDownStructure($choice, $record){
    switch ($choice){
        case "continent":
            $ddName = "cnt";
            $ddID = "cntDD";
            $class = "cntOpt";
            $defOption = "Continent";
            
            break;
        case "country":
            $ddName = "cntry";
            $ddID = "cntryDD";
            $class = "cntryOpt";
            $defOption = "Country";
            
            break;
        case "city":
            $ddName = "city";
            $ddID = "ctyDD";
            $class = "ctyOpt";
            $defOption = "City";
            
            break;
    }
    echo "<select name = $ddName id= $ddID class = 'DD'>";
    echo "<option value =0>$defOption</option>";
    populateDropDown($record,$ddID, $class);
    echo "</select>";
}

function pictures($imgRec){
    
    foreach($imgRec as $img){
        $id = $img[0];
        $path = $img[1];
        $title = "\"";
        $title .= $img['Title'];
        $title .= "\"";
        $country =  $img['CountryCodeISO'];
        $city = $img['CityCode'];
        $continent =$img['ContinentCode'];
        $description = "\"";
        $description .= $img['Description'];
        $description .= "\"";
        //echo "<div>";
        echo "<a href=# title =$title country=$country city=$city continent=$continent ><img src=/travel-images/square-small/$path id=img$id  /></a>";
        //echo "</div>";
        
    }
     
}

?>

<!DOCTYPE html>
<html>
    <body>
        <a href="test-page.php<?php ?>"></a> <button></button>
        <div>
            <!--<form action="test-page.php"id="filter_form">-->
            <form id="filter_form">
                    <?php
                    opDropDownStructure("continent", $cntIDName );
                    opDropDownStructure("country", $cntryIDName);
                    opDropDownStructure("city", $ctyIDName);
                    ?>
            <input type="text" name="Title"/>
                <button id = "clear_btn">Clear</button>
            </form>
        </div>
        <div id= "imageContainer">
            <?php
               pictures($imageRec);
            ?>
            
        </div>
        
    </body>
    
    <script>
        
        let form = document.getElementById("filter_form");
            form.addEventListener("click", function(e){
            var filterText; 
            console.log(e.target.value);
            // exclude default 
            if(e.target && e.target.value != 0 ){
                // get the value of the field
                filterText = e.target.value;    
                var pic = document.querySelectorAll('#imageContainer > a');
                // find out which from field is being selected 
                let category = e.target.getAttribute("id"); 
                var attr;
                
                if (category =="cntryDD"){
                    // loop through pictures filtering against country
                    attr = "country";
                } else if(category == "cntDD"){
                    attr = "continent"; 
                } else if(category == "ctyDD"){
                    attr = "city"
                }
                
                for(let i = 0; i< pic.length; i++){
                    if(filterText != pic[i].getAttribute(attr)){
                        pic[i].setAttribute("hidden","");
                    }
                }
                filterText = null;
            }
        });
        
        var clrBtn = document.getElementById("clear_btn");
        clrBtn.addEventListener("click", function(){
            let hidPics = document.querySelectorAll("hidden");
            for(let i =0; i<hidPics.length; i++){
                hidPics[i].removeAttribute("hidden");
            }
            
        });

        
    </script>
</html>