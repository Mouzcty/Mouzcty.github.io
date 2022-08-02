<!DOCTYPE html>
<html>
<body>
<script>
function check() {
    if(document.getElementById('password').value ===
            document.getElementById('confirm_password').value) {
        document.getElementById('message').innerHTML = "match";
    } else {
        document.getElementById('message').innerHTML = "no match";
    }
}
</script>


</div>

</body>
</html>