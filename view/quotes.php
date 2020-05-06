<h2>Filter Quotes</h2>
<section>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" id="form-change" class="">
            <input type="hidden" name="action" value="" id="action" />
            <input type="hidden" name="quoteID" value="" id="quoteID" />
            <div id="filter-grp" <?php echo $approval ? "hidden" : "" ?>">
                <div>
                    <div>
                        <select id="categoryId" name="categoryId" onchange="formChange()">
                            <option value="0">All Categories</option>
                            <?php foreach ($categories as $category) : ?>
                                <option class="option-dropdown" value="<?php echo $category['id']; ?>"
                                  <?= ($category['id'] == $categoryID) ? 'selected' : ''; ?>>
                            <?php echo $category['categoryName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <select id="authorID" name="authorID" onchange="formChange()">
                            <option value="0">All Authors</option>
                            <?php foreach ($authors as $author) : ?>
                                <option value="<?php echo $author['id']; ?>"
                                  <?= ($author['id'] == $authorID) ? 'selected' : ''; ?>>
                            <?php echo $author['authorName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div onclick="clearFilters()"><i>Clear Filters</i></div>
              </div>
        </div>
        <h2> Add a Quote</h2>
          <div>
                <div>
                    <div>
                        <select id="categoryIDSubmit" name="categoryIDSubmit" onchange="checkValid()">
                            <option value="0">Select Category</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="
                            <?php echo $category['id']; ?>" <?= ($category['id'] == $categoryID) ? 'selected' : ''; ?>><?php echo $category['categoryName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <select id="authorIDSubmit" name="authorIDSubmit" onchange="checkValid()">
                            <option value="0">Select Author</option>
                            <?php foreach ($authors as $author) : ?>
                                <option value="
                            <?php echo $author['id']; ?>" <?= ($author['id'] == $authorID) ? 'selected' : ''; ?>><?php echo $author['authorName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <textarea name="textsubmit" id="textsubmit" placeholder="Enter Quote" onkeyup="checkValid()"></textarea>
                    </div>
                    <div onclick="checkValid(true)" id="submit-quote-btn">Submit New Quote</div>
                    <div onclick="closeSubmit()">Cancel Submition</div>
                </div>
                <div id="warning"></div>
            </div>
        </form>
<h2>Quotes</h2>
        <div>
            <!-- Loop through all quotes and display individual quotes -->
            <?php foreach ($quotes as $quote) : ?>
                <div>
                    <div>
                        <blockquote>
                            "<?php echo $quote['quotetext']; ?>"
                        </blockquote>
                        <p><?php echo $quote['authorName']; ?> on <?php echo $quote['categoryName']; ?></p>
                        <div>
                            <?php if ($loggedIn && $approval) { ?>
                                <div>
                                    <div onclick="updateEntry(<?php echo $quote['id'] ?>, 'approve')"></i> Approve</div>
                                    <div onclick="updateEntry(<?php echo $quote['id'] ?>, 'delete')"></i> Delete</div>
                                </div>
                            <?php } else if ($loggedIn) { ?>
                                <div  onclick="updateEntry(<?php echo $quote['quoteID'] ?>, 'delete')">Delete</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        if (count($quotes) == 0) {
            if ($approval) { ?>
                <div>
                    <h2>All Quotes have been approved!</h2>
                </div>
            <?php } else { ?>
                <div>
                    <h2>No Quotes found with the current search criteria</h2>
                </div>
        <?php }
        } ?>

    </div>
</section>
