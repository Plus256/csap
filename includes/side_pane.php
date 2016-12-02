<section id="side_pane">
    <div id="side_pane_header" class="pane_header">
        <span class="avatar"><img src="<?php echo $user_profile_image_url ?>" /></span>
        <span id="user_handle">@<?php echo $user_screen_name ?></span>
        <div class="spacer"></div>
    </div>
    <div id="side_pane_main">
        <!--<div id="search_container">#Search#</div>-->
        <div id="chat_container">
            <div id="chat_container_header">
                <!--one of the two switches should be default (preferably chats). changed on click.-->
                <span id="chat_tab_switch" class="tab_switch">Chats</span>
                <span id="online_tab_switch" class="tab_switch">Online</span>
            </div>
            <div id="chat_container_main">
                <!--A script to fetch chats or users online. AJAX better-->
                <?php
                //some sessions in DB are duplicate (from same device)
                //because a browser may clear its sessions without the user logging out.
                //so the old session stays undestroyed and a new session created of the same user
                //we find a way of deleting non active sessions, maybe using a timestamp difference
                $user_id=$_SESSION["logged"];
                $data=$conn->query("SELECT DISTINCT s.user, u.name, u.screenname, u.profileimageurl FROM session AS s INNER JOIN user AS u ON s.user=u.id WHERE s.user!=$user_id ORDER BY s.id DESC")->fetchAll();
                if($data){
                    $chat_list="<ul id='chat_list'>";
                    foreach($data as $row){
                        $chat_list.="<li class='chat_list_item'>";//appending list item
                        
                        $chat_list.="<span class='chat_list_item_avatar'>"."<img src='".$row["profileimageurl"]."' />"."</span>";
                        $chat_list.="<span class='chat_list_item_details'>"."@".$row["screenname"]."</span>";
                        $chat_list.="<div class='spacer'></div>";
                        
                        $chat_list.="</li>";
                    }
                    $chat_list.="</ul>";
                    echo $chat_list;
                }
                else{
                    echo "<div class='default_chat_data'>Lonely world. Invite some friends.</div>";
                }
                ?>
            </div>
            <div class="spacer"></div>
        </div>
        <div class="spacer"></div>
    </div>
    <div class="spacer"></div>
</section>