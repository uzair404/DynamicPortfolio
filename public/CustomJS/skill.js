function delete_skill(id){
    $.ajax({
        url: "/delete_skill",
        type: "post",
        data: {
            skill_id: id,
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
                $('#skills').html(response['elem'])
                toastr.success('Success', response["msg"])
                error = false;
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
  }

  $('#add_skill').click(function() {
    let name = $('#skill-name').val();
    let percent = $('#skill-percent').val();
    $.ajax({
        url: "/add_skill",
        type: "post",
        data: {
          name: name,
          percent: percent,
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
                $('#skills').html(response['elem'])
                toastr.success('Success', response["msg"])
                error = false;
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
  });