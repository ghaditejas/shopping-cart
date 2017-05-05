    /*
     *Checks the slave checkbox once the master s checked and unchecks the master if any of the slave is unchecked 
     */
    $(document).ready(function () {
        $("#checkall").change(function () {
            console.log("tejas");
            if (this.checked) {
                $("input.checkbox_check").each(function () {
                    this.checked = true;
                })
            } else {
                $("input.checkbox_check").each(function () {
                    this.checked = false;
                })
            }
        });
        $("input.checkbox_check:checkbox").click(function () {
            if (!this.checked) {
                $("#checkall").prop('checked', false);
            }
        });
    });
