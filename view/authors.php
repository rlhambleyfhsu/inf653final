<?php
#require_once('util/valid_admin.php');
 ?>
<main>
  <h2>Manage Authors</h2>
<section>
  <table>
    <tr>
      <td>Author</td>
      <td>&nbsp</td>
    </tr>
        <?php foreach ($authors as $author) : ?>
        <tr>
        <td><?php if (!empty($author) ) echo $author['authorName']; ?></td>
        <td><form action="admin.php" method="post">
          <input type="hidden" name="action" value="delauthors">
          <input type="hidden" name="authid" value="<?php echo $author['id']; ?>">
          <input type="submit" value="Remove">
          </form></td>
        </tr>
        <br>
    <?php  endforeach;  ?>
  </table>
    </form>

    <P>
    <h2>Add Author</h2>
    <form action="admin.php" method="post" id="addauthors">
      <input type="hidden" name="action" value="addauthors">
    <label>Category:</label>
    <input type="text" name="authorName"><br>
    <label>&nbsp;</label>
    <input type="submit" value="Add Authors"><br>
    <p>
    </form>
  </section>
  <P>
</section>
</main>
