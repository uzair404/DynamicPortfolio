$('#add_section').click(function() {
    let name = $('#name').val();
    let status = $('#status').val();
    $.ajax({
        url: "/add_section",
        type: "post",
        data: {
          name: name,
          status: status,
        },
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        cache: false,
        beforeSend: function() {},
        complete: function() {},
        success: function(response) {
            console.log(response)
            if (response["status"] == "fail") {
              toastr.error('Failed', response["error"])
            } else if (response["status"] == "success") {
                $('#navs').html(response['elem'])
                $("#navs .input-group").first().hide();
                toastr.success('Success', response["msg"])
                error = false;
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
  });