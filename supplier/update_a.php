<form method="POST" onsubmit="return getData(this);">
    <input name="supplier_id" placeholder="Supplier ID">
    <input type="submit" value="Search">
</form>

<script>
    function getData(form) {
        var supplier_id = form.supplier_id.value;

        var ajax = new XMLHttpRequest();
        ajax.open("POST", "Http.php", true);
        ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                var form = document.getElementById("form-update");

                /* Show data in 2nd form */
                form.name.value = data.name;
                form.email.value = data.email;
                form.tel_no.value = data.tel_no;
                form.address.value = data.address;
                form.tax_id.value = data.tax_id;
                form.credit_limit.value = data.credit_limit;
                form.supplier_id.value = supplier_id;

                form.style.display = "";
            }
        };

        ajax.send("supplier_id=" + supplier_id + "&get_data=1");
        return false;
    }
</script>