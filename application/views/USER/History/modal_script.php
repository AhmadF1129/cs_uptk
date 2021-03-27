<script>
    $(document).ready(function() {
        // CUSTOM INPUT RULES
        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg !== value;
        }, "Value must not equal arg.");

        // ALL INPUT RULES
        $("#form-input-history-logout").validate({
            rules: {
                'cmb-kondisi-akhir': {
                    valueNotEquals: "default"
                }
            },
            messages: {
                'cmb-kondisi-akhir': {
                    valueNotEquals: "Silahkan pilih terlebih dahulu"
                }
            }
        });
    });
</script>