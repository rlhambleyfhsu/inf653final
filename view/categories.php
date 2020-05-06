<?php
require_once('util/valid_admin.php');
 ?>
<main>
  <h2>Manage Categories</h2>
<section>
  <table>
    <tr>
      <td>Category</td>
      <td>&nbsp</td>
    </tr>
        <?php foreach ($categories as $category) : ?>
        <tr>
        <td><?php if (!empty($category) ) echo $category['categoryName']; ?></td>
        <td><form action="admin.php" method="post">
          <input type="hidden" name="action" value="delcategories">
          <input type="hidden" name="catid" value="<?php echo $category['id']; ?>">
          <input type="submit" value="Remove">
          </form></td>
        </tr>
        <br>
    <?php  endforeach;  ?>
  </table>
    </form>

    <P>
    <h2>Add Category</h2>
    <form action="admin.php" method="post" id="addcategories">
      <input type="hidden" name="action" value="addcategories">
    <label>Category:</label>
    <input type="text" name="categoryName"><br>
    <label>&nbsp;</label>
    <input type="submit" value="Add Category"><br>
    <p>
    </form>
  </section>
  <P>
</section>
</main>
