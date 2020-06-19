<h2><?php echo $post['title']; ?></h2>
<small class="post-date">Posted on: <?php echo $post['created_at']; ?></small>

<img src="<?php echo site_url(); ?>assets/images/pots/<?php echo $post['post_image'];?>">

<!---Post Body-->
<div class="post-body">
    <?php echo $post['body']; ?>
</div>

<hr>

<!----Edit Button---->
<a class="btn btn-default pull-left" href="<?php echo base_url(); ?>/posts/edit/<?php echo $post['slug']; ?>">Edit</a>
<!----Delete Button ---->
<?php echo form_open('/posts/delete/'.$post['id']); ?>
    <input type="submit" value="Delete" class="btn btn-danger">
</form>