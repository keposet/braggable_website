<?php
require 'includes/travel-dbConfig.inc.php'; 

//print_r($read); 
$postCookie = $_COOKIE['post'];
$imgCookie = $_COOKIE['image']; 


if (isset($postCookie) && !empty($postCookie)) {
    // load values into an array, feed that array into the database
    $postData = cookieDataToArray($postCookie);
    // print_r($postData);
}

if(isset($imgCookie) && !empty($imgCookie)){
    $imgData = cookieDataToArray($imgCookie);
}


function cookieDataToArray($data){
    return explode(" ", $data);
}




try {
    $result = new PostsGateway($connection);
    // what do i need? really just a title and an image cause why the hell not
    $posts = $result -> findByStatement(2,null);
    
    $postList = array(); 
    foreach($postData as $pD){
        array_push($postList,$result -> findById($pD));
    }
    
    print_r($postList);
    
    $result = new ImageDetailsGateway($connection); 
    $images = $result -> findByStatement(0, null);
    // has the big arrays with everything
    
    $imgList = array();
    foreach($imgData as $iD){
        array_push($imgList, $result-> findById($iD)); 
    }
    
    
} catch (Exception $e ) {
    die($e ->getMessage()); 
} finally{
    $connection = null;
}


?>

<!DOCTYPE html>
<html>
    <body>
        <div class = "view_fave">
            
        </div>
        
        <div class = "hidden" id = "alertParent">
            <div class = "hidden alert" id = "addMessage">
                Added To Favourites
            </div>    
        </div>
        

        <div class ="content" style="display:flex; margin: 50px">
            <div class ="pics_content" style="margin:1em">
                <!--iterate through array showing picture and title-->
                <?php
                    foreach ($images as $img) {
                        $path = $img['Path'];
                        $title = $img['Title'];
                        $id = $img['ImageID'];
                        echo "<div>";
                        echo "<h3> $title</h3>";
                        echo "<p> path is $path </p>";
                        echo "<button class = \"img_fav\" name='image' value =$id>Add to Favourites</button>";
                        echo "<button class = \"img_rem\" name='image' value =$id>Remove from Favourites</button>";
                        echo "</div>";
                    }
                ?>
                
            </div>
            <div class="posts_content">
                <!--iterate through array showing title and image-->
                <?php
                    foreach ($posts as $post) {
                        $title = $post['Title'];
                        $user = $post['UserID'];
                        $id = $post['PostID'];
                        $mainImg = $post['MainPostImage'];
                        echo "<div>";
                        echo "<h3>$title</h3>";
                        echo "<p>User is $user, image is $mainImg</p>";
                        echo "<button class = \"post_fav\" name='post' value = $id >Add to Favourites</button>";
                        echo "<button class = \"post_rem\" name='post' value =$id>Remove from Favourites</button>";
                        echo "</div>";
                    }
                    
                ?>
            </div>
            
        </div>
    </body>
    
    <script>
   
    
        function wholeCookiesToArray(){
            let cookiesArr = document.cookie; 
                cookiesArr = decodeURIComponent(cookiesArr); 
                
                
            return cookiesArr = cookiesArr.split("; ");
        }
        
        
        // returns an array from a cookie c=12345 -> [1 2 3 4 5]
        function cookieValuesToArray(cookie, key){
            
            let values = cookie;
            // cookies at i is a string, need to substring, split iterate
            values = values.substring(key.length+1);
            
            return values = values.split(" ");
            // return values = values.split(" ");
            
        }
            
        window.load = function(){
        let content = document.querySelector(".content");
        
        content.addEventListener("click", function(e){    
        
            // ADD to Fave
            if(e.target && (e.target.getAttribute("class") == "img_fav" || e.target.getAttribute("class") == "post_fav")){
               let values;
                //console.log(e.target.getAttribute("class"))
                

                let key = e.target.getAttribute("name");
                let val = e.target.getAttribute("value");
                console.log("val at instantiation " + val);
               
               // creates a new cookie with only one value
                let newcookie = true
                // adds to the list of cookies 
                let appendCookie = true;
                
                let cookies = wholeCookiesToArray();
                
                for(let i = 0; i<cookies.length; i++){
                    // check for existing cookies
                    if(cookies[i].startsWith(key)){
                        // key exists
                        newcookie = false;
                        console.log(" found key" +cookies[i]);
                        values = cookieValuesToArray(cookies[i], key);
                        //console.log("values after array func " + values);
                        
                        // check for existence of value in string
                        for(let i = 0; i < values.length; i++){
                            console.log(val);
                            if(values[i] == val){
                                //console.log("value at i "+ values[i]);
                                
                                //why 
                                        // key exists and value exists 
                                appendCookie = false;
                            }
                        }
                        if(appendCookie){
                            console.log("values length " + values.length); 
                            console.log("values [i] " + values[i]); 
                            if(values.length >=1 ){
                                //values+= " "+val;
                                values.push(val);
                                console.log(values);
                              
                            }
                            
                          //  values+= " "+val;
                            console.log(values);
                           // values = val; 
                        }
                        //console.log(values);
                        // seems like this isn't needed 
                        values = values.join(" ");
                        console.log(values);
                        console.log(typeof values);
                    }
                }
 
               // newcookie ? document.cookie = key +"="+ JSON.stringify(values) : document.cookie = key +"="+ JSON.stringify(values);
               
                newcookie ?  document.cookie = key +"="+ val : document.cookie = key +"="+ values;
                
                // display div on add
                let messageDiv = document.getElementById("addMessage");
                messageDiv.setAttribute("class", "alert");
                setTimeout(function(){messageDiv.setAttribute("class", "hidden alert")}, 2000);
                
                
            }
            // REMOVE from Fave
            
            // this is a hard remove. need to be able to queue for removal. 
                 if(e.target && (e.target.getAttribute("class") == "post_rem" || e.target.getAttribute("class") == "img_rem")){
                    let values; 
                    let key = e.target.getAttribute("name");
                    let val = e.target.getAttribute("value");
                    let cookies = wholeCookiesToArray();
                    
                    for(let i = 0; i < cookies.length;i++){
                        if(cookies[i].startsWith(key)){
                            
                            values = cookieValuesToArray(cookies[i],key);
                            for(let i =0; i< values.length; i++){
                                if(values[i] == val){
                                    //values = values.splice(i,1);
                                    values.splice(i,1);
                                }
                            }
                            
                        }
                    }
                    console.log(values);
                    values = values.join(" ");
                    document.cookie = key +"="+values;
                }
            
            console.log(document.cookie);
        }); 
    
        }();
    </script>
</html>