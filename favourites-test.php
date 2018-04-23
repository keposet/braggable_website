<?php
require 'includes/travel-dbConfig.inc.php'; 


try {
    $result = new PostsGateway($connection);
    // what do i need? really just a title and an image cause why the hell not
    $posts = $result -> findByStatement(2,null);
    
    $result = new ImageDetailsGateway($connection); 
    $images = $result -> findByStatement(0, null);
    // has the big arrays with everything
    
    
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
            <button id =test> Click</button>
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
        function cookiesToArray(){
            let cookies = document.cookie; 
                cookies = decodeURIComponent(cookies); 
                // cookies is now an array of strings
            return cookies = cookies.split("; ");
        }
        
        function cookieValuesToArray(cookies, key){
            // go in on finding the value
            let values = cookies;
            // cookies at i is a string, need to substring, split iterate
            values = values.substring(key.length+1);
            return values = values.split(",");
            
        }
            
            
        let tb = document.getElementById("test");
        tb.addEventListener("click",function(){
            console.log();
            
            
        });

        
        let content = document.querySelector(".content");
        content.addEventListener("click", function(e){
            
            let values;
            console.log(e.target.getAttribute("class"));
            if(e.target && (e.target.getAttribute("class") == "img_fav" || e.target.getAttribute("class") == "post_fav")){
                console.log(e.target.getAttribute("class"))
                // all this will be needed for removal
                let key = e.target.getAttribute("name");
                let val = e.target.getAttribute("value");
                let newcookie = true
                let appendCookie = true;
                
                let cookies = cookiesToArray();
                
                for(let i = 0; i<cookies.length; i++){
                    // check for existing cookies
                    if(cookies[i].startsWith(key)){
                        // key exists
                        newcookie = false;
                        values = cookieValuesToArray(cookies[i], key);
                        
                        for(let i = 0; i < values.length; i++){
                            if(values[i] == val){
                                appendCookie = false;
                            }
                        }
                        if(appendCookie){
                            values+= ","+val; 
                        }
                        values = values.toString();
                    }
                }
                // either adds a new cookie, or overwrites with added value
                newcookie ? document.cookie = key+"="+val : document.cookie = key +"=" +values
                // remove either do nothing, or overwrite w/o target 
            // }else if(e.target && (e.target.getAttribute("class") == "post_rem" || e.target.getAttribute("class") == "img_rem")){
            }
             if(e.target && (e.target.getAttribute("class") == "post_rem" || e.target.getAttribute("class") == "img_rem")){
                let key = e.target.getAttribute("name");
                let val = e.target.getAttribute("value");
                let cookies = cookiesToArray();
                
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
                document.cookie = key +"="+values;
            }
            console.log(document.cookie);
        }); 
        
    </script>
</html>