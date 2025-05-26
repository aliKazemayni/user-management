<h1>Home page</h1>
<span><?= $title ?? "" ?></span>
<if condition="$age == 20">
    <span>age is
        <print value="$age"></print>
    </span>
</if>