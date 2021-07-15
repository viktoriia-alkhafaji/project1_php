<form action="" method="POST" enctype="multipart/form-data" class="pure-form  pure-form-aligned" id="action-form">
    <fieldset>
        <div class="pure-control-group">
            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo $result['title'];?>" id="title">
        </div>
        <div class="pure-control-group">
            <label for="url">URL:</label>
            <input type="text" name="url" value="<?php echo $result['url'];?>" id="url">
        </div>
        <div class="pure-control-group">
            <label for="descr-min">Min Description:</label>
            <textarea name="descr-min" id="descr-min"><?php echo $result['descr_min'];?></textarea>
        </div>
        <div class="pure-control-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description"><?php echo $result['description'];?></textarea>
        </div>
        <div class="pure-control-group">
            <label for="cid">Category:</label>
            <select name="cid" id="cid">
                <?php
                $out = '';
                for($i=0; $i < count($category); $i++) {
                    if ($category[$i]['id'] ===  $result['cid']){
                        $out .= '<option value="' . $category[$i]['id'] . '" selected>' . $category[$i]['title'] . "</option>";
                    }
                    else {
                        $out .= '<option value="' . $category[$i]['id'] . '">' . $category[$i]['title'] . "</option>";
                    }
                }
                echo $out;
                ?>
            </select>
        </div>
        <div class="pure-control-group">
            <label for="image">Photo:</label>
            <input type="file" id="image" name="image" value="<?php echo $result['image'];?>">
            <?php
            if (isset($result['image']) AND $result['image']!='') {
                echo '<div><img src="/static/images/'.$result['image'].'" style="width:100px"></div>';
            }
            ?>
        </div>

        <div class="pure-control-group">
            <input type="submit" name="submit" value="<?php echo $action;?>" class="pure-button pure-button-primary">
        </div>
    </fieldset>
</form>