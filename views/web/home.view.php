<layout file="dashboard">

    <section name="content">
        <div class="container mt-5">
            <h2 class="mb-4">User lists</h2>

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
                </tr>
                </thead>
                <tbody>
                <foreach loop="$users as $user">
                    <tr>
                        <td><print value="$user['id']"></td>
                        <td><print value="$user['name']"></td>
                        <td><print value="$user['email']"></td>
                        <td><print value="$user['created_at']"></td>
                    </tr>
                </foreach>
                </tbody>
            </table>
        </div>
    </section>

</layout>