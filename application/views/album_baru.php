<div style="margin-top:50px;">
    <div class="upload_div">
    <form method="post" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="<?php echo base_url().'admin/album/upload';?>">
        <input type="hidden" name="image_form_submit" value="1"/>
            <label>Choose Image</label>
            <input type="file" name="images[]" id="images" multiple >
        <div class="uploading none">
            <label>&nbsp;</label>
            <img src="<?php echo base_url().'asset/img/uploading.gif';?>"/>
        </div>
    </form>
    </div>
    
    <div class="gallery" id="images_preview"></div>
</div>