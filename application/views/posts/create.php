<h2><?= $title; ?></h2>

<!---FORM VALIDATION--->
<?php echo validation_errors(); ?>

<?php echo form_open('posts/create'); ?>

  <!--Title-->
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title">
  </div>

  <!--Body-->
  <div class="form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body"></textarea>
  </div>

  <!--Category Drop Down-->
  <div class="form-group">
    <label>Category</label>
    <select name="category_id" class="form-control">
      <!--Loop through each category-->
      <?php foreach($categories as $category): ?>
        <!--Display category and included the id as a value-->
        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <!--Submit-->
  <button type="submit" class="btn btn-default">Submit</button>

</form>