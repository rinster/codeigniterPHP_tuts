<h2><?= $title; ?></h2>

<!---FORM VALIDATION--->
<?php echo validation_errors(); ?>

<?php echo form_open('posts/update'); ?>
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title" value="<?php echo $post['title']; ?>">
  </div>
  <div class="form-group">
    <label>Body</label>
    <textarea class="form-control" name="body" placeholder="Add Body"><?php echo $post['body']; ?></textarea>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>