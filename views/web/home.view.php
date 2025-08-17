<layout file="dashboard">

    <section name="content">
        <div class="container mt-5">
            <h2 class="mb-4">User lists</h2>
            <p><?= $_SESSION['msg_update'] ?? "" ?></p>

            <form method="GET" class="mb-3 d-flex">
                <input type="text" name="q" class="form-control me-2" placeholder="Search by name or email" value="">
                <button class="btn btn-primary">Search</button>
                <a href="/dashboard" class="btn btn-primary mx-2">Clear</a>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <if condition="$_SESSION['isAdmin'] == 'admin'">
                        <th>Actions</th>
                    </if>
                </tr>
                </thead>
                <tbody>
                <foreach loop="$users as $user">
                    <tr>
                        <td><print value="$user['id']"></td>
                        <td><print value="$user['name']"></td>
                        <td><print value="$user['email']"></td>
                        <td><print value="$user['created_at']"></td>
                        <if condition="$_SESSION['isAdmin'] == 'admin'">
                            <td>
                                <button class="btn btn-dark mx-auto"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editUserModal"
                                        data-id="<?= $user['id'] ?>"
                                        data-name="<?= $user['name'] ?>"
                                        data-email="<?= $user['email'] ?>"
                                        data-avatar="<?= $user['avatar'] ?>">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                    </svg>
                                </button>
                            </td>
                        </if>
                    </tr>
                </foreach>
                </tbody>
            </table>

            <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="editUserForm" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="id" id="editUserId">

                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <img id="editUserAvatarPreview" src="/uploads/avatars/default.png"
                                             alt="Avatar" class="rounded-circle mb-3" width="120">
                                        <input type="file" name="avatar" class="form-control">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="editUserName">Name</label>
                                            <input type="text" class="form-control" name="name" id="editUserName">
                                        </div>

                                        <div class="mb-3">
                                            <label for="editUserEmail">Email</label>
                                            <input type="email" class="form-control" name="email" id="editUserEmail">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</layout>
