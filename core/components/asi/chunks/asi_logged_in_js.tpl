<script>
[[+user.logged_in:eq=`1`:then=`

var logged_in = true;
`:else=`

var logged_in = false;

`]]
</script>