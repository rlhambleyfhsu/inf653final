<nav>
    <div>
        <div class="links">
            <form action="admin.php" id="admin-control">
                <input type="hidden" name="action" id="admin-input" value="">
                    <div onclick="navControl('approvals')">Approvals</div>
                    <div onclick="navControl('editauthors')">Edit Authors</div>
                    <div onclick="navControl('editcategories')">Edit Categories</div>
                    <div onclick="navControl('administrators')">Edit Administrators</div>
                <div onclick="navControl('logout')">Logout</div>
            </form>
        </div>
    </div>
</nav>
