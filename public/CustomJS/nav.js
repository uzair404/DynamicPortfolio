$('#add_nav').click(function() {
    let displays = $('#display').val();
    let order = $('#order').val();
    let links = $('#link').val();
    $.ajax({
        url: "/add_nav",
        type: "post",
        data: {
            display: displays,
            link: links,
            order: order,
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

function delete_nav(id){
    $.ajax({
        url: "/delete_nav",
        type: "post",
        data: {
            nav_id: id,
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
  }